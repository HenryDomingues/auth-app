<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo"></a></p>

<p align="center">
  <b>Tecnologias usadas:</b><br>
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white" alt="PHP 8.x"> 
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white" alt="Laravel 10"> 
  <img src="https://img.shields.io/badge/JavaScript-ES2021-F7DF1E?logo=javascript&logoColor=black" alt="JavaScript"> 
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?logo=tailwindcss&logoColor=white" alt="Tailwind CSS"> 
  <img src="https://img.shields.io/badge/HTML5-5ED8FF?logo=html5&logoColor=white" alt="HTML5"> 
  <img src="https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white" alt="CSS3"> 
  <img src="https://img.shields.io/badge/Node.js-18.x-339933?logo=node.js&logoColor=white" alt="Node.js">
</p>

# auth-app

Aplicação Laravel de exemplo com autenticação, CRUD de categorias e posts, upload de imagens
e frontend com TailwindCSS + Vite.

Este README descreve a estrutura do projeto, funcionalidades e os passos para baixar, configurar
e rodar a aplicação localmente no Windows (XAMPP ou PHP built-in).

> Feito por Henry Domingues

## Principais funcionalidades

- Autenticação de usuários (registro/login).
- CRUD de `categorias` e `posts` (criar, listar, editar, deletar).
- Upload de imagens para posts (armazenadas em `storage/app/public` e acessíveis via
	`public/storage`).
- Frontend com Blade + TailwindCSS gerenciado por Vite.

## Estrutura resumida do projeto

- `app/Http/Controllers/` — controllers (PostController, CategoriaController, etc.)
- `app/Models/` — modelos Eloquent (`Post`, `Categoria`, `User`)
- `resources/views/` — views Blade (layouts, posts, categorias, auth)
- `resources/css/` e `resources/js/` — assets frontend (Tailwind entry)
- `routes/web.php` — rotas (o projeto usa `Route::resource('posts', PostController::class)`)
- `database/migrations/` — migrations para criar tabelas
- `storage/app/public` — arquivos de upload (imagens)

## Pré-requisitos

- PHP 8.x compatível
- Composer
- Node.js + npm
- MySQL (ou outro DB suportado) — XAMPP inclui MySQL/MariaDB
- Git (opcional)

## O que é npm e Composer?

- `npm` é o gerenciador de pacotes do Node.js. Ele instala as dependências JavaScript e ferramentas de frontend usadas no projeto,
  como o Vite e o Tailwind CSS. No `auth-app`, você usa `npm install` para baixar essas dependências e `npm run dev` ou `npm run build`
  para gerar o CSS e o JavaScript da aplicação.

- `Composer` é o gerenciador de pacotes do PHP. Ele instala bibliotecas e dependências do backend Laravel, como o próprio framework,
  provedores de autenticação, e outras ferramentas PHP necessárias. No projeto, `composer install` prepara o ambiente PHP.

## Passo a passo: baixar e executar (Windows)

1) Clone o repositório ou copie a pasta para `C:\xampp\htdocs\auth-app`:

```bash
git clone <REPO_URL> auth-app
cd auth-app
```

2) Instale dependências PHP:

```powershell
composer install
```

3) Instale dependências Node e rode build (ou dev):

```powershell
npm install
# Para desenvolvimento com hot-reload (Vite):
npm run dev
# Ou para gerar assets de produção:
npm run build
```

4) Configure o ambiente:

```powershell
copy .env.example .env
php artisan key:generate
# Edite o arquivo .env para ajustar DB_*, APP_URL, e-mail, etc.
```

5) Crie o banco de dados e rode migrations (use phpMyAdmin se estiver no XAMPP):

```powershell
php artisan migrate
php artisan db:seed   # opcional
```

6) Crie o link público para os uploads:

```powershell
php artisan storage:link
```

7) Execute a aplicação:

```powershell
php artisan serve
# Acesse: http://127.0.0.1:8000
```

Se estiver usando XAMPP/Apache, coloque a pasta em `C:\xampp\htdocs\` e acesse
`http://localhost/auth-app/public` (ou configure um virtual host).

## Uso rápido

- Rotas principais (após login):
	- `/posts` — lista de posts
	- `/posts/create` — criar post (com upload de imagem)
	- `/posts/{id}/edit` — editar post (substituir/remover imagem)
	- `/categorias` — CRUD de categorias

## Upload de imagens

- Imagens são salvas em `storage/app/public/posts` (via `store('posts', 'public')`).
- Para que apareçam publicamente, execute `php artisan storage:link` — isso cria
	`public/storage` apontando para `storage/app/public`.

## Tailwind / Vite

- O layout base deve incluir `@vite(['resources/css/app.css','resources/js/app.js'])` em
	`resources/views/layouts/app.blade.php` para carregar os assets gerados.
- Se o CSS não carregar, rode `npm run dev` (desenvolvimento) ou `npm run build` (produção)
	e verifique se `public/build` foi gerado.

## Solução de problemas comuns

- Formulário volta para a tela de edição: verifique mensagens de validação exibidas no topo
	do formulário; também confira `storage/logs/laravel.log` para exceções.
- Imagens não aparecem: rode `php artisan storage:link` e verifique permissões em
	`storage/` e `public/storage`.
- CSS/Tailwind não aparece: verifique `@vite` no layout e execute `npm run dev`.

## Seção específica: comandos no PowerShell

Use estes comandos no PowerShell dentro da pasta `auth-app`:

```powershell
# instalar dependências PHP
composer install

# instalar dependências Node
npm install

# gerar build de assets
npm run build

# copiar .env e gerar chave
copy .env.example .env
php artisan key:generate

# rodar migrations
php artisan migrate

# criar link storage para uploads de imagem
php artisan storage:link

# iniciar servidor local
php artisan serve
```

Se precisar, substitua `php artisan serve` por `npm run dev` para desenvolvimento com hot reload.

---
