define({ "api": [
  {
    "type": "post",
    "url": "/",
    "title": "Page de connexion au backoffice",
    "group": "Comptes",
    "name": "loginPost",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Request",
            "optional": false,
            "field": "req",
            "description": "<p>Requête</p>"
          },
          {
            "group": "Parameter",
            "type": "Response",
            "optional": false,
            "field": "resp",
            "description": "<p>Réponse</p>"
          },
          {
            "group": "Parameter",
            "type": "array",
            "optional": false,
            "field": "args",
            "description": "<p>Tableau d'argument</p>"
          }
        ]
      }
    },
    "description": "<p>Accès à la page de connexion : Permet d'accéder au formulaire de connexion. Retourne un affichage html/css du formulaire.</p>",
    "success": {
      "fields": {
        "Succès : 301": [
          {
            "group": "Succès : 301",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers la page /Backoffice</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
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
    "group": "_var_www_html_geoquizz_doc_backoffice_doc_main_js",
    "groupTitle": "_var_www_html_geoquizz_doc_backoffice_doc_main_js",
    "name": ""
  }
] });
