# codeigniter-nuxt

> codeigniter 3.1.10 + nuxtjs 2.13.1
>
> server: codeigniter
> client: nuxtjs

## Git Clone

```bash
# xampp active directory
$ git clone https://github.com/camelg/codeigniter-nuxt.git
$ cp .env.example .env
```

## Composer Install

```bash
$ composer install
```

## Build Setup

```bash
# install dependencies
$ npm install

# serve with hot reload at localhost:3000
$ npm run dev

# build for production and launch server
$ npm run build

# generate static project
$ npm run generate
```

For detailed explanation on how things work, checkout [Nuxt.js docs](https://nuxtjs.org).

## Apache Config

httpd-vhosts.conf

```bash
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\codeigniter-nuxt\public_html\api"
    ServerName api.codeigniter-nuxt
</VirtualHost>
```
