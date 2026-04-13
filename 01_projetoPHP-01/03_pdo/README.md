# 📦 Catálogo de Tecnologias

Projeto desenvolvido para a disciplina **Desenvolvimento Web II (DWII)**, com foco em persistência de dados utilizando **PHP + PDO + MariaDB**.

---

## 📖 Descrição

Este projeto consiste em um catálogo de tecnologias onde é possível:

* Visualizar todas as tecnologias cadastradas
* Filtrar por categoria
* Buscar por nome ou descrição
* Visualizar detalhes de cada tecnologia
* Navegar mantendo filtros ativos

O sistema segue boas práticas como uso de **PDO**, proteção contra **XSS** e organização em múltiplos arquivos.

---

## 🗄️ Estrutura da Tabela

Tabela: `tecnologias`

| Campo       | Tipo         | Descrição                          |
| ----------- | ------------ | ---------------------------------- |
| id          | INT (PK)     | Identificador único                |
| nome        | VARCHAR(100) | Nome da tecnologia                 |
| categoria   | VARCHAR(50)  | Categoria (Frontend, Backend, etc) |
| descricao   | TEXT         | Descrição da tecnologia            |
| ano_criacao | INT          | Ano de criação                     |
| criado_em   | TIMESTAMP    | Data de cadastro (automática)      |

---

## ⚙️ Instruções de Setup

### 1. Criar o banco de dados

```sql
CREATE DATABASE dwii_db;
USE dwii_db;
```

---

### 2. Criar a tabela

```sql
CREATE TABLE tecnologias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao TEXT,
    ano_criacao INT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

### 3. Inserir dados iniciais

```sql
INSERT INTO tecnologias (nome, categoria, descricao, ano_criacao) VALUES
('HTML',       'Frontend',  'Linguagem de marcação para estrutura de páginas web.', 1993),
('CSS',        'Frontend',  'Linguagem de estilos para apresentação visual de páginas.', 1996),
('PHP',        'Backend',   'Linguagem server-side amplamente usada para web dinâmica.', 1994),
('MariaDB',    'Banco de Dados', 'Sistema de gerenciamento de banco de dados relacional open-source.', 2009),
('JavaScript', 'Frontend',  'Linguagem de programação para interatividade no navegador.', 1995),
('Git',        'DevOps',    'Sistema de controle de versão distribuído.', 2005);
```

---

## 🛠️ Tecnologias Utilizadas

* PHP
* PDO
* MariaDB
* HTML
* CSS

---

## ✅ Funcionalidades

* Listagem de dados com `fetchAll()`
* Busca com `LIKE`
* Filtro por categoria
* Página de detalhes com `prepare()`
* Página 404 personalizada
* Proteção XSS com `htmlspecialchars()`

---
