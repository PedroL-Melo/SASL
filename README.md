# 🏫 SASL - Sistema de Agendamento de Salas e Laboratórios

Um sistema web prático e eficiente desenvolvido para gerenciar reservas de espaços acadêmicos, garantindo que professores e alunos tenham acesso organizado às salas de aula e laboratórios. Projeto desenvolvido como parte dos requisitos do curso de Informática para Internet do IFAC.

## 🚀 Tecnologias Utilizadas

O projeto foi construído utilizando a arquitetura **MVC** (Model-View-Controller) para garantir um código limpo e organizado, com as seguintes ferramentas:

* **[Laravel](https://laravel.com/)**: Framework PHP robusto para a estruturação do back-end.
* **[Tailwind CSS](https://tailwindcss.com/)**: Framework CSS utilitário para garantir um front-end moderno, ágil e responsivo (via Laravel Breeze).
* **[MariaDB](https://mariadb.org/)**: Banco de dados relacional (gerenciado via **XAMPP**).

## ⚙️ Pré-requisitos

Antes de rodar o projeto, você vai precisar das seguintes ferramentas instaladas na sua máquina:
* [XAMPP](https://www.apachefriends.org/pt_br/index.html) (com Apache e MySQL ativados)
* [Composer](https://getcomposer.org/) (Gerenciador de dependências do PHP)
* [Node.js e NPM](https://nodejs.org/) (Gerenciador de pacotes do front-end)
* [Git](https://git-scm.com/)

## 🛠️ Como rodar o projeto localmente

Siga o passo a passo abaixo para rodar o SASL no seu computador:

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/PedroL-Melo/SASL.git
    ```

2.  **Acesse a pasta do projeto:**
    ```bash
    cd SASL
    ```

3.  **Instale as dependências do PHP (Laravel):**
    ```bash
    composer install
    ```

4.  **Instale as dependências do Front-end (Vite/Tailwind):**
    ```bash
    npm install
    ```

5.  **Configure o ambiente:**
    * Faça uma cópia do arquivo `.env.example` e renomeie para `.env`.
    * Abra o arquivo `.env` e configure a conexão com o banco de dados do XAMPP:
        ```env
        DB_CONNECTION=mariadb
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=sasl_db  # (Lembre-se de criar este banco no phpMyAdmin)
        DB_USERNAME=root
        DB_PASSWORD=
        ```

6.  **Gere a chave de criptografia da aplicação:**
    ```bash
    php artisan key:generate
    ```

7.  **Crie as tabelas no banco de dados:**
    *Certifique-se de que o Apache e o MySQL estão rodando no painel do XAMPP.*
    ```bash
    php artisan migrate
    ```

8.  **Compile os arquivos de CSS/JavaScript (Front-end):**
    ```bash
    npm run build
    ```
    *(Para quem for desenvolver e editar o código ao vivo, utilize `npm run dev` em um terminal separado).*

9.  **Inicie o servidor local (Back-end):**
    ```bash
    php artisan serve
    ```

Acesse no seu navegador: `http://localhost:8000`

## 👥 Equipe de Desenvolvimento

Projeto desenvolvido em equipe por:
* **Pedro Lucas**
* **Aline Vitória**
* **Esther Motta**
* **Ana Letícia**
* **Vinícius Santos**
* **Giovanni Santos**