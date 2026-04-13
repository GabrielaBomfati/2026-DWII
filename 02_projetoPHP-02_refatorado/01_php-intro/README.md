# Portfólio Dinâmico — Aula 03 DWII

Mini-site de portfólio pessoal desenvolvido em PHP puro.
Gerado dinamicamente com variáveis, includes e condicionais.

## Como executar

```
cd ~/workspaces/2026-DWII
php -S localhost:8001 -t 01_php-intro/
```

Acesse: http://localhost:8001

## Estrutura de arquivos

- index.php        — página inicial com apresentação
- sobre.php        — página de biografia
- projetos.php     — lista de projetos
- includes/
  - cabecalho.php  — cabeçalho HTML compartilhado
  - rodape.php     — rodapé HTML compartilhado
  - nav.php        — menu dinâmico com destaque na página ativa