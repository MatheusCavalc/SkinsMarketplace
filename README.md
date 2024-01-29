# Instalando o projeto

Este repositório contém um projeto web completo com backend em Laravel, frontend em Vue.js e aplicativo mobile em Ionic Vue. Siga as instruções abaixo para instalar e configurar o ambiente de desenvolvimento. O projeto necessita PHP 8.1, Node, Npm, Composer e MySQL instalados na máquina.

### Passos para o rodar o projeto localmente:

- Faça um clone do projeto para sua máquina local
- Navegue até o diretório do backend:
```shell
cd backend-marketplace
```
- Execute o comando abaixo para instalar as dependências do backend:
```shell
composer install
```
- Copie o arquivo .env.example, renomeie para .env e preencha com suas informações de banco de dados e outras configurações relevantes. Você pode fazer isso executando o seguinte comando:
```shell
cp .env.example .env
```
- Gere uma chave de aplicativo Laravel usando o seguinte comando:
```shell
php artisan key:generate
```
- Execute o comando abaixo para popular o banco de dados com as tabelas necessárias para a aplicação:
```shell
php artisan migrate
```
- Para iniciar o servidor do backend execute o comando em um terminal:
```shell
php artisan serve
```
- O servidor do backend deve ter o seguinte endereço:
```shell
http://127.0.0.1:8000/
```

- Volte para a raiz do projeto e vá para a pasta frontend-marketplace:
```shell
cd ..
```
```shell
cd frontend-marketplace
```
- Execute o comando abaixo para instalar as dependências do frontend-marketplace:
```shell
npm install
```
- Execute o comando abaixo para compilar e subir a aplicação web:
```shell
npm run serve
```
- O frontend estará acessível em:
```shell
http://localhost:5173/
```

- Volte para a raiz do projeto e vá para a pasta ionic-marketplace:
```shell
cd ..
```
```shell
cd ionic-marketplace
```
- Instale as dependências do Ionic:
```shell
npm install -g @ionic/cli
```
- Execute o comando abaixo para instalar as dependências do ionic app:
```shell
npm install
```
- Inicie o servidor de desenvolvimento:
```shell
ionic serve
```
- O aplicativo estará acessível em
```shell
http://localhost:8100/
```
