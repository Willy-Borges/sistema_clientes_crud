Sistema de Clientes – CRUD em PHP

Sistema simples de cadastro de clientes (CRUD) desenvolvido em PHP, MySQL, HTML, CSS e JavaScript.
Permite cadastrar, pesquisar, editar, listar e excluir clientes. Inclui validações no frontend e backend.


## Estrutura de Pastas
```text
crud-php/
│
├── frontend/
│   ├── css/
│   │   └── style.css
│   ├── img/
│   └── js/
│       ├── buttons.js
│       ├── masks.js
│       ├── pesquisar.js
│       └── script.js
│
├── conexao.php
├── novo.php
├── salvar.php
├── editar.php
├── excluir.php
├── pesquisar.php
├── listar.php
├── index.html
└── sistema_clientes.sql
```

## Instalação e Uso

## 1. Requisitos
XAMPP ou WAMP instalado
PHP 7+
MySQL
Navegador


## Instalar o Banco
1 - Abra phpMyAdmin
2 - Crie um banco chamado: sistema_clientes
3 - Importe o arquivo: sistema_clientes.sql

## Executar o sistema
1 - Coloque a pasta crud-php dentro de: C:\xampp\htdocs\
2 - Inicie o Apache e MySQL no XAMPP
3 - Abra no navegador: http://localhost/crud-php/index.html

## 🔧 Funcionalidades
✔ Cadastrar cliente
✔ Pesquisar por código, nome, cpf, email ou celular
✔ Se encontrar mais de um, abre modal com lista
✔ Editar dados existentes
✔ Excluir clientes
✔ Listagem completa em ordem crescente
✔ Validação de campos obrigatórios
✔ Máscaras de CPF, celular e outros campos

## 📦 Backup do Banco
O arquivo sistema_clientes.sql dentro do projeto permite recriar todo o banco com uma importação.

## 🛠 Tecnologias Usadas
PHP
MySQL
HTML5
CSS3
JavaScript
XAMPP
