# 📁 Projeto PHP Refatorado — Portfólio DWII

## 📌 Sobre o projeto

Este projeto consiste em um portfólio pessoal desenvolvido em PHP na disciplina de Desenvolvimento Web II (DWII).

O objetivo do sistema é apresentar informações pessoais do aluno, como descrição, formação acadêmica e navegação entre páginas, utilizando boas práticas de desenvolvimento web com PHP.

---

## 🗂️ Estrutura de arquivos

```bash
02_projetoPHP-02_refatorado/
│
├── index.php
├── sobre.php
│
├── includes/
│   ├── cabecalho.php
│   ├── nav.php
│   ├── rodape.php
│   └── style.css
│
```

---

## 🔧 Decisões de refatoração

### 1. Modularização do layout

**Problema:**
O código HTML (cabeçalho, menu e rodapé) estava repetido em várias páginas.

**Solução:**
Separação em arquivos reutilizáveis dentro da pasta `includes/`:

* `cabecalho.php`
* `nav.php`
* `rodape.php`

**Motivo técnico:**
Reduz duplicação de código e centraliza a manutenção do layout.

---

### 2. Uso de caminhos dinâmicos

**Problema:**
Links para CSS, páginas e imagens poderiam quebrar dependendo da pasta da página.

**Solução:**
Criação da variável `$caminho_raiz` para montar caminhos dinâmicos.

**Motivo técnico:**
Permite que os arquivos sejam acessados corretamente independentemente da estrutura de diretórios.

---

### 3. Destaque da página ativa no menu

**Problema:**
O menu de navegação não indicava qual página estava ativa, ou seja em que página o usuário estava.

**Solução:**
Uso da variável `$pagina_atual` junto com a função `menu_class()` no `nav.php`.

**Motivo técnico:**
Melhora a usabilidade e evita repetição de código com operadores ternários.

---

### 4. Uso de `htmlspecialchars()` para segurança

**Problema:**
Dados estavam sendo exibidos diretamente no HTML.

**Solução:**
Aplicação da função `htmlspecialchars()` na saída de variáveis.

**Motivo técnico:**
Evita vulnerabilidades do tipo Cross-Site Scripting (XSS).

---

### 5. Uso de fallback com isset()

**Problema:**
Variáveis como $titulo_pagina ou $pagina_atual poderiam não estar definidas.

**Solução:**
Definição de valores padrão usando `isset()` no cabecalho.php e nav.php.

**Motivo técnico:**
Evita warnings(avisos) e torna os arquivos reutilizáveis sem dependência rígida.

---


## ▶️ Como executar

1. Acesse a pasta do projeto no terminal:

```bash
cd 02_projetoPHP-02_refatorado
```

2. Inicie o servidor PHP:

```bash
php -S localhost:8000
```

3. Acesse no navegador:

```
http://localhost:8000
```

---

## 👩‍💻 Autor

Gabriela Bomfati Garcia  
Curso: Técnico em Informática  
Instituição: IFPR — Ponta Grossa  
Disciplina: Desenvolvimento Web II (DWII)  
Ano: 2026  
