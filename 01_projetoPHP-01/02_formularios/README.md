# Formulário de Contato — Aula 04 DWII

Formulário de contato desenvolvido em PHP puro.
Para prática de processamento de formulários.

A página permite que visitantes enviem uma mensagem informando nome, e-mail, assunto e mensagem.
Os dados são validados no servidor com PHP e, se estiverem corretos, o usuário é redirecionado para uma página de confirmação.

O projeto demonstra conceitos como:

* processamento de formulários com **POST**
* uso de **$_POST e $_SERVER**
* validação de dados no servidor
* exibição de mensagens de erro
* redirecionamento usando **header() + exit (padrão PRG)**
* reaproveitamento de layout com **includes**

---

# Como executar

No terminal, dentro da pasta do projeto:

```
cd ~/workspaces/2026-DWII
php -S localhost:8001
```

Depois acesse no navegador:

```
http://localhost:8001/02_formularios/contato.php
```

---

# Estrutura de arquivos

```
02_formularios/
- contato.php      — formulário de contato com validação
- obrigado.php     — página de confirmação após envio
```

O layout do site utiliza arquivos compartilhados da pasta `includes/`:

* `cabecalho.php` — estrutura inicial da página
* `nav.php` — menu de navegação
* `rodape.php` — rodapé do site
* `style.css` - CSS global utilizado em todas as páginas

---

# Campos do formulário

O formulário contém os seguintes campos:

* **Nome**
  Campo de texto para identificar o visitante.

* **E-mail**
  Campo de e-mail para contato.

* **Assunto**
  Campo do tipo `select` com opções:

  * Dúvida
  * Proposta de trabalho
  * Colaboração
  * Outro

* **Mensagem**
  Campo de texto (`textarea`) onde o visitante escreve a mensagem.

Também é exibido um **contador de caracteres** mostrando, após o envio

```
X de 500 caracteres usados
```

---

# Validações implementadas

As validações são feitas no servidor utilizando PHP.

### Nome

* Campo obrigatório.

### E-mail

* Campo obrigatório.
* Validação de formato usando:

```
filter_var($email, FILTER_VALIDATE_EMAIL)
```

### Assunto

* Campo obrigatório.
* O usuário deve selecionar uma opção no `select`.

### Mensagem

* Campo obrigatório.
* Deve ter **mínimo de 10 caracteres**.
* Deve ter **máximo de 500 caracteres**.

Se alguma validação falhar:

* os erros são exibidos na página
* os valores digitados permanecem no formulário

---

# Funcionamento do envio

Quando o formulário é enviado:

1. Os dados são recebidos com `$_POST`
2. O servidor valida as informações
3. Se houver erro, ele é exibido ao usuário
4. Se estiver tudo correto, ocorre um redirecionamento:

```
header("Location: obrigado.php")
```

Esse redirecionamento segue o padrão **PRG (Post → Redirect → Get)**.

A página **obrigado.php** exibe:

* o nome do visitante
* o assunto da mensagem enviada
* um texto informando que a mensagem foi recebida
* um botão caso o visitante queira enviar outra mensagem

---
