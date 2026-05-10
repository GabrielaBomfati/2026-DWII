-- ════════════════════════════════════════════════════════════
-- Disciplina : Desenvolvimento Web II (DWII)
-- Arquivo    : sql/setup.sql
-- Descrição  : Banco 'portfolio' unificado e profissionalizado.
--              Resolve P5 (dwii_db + portfolio antigo → portfolio único).
-- Execução   : mariadb -u root -pdwii2026 -h 127.0.0.1 --skip-ssl < sql/setup.sql
-- ════════════════════════════════════════════════════════════

-- Reset limpo (ambiente de desenvolvimento — em produção, JAMAIS).
DROP DATABASE IF EXISTS dwii_db;
DROP DATABASE IF EXISTS portfolio;

-- utf8mb4 é o "verdadeiro UTF-8" do MariaDB. Suporta emojis e
-- caracteres fora do plano básico Unicode.
-- utf8mb4_unicode_ci: comparação case-insensitive ('A' = 'a').
CREATE DATABASE portfolio
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE portfolio;

-- ════════════════════════════════════════════════════════════
-- TABELA: usuarios
-- ════════════════════════════════════════════════════════════
-- Contas com acesso à área administrativa (painel CRUD).
--
-- A coluna 'senha' guarda APENAS o hash bcrypt — NUNCA a senha
-- em texto puro. Hash bcrypt sempre começa com $2y$ e tem 60
-- caracteres. VARCHAR(255) é o tamanho recomendado pela
-- documentação do PHP (futuras versões podem gerar hashes maiores).
--
-- 'status' = 'inativo' bloqueia o login sem apagar a conta.
-- Útil para férias, suspensão, ou ex-funcionários.
CREATE TABLE usuarios (
    id        INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    login     VARCHAR(50)   NOT NULL UNIQUE,
    senha     VARCHAR(255)  NOT NULL,                 -- hash bcrypt
    email     VARCHAR(150)  NOT NULL UNIQUE,
    status    ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
    criado_em DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ════════════════════════════════════════════════════════════
-- TABELA: tecnologias
-- ════════════════════════════════════════════════════════════
-- Catálogo público de tecnologias (vinha de dwii_db.tecnologias).
--
-- 'status' permite OCULTAR uma tecnologia sem perder o registro.
-- Páginas públicas filtram WHERE status = 'ativo'. O painel
-- administrativo pode listar todas para reativar quando quiser.
CREATE TABLE tecnologias (
    id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    nome        VARCHAR(100)  NOT NULL,
    categoria   VARCHAR(50)   NOT NULL,
    descricao   TEXT,
    ano_criacao INT,
    status      ENUM('ativo','inativo') NOT NULL DEFAULT 'ativo',
    criado_em   DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ════════════════════════════════════════════════════════════
-- TABELA: projetos
-- ════════════════════════════════════════════════════════════
-- Projetos do portfólio (já existia em portfolio antigo).
-- Agora com ciclo de vida explícito via 'status':
--
--   rascunho   → projeto salvo, ainda não publicado
--                (default ao criar — exige decisão consciente
--                para tornar público)
--   publicado  → visível em projetos.php
--   arquivado  → equivalente ao "excluído" — não aparece mais
--                em lugar nenhum, mas o registro permanece
--                para histórico. Padrão chamado SOFT-DELETE.
--
-- 'atualizado_em' com ON UPDATE CURRENT_TIMESTAMP: o MariaDB
-- preenche essa coluna AUTOMATICAMENTE a cada UPDATE no registro.
-- Não precisa lembrar de atualizar no PHP — o banco cuida.
CREATE TABLE projetos (
    id            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(120)  NOT NULL,
    descricao     TEXT          NOT NULL,
    tecnologias   VARCHAR(200)  NOT NULL,
    link_github   VARCHAR(300)      NULL DEFAULT NULL,
    ano           YEAR          NOT NULL,
    status        ENUM('rascunho','publicado','arquivado')
                                NOT NULL DEFAULT 'rascunho',
    criado_em     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME          NULL DEFAULT NULL
                                ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ════════════════════════════════════════════════════════════
-- TABELA: logs
-- ════════════════════════════════════════════════════════════
-- Trilha de auditoria. NUNCA apagamos linhas daqui — apenas
-- inserimos. Cada operação relevante registra:
--
--   tabela_afetada → qual tabela mudou
--   registro_id    → id do registro afetado
--   acao           → o que aconteceu
--   usuario_login  → quem executou (NULL = sistema/automático)
--   detalhes       → contexto livre ('alterou status para arquivado')
--
-- A regra de ouro: se um dia precisarmos responder
-- "quem mudou esse projeto e quando?", esta tabela responde.
CREATE TABLE logs (
    id             INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    tabela_afetada VARCHAR(50)   NOT NULL,
    registro_id    INT UNSIGNED  NOT NULL,
    acao           ENUM('INSERT','UPDATE','STATUS') NOT NULL,
    usuario_login  VARCHAR(50)       NULL DEFAULT NULL,
    detalhes       TEXT              NULL,
    criado_em      DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ════════════════════════════════════════════════════════════
-- DADOS INICIAIS
-- ════════════════════════════════════════════════════════════

-- IMPORTANTE: substitua a string abaixo pelo hash que você gerou
-- com: php -r "echo password_hash('admin2026', PASSWORD_BCRYPT);"
-- O hash autêntico começa com $2y$ e tem 60 caracteres.
INSERT INTO usuarios (login, senha, email) VALUES
  ('admin', '$2y$10$4ppoX9CtkiVPMHk1PZv5Fe8F4eW1bzctttT41MiqZUzEyUTGdk0ie', 'admin@portfolio.local');

-- Tecnologias: status assume 'ativo' por DEFAULT — não precisa listar.
INSERT INTO tecnologias (nome, categoria, descricao, ano_criacao) VALUES
  ('HTML',       'Frontend',       'Linguagem de marcação para estrutura de páginas web.', 1993),
  ('CSS',        'Frontend',       'Linguagem de estilos para apresentação visual.',       1996),
  ('JavaScript', 'Frontend',       'Linguagem de programação para o navegador.',           1995),
  ('PHP',        'Backend',        'Linguagem server-side para web dinâmica.',             1994),
  ('MariaDB',    'Banco de Dados', 'SGBD relacional open-source.',                         2009),
  ('Git',        'DevOps',         'Sistema de controle de versão distribuído.',           2005);

-- Projetos: explicitamos status='publicado' porque o DEFAULT
-- é 'rascunho' — queremos que esses dois apareçam no site público
-- imediatamente após o setup.
INSERT INTO projetos (nome, descricao, tecnologias, ano, status) VALUES
  ('Portfólio Pessoal',
   'Site de portfólio com PHP, PDO e MariaDB.',
   'PHP, MariaDB, CSS', 2026, 'publicado'),
  ('Formulário de Contato',
   'Formulário com validação no servidor e padrão PRG.',
   'PHP, HTML, CSS',    2026, 'publicado');