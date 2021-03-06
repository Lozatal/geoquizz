define({ "api": [
  {
    "type": "get",
    "url": "/compte",
    "title": "Affiche la page de modification du compte",
    "group": "Comptes",
    "name": "getComptes",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type compte de l'utilisateur connecté : permet d'accéder à la représentation des ressources compte que l'utilisateur va pouvoir consulter et modifier, Retourne une liste de lien pour twig.</p>",
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
      }
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "get",
    "url": "/",
    "title": "Affiche la page de connexion au compte",
    "group": "Comptes",
    "name": "getComptesConnexion",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type compte : permet d'accéder à la représentation des ressources compte permettant la connexion, Retourne une liste de lien pour twig.</p>",
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
      }
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "get",
    "url": "/creerCompte",
    "title": "Affiche la page de création de compte",
    "group": "Comptes",
    "name": "getComptesCreation",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type compte : permet d'accéder à la représentation des ressources compte permettant la création d'un compte. Retourne une liste de lien pour twig.</p>",
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
      }
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "post",
    "url": "/",
    "title": "Vérification et connexion à un compte",
    "group": "Comptes",
    "name": "loginCompte",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type Compte: permet de récupérer après vérification de son éxistence une ressource compte. Redirige vers la page des séries du backoffice.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "email",
            "description": "<p>Email de l'utilisateur</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "password",
            "description": "<p>Mot de passe</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getComptesConnexion</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "email : must be valid email\npassword : must contain only letters (a-z) and digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "get",
    "url": "/logout",
    "title": "Déconnexion",
    "group": "Comptes",
    "name": "logoutCompte",
    "version": "0.1.0",
    "description": "<p>Suppression de la session utilisateur:</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers loginCompte</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "post",
    "url": "/creerCompte",
    "title": "Créer un compte",
    "group": "Comptes",
    "name": "postCompte",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type Compte: permet d'ajouter une ressource compte. Redirige vers la page de connexion.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "nom",
            "description": "<p>Pseudo de l'utilisateur</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "email",
            "description": "<p>Email de l'utilisateur</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "password",
            "description": "<p>Mot de passe</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "password_rep",
            "description": "<p>Confirmation du mot de passe</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "optional": false,
            "field": "Created",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getComptesCreation</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "nom : must contain only letters (a-z) and digits (0-9)\nemail : must be valid email\npassword : must contain only letters (a-z) and digits (0-9)\npassword_rep :must contain only letters (a-z) and digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "post",
    "url": "/compte",
    "title": "Vérification et modification d'un compte",
    "group": "Comptes",
    "name": "putCompte",
    "version": "0.1.0",
    "description": "<p>Modification d'une ressource de type Compte: permet de récupérer après vérification des mots de passes les nouvelles informations d'un compte éxistant, Rafraichit la page.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "email",
            "description": "<p>Email de l'utilisateur</p>"
          },
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "password",
            "description": "<p>Mot de passe</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getComptes</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "nom : must contain only letters (a-z) and digits (0-9)\nemail : must be valid email\npassword : must contain only letters (a-z) and digits (0-9)\npassword_rep :must contain only letters (a-z) and digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Comptes"
  },
  {
    "type": "get",
    "url": "/creerPhoto/{idSerie}",
    "title": "Affiche la page de création de photo",
    "group": "Photos",
    "name": "getPhotoCreation",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type photo : permet d'accéder à la représentation des ressources photo permettant la création d'une photo. Retourne une liste de lien pour twig.</p>",
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
      }
    },
    "filename": "./index.php",
    "groupTitle": "Photos"
  },
  {
    "type": "get",
    "url": "/modifierPhoto/{id}/{idSerie}",
    "title": "Affiche la page de modification d'une photo",
    "group": "Photos",
    "name": "getPhotoModification",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type Photo: permet d'accéder à la représentation des ressources photo permettant la modification d'une photo. Retourne une liste de lien pour twig.</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Photos"
  },
  {
    "type": "get",
    "url": "/supprimerPhoto/{id}/{idSerie}",
    "title": "Supprime une photo",
    "group": "Photos",
    "name": "getPhotoSuppresion",
    "version": "0.1.0",
    "description": "<p>Suppression d'une ressource de type Photo:</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getSerieAfficherPhotos</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Photos"
  },
  {
    "type": "post",
    "url": "/photos/{idSerie}",
    "title": "Vérification et création d'une photo",
    "group": "Photos",
    "name": "postPhotos",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type photo: permet d'ajouter une ressource Serie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "text",
            "description": "<p>Description</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getSerieAfficherPhotos</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getPhotoCreation</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "Longitude : must contain only letters digits (0-9)\nLatitude :must contain only digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Photos"
  },
  {
    "type": "post",
    "url": "/photos/{id}/{idSerie}",
    "title": "Vérification et modification d'une photo",
    "group": "Photos",
    "name": "putPhotosID",
    "version": "0.1.0",
    "description": "<p>Modification d'une ressource de type photo: permet de modifier les informations sur une photo d'une série,</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "text",
            "description": "<p>Description</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getSerieAfficherPhotos</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getPhotoModification</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "Longitude : must contain only letters digits (0-9)\nLatitude :must contain only digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Photos"
  },
  {
    "type": "get",
    "url": "/backoffice",
    "title": "Affiche la page de liste des séries",
    "group": "Series",
    "name": "getIndex",
    "version": "0.1.0",
    "description": "<p>Liste des ressource de type Series: permet d'accéder à la représentation des ressources series que l'utilisateur va pouvoir consulter et modifier, Retourne une liste de lien pour twig.</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "get",
    "url": "/afficherSerie/{idSerie}",
    "title": "Affiche la page de liste des photos d'une série",
    "group": "Series",
    "name": "getSerieAfficherPhotos",
    "version": "0.1.0",
    "description": "<p>Liste des ressource de type Photos d'une Serie: permet d'accéder à la représentation des ressources photos que l'utilisateur va pouvoir consulter et modifier, Retourne une liste de lien pour twig.</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "OK",
            "description": "<p>Ressources trouvées</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "get",
    "url": "/creerSerie",
    "title": "Affiche la page de création d'une série",
    "group": "Series",
    "name": "getSerieCreation",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type Serie : permet d'accéder à la représentation des ressources Serie permettant la création d'une Serie. Retourne une liste de lien pour twig.</p>",
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
      }
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "get",
    "url": "/modifierSerie/{id}",
    "title": "Affiche la page de modification d'une série",
    "group": "Series",
    "name": "getSerieModification",
    "version": "0.1.0",
    "description": "<p>Accès à toutes les ressources de type Serie : permet d'accéder à la représentation des ressources Serie permettant la modification d'une serie. Retourne une liste de lien pour twig.</p>",
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
      }
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "get",
    "url": "/supprimerSerie/{id}",
    "title": "Supprime une série",
    "group": "Series",
    "name": "getSerieSuppression",
    "version": "0.1.0",
    "description": "<p>Suppression d'une ressource de type Photo:</p>",
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getIndex</p>"
          }
        ]
      }
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "post",
    "url": "/creerSerie",
    "title": "Vérification et création d'une série",
    "group": "Series",
    "name": "getSeriesPost",
    "version": "0.1.0",
    "description": "<p>Crée une ressource de type Serie: permet d'ajouter une ressource Serie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "text",
            "description": "<p>Description</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getIndex</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getSerieCreation</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "Longitude : must contain only letters digits (0-9)\nLatitude :must contain only digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Series"
  },
  {
    "type": "post",
    "url": "/modifierSerie/{id}",
    "title": "Vérification et modification d'une série",
    "group": "Series",
    "name": "getSeriesPut",
    "version": "0.1.0",
    "description": "<p>Crée une ressource de type Serie: permet de modifier une ressource Serie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Varchar",
            "optional": false,
            "field": "text",
            "description": "<p>Description</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getIndex</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "optional": false,
            "field": "Redirection",
            "description": "<p>vers getSerieModification</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "Longitude : must contain only letters digits (0-9)\nLatitude :must contain only digits (0-9)",
          "type": "text"
        }
      ]
    },
    "filename": "./index.php",
    "groupTitle": "Series"
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
