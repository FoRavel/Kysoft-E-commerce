# kysoft
Projet - 1ère année BTS SIO

Site internet e-commerce spécialisé dans le matériel informatique. Ce projet a été noté par un professeur.

Spécificités techniques principales: 
- Afficher sur plusieurs pages la liste des produits disponibles à la vente (libellé, prix, description, photo, stock...). 
- Rechercher selon des critères un ou des produits en particulier.
- Ajouter-modifer-supprimer des produits.
- Se connecter selon un login et un mot de passe.
- Pas de fonction d'achat.

Technologies employées:
- PHP Procédural
- JQuery/AJAX
- HTML5, Bootstrap
- SQL 
- PhpMyAdmin

CONFIGURATION BASE DE DONNEES:
$con = mysqli_connect("localhost", "root", "", "kysoft");

Le fichier .sql de la base de données se nomme "kysoft.sql". 

POST SCRIPTUM:
Le projet est vieux, n'a pas été maintenu depuis, il semblerait qu'une partie du projet soit manquante mais la seule particularité de ce projet que je tenais à montrer est les "listes liées" pour la recherche des produits et celle-ci fonctionne: Quand on sélectionne une catégorie dans la liste des catégories, la liste des sous-catégories affiche les sous catégories associées à la catégorie choisie.
