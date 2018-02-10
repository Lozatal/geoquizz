# GéoQuizz
Quizz où on doit placer des photos sur une carte

Fichier SQL contenant la base de données : geoquizz\backend\sql\geoquizz_base_table_data.sql

DOCS:
Backoffice : geoquizz\doc\backoffice\doc\index.html
Player: geoquizz\doc\player\doc\index.html

Les commandes ci-dessous sont à lancé dans leurs dossiers respectifs.

## Player

> A Vue.js project

### Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report
```

For a detailed explanation on how things work, check out the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).

## Backend

> A Eloquent/Slim/Twig/Bootstrap project

Pour démarrer le backend et accéder au backoffice

### Build Setup

``` bash
# install dependencies
docker-compose up

# run container
docker-compose start
```
#### Change in hosts

``` bash
127.0.0.1	backoffice.geoquizz.local
127.0.0.1	player.geoquizz.local
```

