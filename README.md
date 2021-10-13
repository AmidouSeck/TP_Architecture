# TP_Architecture

[![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](http://forthebadge.com)  [![forthebadge](http://forthebadge.com/images/badges/powered-by-electricity.svg)](http://forthebadge.com)

L’objectif de ce projet est de mettre en œuvre les compétences acquises dans le cours d’architecture logicielle. Il est découpé en trois parties que vous devrez faire intégralement.

## Pour commencer
##Lien du tutoriel Youtube




### Contenu du projet


## Site Web
Il s’agira de concevoir un site d’actualité disposant des fonctionnalités suivantes :
- La page d’accueil devra afficher la liste des derniers articles avec une description sommaire de chacun d’entre eux. Des boutons « suivant » et « précédent » devront permettre de parcourir les articles selon leur ancienneté.
- Le clic sur le titre d’un article devra permettre de le consulter en détail.
- On devrait avoir la possibilité de consulter les articles par catégorie.
- Trois types de profils utilisateurs devront être pris en compte :
 Les visiteurs simples : Ils peuvent accéder à toutes les fonctionnalités applicatives liées à la consultation des articles (affichage par catégorie, etc.)
 Les éditeurs : Leur rôle est de maintenir le contenu du site. De ce fait, en plus de ce que peuvent faire les visiteurs, Ils ont la possibilité, après authentification, de gérer (lister, ajouter, supprimer ou modifier) les articles et les catégories.
 Les administrateurs sont des éditeurs qui ont la possibilité de gérer les données des utilisateurs. Ainsi, ils ont accès à toutes les fonctionnalités applicatives et peuvent donc ajouter, lister, modifier ou supprimer des utilisateurs. De même, ils sont chargés de l’ajout et de la suppression des jetons d’authentification permettant d’accéder aux services web à accès restreint.

## Services Web
En plus des fonctionnalités directement accessibles depuis un navigateur, l’application devra exposer un ensemble de services web afin que ses fonctionnalités métiers soient accessibles à d’autres applications. De ce fait, il vous est demandé de :
- Créer un service web SOAP permettant de :
 lister, ajouter, supprimer ou modifier des utilisateurs. L’accès à ce service requiert un
jeton d’authentification qu’un administrateur devra au préalable générer depuis la
page d’administration du site
 D’authentifier un utilisateur suivant un login et un mot de passe fourni
- Créer un service web REST permettant de :
     
 Récupérer la liste de tous les articles. Cette liste devra être retournée au format XML ou JSON selon le choix de l’utilisateur.
 récupérer la liste des articles regroupés en catégories (format XML ou JSON au choix)
 récupérer la liste des articles appartenant à une catégorie fournie par l’utilisateur
(format XML ou JSON au choix)


## Application cliente
Créer une application Java (ou Python) permettant de gérer les utilisateurs. Quand l’application est lancée, elle demande à l’utilisateur son login et son mot de passe et invoque ainsi le service web d’authentification pour voir si l’utilisateur a les droits d’administration lui permettant d’agir sur les utilisateurs. Le cas échéant, l’application devra fournir un accès complet aux fonctionnalités de gestion des utilisateurs et ce, en utilisant les services web adéquats.

### Installation

Pour l'installations de l'ensemble des packages utilisés dans les services web et l'application cliente saisir la commande:
pip install -r requirements.txt en se plaçant dans le répertoire djangoCrudExample

## Démarrage

- Pour le démarrage du site web il suffit de palcer le dossier TP_Architecture dans le répertoire htdocs de MAMP(MAC OS) ou XAMP(LINUX OU WINDOWS) ou dans le répertoire www de WAMP(WINDOWS), démarrer le serveur puis lancer le projet TP_Architecture.
- pour lancer les services Web et l'application cliente il suffit de se placer dans le répertoire djangoCrudExample et de lancer la commande: python manage.py runserver en ligne de commande.

## Fabriqué avec

* [Php](https://www.php.net/) - langage de script généraliste populaire particulièrement adapté au développement Web
* [Django](https://www.djangoproject.com/) - Framwork python qui nous a servi de mettre en place l'app cliente
* [MySql](https://www.mysql.com/fr/) - pur la base de données
* [VsCode](https://code.visualstudio.com/) - Éditeur de code


## Auteurs

* **Mohamed Amidou Seck** _alias_ [@AmidouSeck](https://github.com/AmidouSeck)
* **Modou Mar** _alias_ [@Modou105](https://github.com/Modou105)

## License

Ce projet est sous licence ``ESP`` - voir le fichier [LICENSE.md](LICENSE.md) pour plus d'informations

