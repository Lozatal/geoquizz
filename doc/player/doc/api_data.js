define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "C__Daniel_wamp64_www_html_geoquizz_doc_player_doc_main_js",
    "groupTitle": "C__Daniel_wamp64_www_html_geoquizz_doc_player_doc_main_js",
    "name": ""
  },
  {
    "type": "post",
    "url": "/parties",
    "title": "Créer une partie",
    "group": "Parties",
    "name": "createPartie",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type Partie: permet d'ajouter une ressource partie. Retourne une représentation json de la ressource, incluant son id, token, pseudo, son nombre de photos maximum, son status, le score est vide</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "nb_photos",
            "description": "<p>Nombre de photos a afficher lors de la partie</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "joueur",
            "description": "<p>Pseudo du joueur</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "id_serie",
            "description": "<p>Uuid de la série</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "Created",
            "description": "<p>représentation json de la nouvelle ressource partie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\n{\n   partie : {\n         \"id\"  : \"02b0a1df-1766-4fb3-adfe-7e418e27b0fa\",\n         \"token\" : \"ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced\",\n         \"nb_photos\" : \"10\",\n         \"status\" : \"0\",\n         \"score\" : \"\",\n         \"joueur\" : \"Dupont\",\n         \"id_serie\" : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\"\n   }\n}",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "Bad",
            "description": "<p>request paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n   \"Bad request\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Parties"
  },
  {
    "type": "get",
    "url": "/parties/{id}",
    "title": "accéder à une partie en fonction d'un id",
    "group": "Parties",
    "name": "getPartie",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources d'une partie en particulier permet d'accéder à la représentation des ressources d'une partie Retourne une représentation json des ressources, incluant l'id, la ville, localisation ainsi que la distance, la série et les photos.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "id",
            "description": "<p>uuid de la partie à rechercher</p>"
          }
        ],
        "request parameter": [
          {
            "group": "request parameter",
            "type": "Varchar",
            "optional": false,
            "field": "Token",
            "description": "<p>TokenJWT</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   partie : {\n         \"id\"  : \"02b0a1df-1766-4fb3-adfe-7e418e27b0fa\",\n         \"token\" : \"ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced\",\n         \"nb_photos\" : \"10\",\n         \"status\" : \"1\",\n         \"score\" : \"20\",\n         \"joueur\" : \"Dupont\",\n         \"id_serie\" : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\",\n         \"serie\": {\n           \"id\": \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\",\n           \"ville\": \"Seoul\",\n           \"map_refs\": \"1\",\n           \"dist\": \"100\"\n         },\n         \"photos\": [\n           {\n               \"id\": 1,\n               \"description\": \"palais\",\n               \"position_long\": \"10\",\n               \"position_lat\": \"10\",\n               \"url\": \"https://www.hkexpress.com/sites/default/files/seoul.jpg\",\n               \"id_serie\": \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\"\n           },\n           {\n               \"id\": 2,\n               \"description\": \"temple\",\n               \"position_long\": \"10\",\n               \"position_lat\": \"10\",\n               \"url\": \"https://tripagency.info/wp-content/uploads/2016/04/seoul.jpg\",\n               \"id_serie\": \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\"\n           }\n         ]\n   }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Pas de partie dans la base de données avec cette id.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Parties"
  },
  {
    "type": "get",
    "url": "/parties",
    "title": "accéder aux 10 meilleurs parties",
    "group": "Parties",
    "name": "partiesListe",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources des 10 meilleurs parties (meilleur score) permet d'accéder à la représentation des ressources de ces 10 parties Retourne une représentation json de collection de ressources, incluant l'id, le token, la ville, localisation ainsi que la distance.</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   \"type\" : \"collection\",\n   partie : {\n         \"id\"  : \"02b0a1df-1766-4fb3-adfe-7e418e27b0fa\",\n         \"token\" : \"ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced\",\n         \"nb_photos\" : \"10\",\n         \"status\" : \"1\",\n         \"score\" : \"20\",\n         \"joueur\" : \"Dupont\",\n         \"id_serie\" : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\",\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Parties"
  },
  {
    "type": "get",
    "url": "/parties/player/{player}",
    "title": "accéder aux parties d'un joueur",
    "group": "Parties",
    "name": "partiesListePlayer",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources des parties d'un joueur en particulier permet d'accéder à la représentation des ressources de ces parties Retourne une représentation json de collection de ressources, incluant l'id, le token, la ville, localisation ainsi que la distance.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "player",
            "description": "<p>nom du joueur a rechercher</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   \"type\" : \"collection\",\n   partie : {\n         \"id\"  : \"02b0a1df-1766-4fb3-adfe-7e418e27b0fa\",\n         \"token\" : \"ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced\",\n         \"nb_photos\" : \"10\",\n         \"status\" : \"1\",\n         \"score\" : \"20\",\n         \"joueur\" : \"Dupont\",\n         \"id_serie\" : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\"\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Parties"
  },
  {
    "type": "put",
    "url": "/parties/{id}",
    "title": "modifier le score et l'état d'une partie",
    "group": "Parties",
    "name": "updateScorePartie",
    "version": "0.1.0",
    "description": "<p>Accès à unes ressource de type partie : Permet de modifier le score d'une partie, modifier automatiquement l'état de la partie en terminé, lorsque le joueur a terminé sa partie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "id",
            "description": "<p>Uuid unique de la partie à modifier</p>"
          }
        ],
        "request parameter": [
          {
            "group": "request parameter",
            "type": "Varchar",
            "optional": false,
            "field": "Token",
            "description": "<p>TokenJWT</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   partie : {\n         \"id\"  : \"02b0a1df-1766-4fb3-adfe-7e418e27b0fa\",\n         \"token\" : \"ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced\",\n         \"nb_photos\" : \"10\",\n         \"status\" : \"1\",\n         \"score\" : \"42\",\n         \"joueur\" : \"Dupont\",\n         \"id_serie\" : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\"\n   }\n}",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 404": [
          {
            "group": "Réponse : 404",
            "optional": false,
            "field": "Not",
            "description": "<p>found identifiant de la partie non valide</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not found\n{\n   \"Bad request\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Parties"
  },
  {
    "type": "get",
    "url": "/seriesNbImage",
    "title": "accéder à toutes les séries 'active' (avec des photos) ainsi que le nombre d'images",
    "group": "Series",
    "name": "getSeriesEtImages",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type série : permet d'accéder à la représentation des ressources séries sans pagination avec le total du nombre d'images liées à cette série. Retourne une représentation json des ressources, incluant leur id, ville, localisation ainsi que la distance et le nombre d'image.</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   \"type\" : \"collection\",\n     serie : {\n         \"id\"  : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\",\n         \"ville\" : \"Lyon\",\n         \"description\" : \"Une série de photos concernant la ville de lyon\",\n         \"serie_lat\" : \"45.75\",\n         \"serie_long\" : \"4.85\",\n         \"dist\" : \"100\",\n         \"nb_images\" : 10\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "get",
    "url": "/series/{id}",
    "title": "accéder à une série en fonction d'un id",
    "group": "Series",
    "name": "getSeriesID",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources d'une série en particulier permet d'accéder à la représentation des ressources d'une série Retourne une représentation json des ressources, incluant l'id, la ville, localisation ainsi que la distance.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "varchar",
            "optional": false,
            "field": "id",
            "description": "<p>uuid de la série à rechercher</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   serie : {\n         \"id\"  : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\",\n         \"ville\" : \"Lyon\",\n         \"description\" : \"Une série de photos concernant la ville de lyon\",\n         \"serie_lat\" : \"45.75\",\n         \"serie_long\" : \"4.85\",\n         \"dist\" : \"100\"\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "get",
    "url": "/series",
    "title": "accéder à toutes les séries",
    "group": "Series",
    "name": "getSeriesSansPagination",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type série : permet d'accéder à la représentation des ressources séries sans pagination. Retourne une représentation json des ressources, incluant leur id, ville, localisation ainsi que la distance (difficulté).</p>",
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n{\n   \"type\" : \"collection\",\n     serie : {\n         \"id\"  : \"0722ceee-16d9-4c68-b147-25d8bbcc9bd6\",\n         \"ville\" : \"Lyon\",\n         \"description\" : \"Une série de photos concernant la ville de lyon\",\n         \"serie_lat\" : \"45.75\",\n         \"serie_long\" : \"4.85\",\n         \"dist\" : \"100\"\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  }
] });
