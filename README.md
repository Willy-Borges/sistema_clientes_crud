Sistema de Clientes – CRUD em PHP

Sistema simples de cadastro de clientes (CRUD) desenvolvido em PHP, MySQL, HTML, CSS e JavaScript.
Permite cadastrar, pesquisar, editar, listar e excluir clientes. Inclui validações no frontend e backend.


## Estrutura de Pastas
```text
crud-php/
│
├── frontend/                 
│   ├── css/
│   │   └── style.css           # Estilos do layout e formatação visual
│   ├── img/                    # Ícones usados nos botões e interface
│   ├── js/
│   │   ├── buttons.js          # Lógica dos botões (listar, novo, limpar etc.)
│   │   ├── masks.js            # Máscaras de CPF, celular e outros campos
│   │   ├── pesquisar.js        # Função para pesquisa com modal
│   │   └── script.js           # Funções gerais da interface
│
├── conexao.php                 # Conexão com o banco de dados (MySQL)
├── novo.php                    # Formulário para cadastrar novo cliente
├── salvar.php                  # Grava os dados do novo cliente no banco
├── editar.php                  # Carrega dados e salva edições
├── excluir.php                 # Exclui um cliente do sistema
├── pesquisar.php               # Backend da pesquisa (retorna resultados)
├── listar.php                  # Lista completa dos clientes cadastrados
├── index.html                  # Tela inicial do sistema
└── sistema_clientes.sql        # Script para criar o banco + tabela

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
