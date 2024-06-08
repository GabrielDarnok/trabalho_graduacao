# Loja de Ferragens e Materiais de Construção

Este projeto é um e-commerce desenvolvido como trabalho de graduação. A aplicação permite que usuários naveguem e selecionem produtos fornecidos pela loja Zapolla. O projeto utiliza o framework Laravel para o backend e MySQL como banco de dados.

## Funcionalidades

- **Cadastro de Usuários**: Permite que novos usuários se registrem e façam login.
- **Catálogo de Produtos**: Exibição de uma lista de produtos disponíveis, categorizados por tipo.
- **Carrinho de Compras**: Usuários podem adicionar produtos ao carrinho e gerenciar suas seleções.
- **Processamento de Pedidos**: Finalização de compras com opções de pagamento e confirmação de pedidos.
- **Painel Administrativo**: Área restrita para gerenciamento de produtos, categorias e pedidos.
- **Sistema de Avaliação**: Usuários podem avaliar e comentar produtos comprados.

## Tecnologias Utilizadas

- **Framework**: Laravel 8
- **Banco de Dados**: MySQL
- **Frontend**: Blade Templating Engine, Bootstrap, JavaScript
- **Autenticação**: Laravel Breeze
- **Serviço de Email**: Laravel Mail para notificações de pedidos

## Pré-requisitos

- PHP >= 8.1
- Composer
- MySQL
- Node.js (para gerenciamento de pacotes frontend)

## Instalação

1. Clone o repositório:

    git clone https://github.com/seu-usuario/nome-do-repositorio.git
    

2. Navegue até o diretório do projeto:
    
    cd nome-do-repositorio
    

3. Instale as dependências do backend usando o Composer:
    
    composer install
    

4. Instale as dependências do frontend usando o NPM:
    
    npm install
    

5. Copie o arquivo `.env.example` para `.env`:
    
    cp .env.example .env
    

6. Configure o arquivo `.env` com suas informações de banco de dados e outras configurações necessárias.

7. Gere a chave da aplicação Laravel:
    
    php artisan key:generate
    

8. Execute as migrações para criar as tabelas no banco de dados:
    
    php artisan migrate
    

9. (Opcional) Popule o banco de dados com dados fictícios:
    
    php artisan db:seed
    

10. Inicie o servidor de desenvolvimento:
    
    php artisan serve
    
11. Inicie o node:
    
    npm run dev

## Uso

- Acesse a aplicação no navegador através do endereço:
  
  http://localhost:8000
  
## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

## Contato

- **Autor**: Gabriel Henrique Almeida Silva e Matheus Gomes de Souza
- **Email**: silva0349@gmail.com
- **Autor**: Matheus Gomes de Souza
- **Email**: matheussgomes2@gmail.com
- **LinkedIn**: [Gabriel Henrique](https://www.linkedin.com/in/gabriel-henrique-54049a215/)

---

## Agradecimentos

Agradecemos a todos os colegas, professores e o orientador que contribuíram direta ou indiretamente para a realização deste projeto.

---