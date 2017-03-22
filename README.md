# Installation

1. Cloner le projet dans un endroit adéquat sur votre ordinateur (i.e. pas sur le Bureau ni dans "Téléchargements")
2. S'assurer de bien être placé sur la branche `dev_votre_groupe`, et non pas sur la branche `master`
3. Régler votre MAMP, WAMP ou similaire de manière à ce que le dossier racine du serveur (Préférences > WebServer) soit le dossier "web" de ce projet
4. SANS le modifier au préalable, copier-coller `app/config/parameters_dev.yml.dist` au même endroit mais en enlevant le .dist. On obtient donc le fichier `app/config/parameters_dev.yml`. Dans ce nouveau fichier, modifier les paramètres pour qu'ils soient en accord avec vos accès à votre propre base MySql.
5. Ouvrir le terminal, se placer sur ce projet au moyen de la commande cd puis executer les lignes suivantes :


```
composer install
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:update --force
php bin/console translation:update fr --dump-messages  
php bin/console assets:install --symlink
php bin/console assetic:dump # celle-ci prend du temps à s'executer
php bin/console doctrine:fixtures:load
php bin/console cache:clear
```
6. Pour les utilisateurs sous Linux uniquement, configurer les permissions du répertoire var :
```
sudo setfacl -R -m u:"www-data":rwX -m u:`whoami`:rwX var
```
(Cf http://symfony.com/doc/current/setup/file_permissions.html )
# Connexion à la plateforme

Acceder à l'url `localhost:xxxx/app_dev.php`
(ou xxxx est le port que vous avez configuré)

>`app_dev.php` permet à Symfony de savoir qu'il faut charger l'environnement de dévéloppement.
Si vous l'omettez ou si vous souhaitez utiliser à `app_staging.php` (environnement de staging), ça ne fonctionnera pas car les paramètres des environnements de production et de staging ne sont pas compatibles avec la configuration de votre ordinateur.

Grâce aux fixtures lancées à l'étape 4) de l'installation, vous avez deux utilisateurs possibles :
- toto, mot de passe ebm_toto
- admin, mot de passe ebm_admin

Ceci afin de vous permettre de tester la plateforme en attendant le travail du groupe 5 : Gestion des utilisateurs

> Ce qui suit n'est pas forcément très clair et nécessite que j'y consacre + de temps. Mais si vous comprenez tout, vous êtes une crème.

# Features

- Template HTML/CSS intégré (`src/Core/IconbarBundle`)
- FOSUserBundle intégré (surchargé par `src/Core/UserBundle` )
- Entité image déjà intégrée au `src/Core/IconbarBundle`
- Quelques extensions de filtres pour twig
- DashboardBundle faisant office de bac à sable
- Fuseau horaire réglé sur Paris

# Comment utiliser le template HTML/CSS

# Créer un template twig

Nous partons du modèle vu sur le MOOC Symfony : un controller fait appel à un fichier twig, qui hérite du bundleLayout.html.twig qui hérite lui-même de `::layout.html.twig`.
https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony/le-moteur-de-templates-twig-1

Concernant votre bundleLayout.html.twig, prenez comme modèle `src/Core/DashboardBundle/Resources/views/bundleLayout.html.twig`
Puis, concernant les twig appelés par vos controllers, prenez comme modèle `src/Core/DashboardBundle/Resources/views/Default/exempleVide.html.twig`

# Utiliser les composants template

Le template repose sur Bootstrap et est très complet.
Presque pas besoin de toucher au css !
Rendez-vous sur :
http://getbootstrapadmin.com/remark/material/iconbar/index.html
Tous les composants sont classés par catégories.
Lorsque vous souhaitez intégrer un composant que vous y avez trouvé, regardez le code source de la page (clic droit > voir le code source de cette page),
et faites simplement un copier coller du block HTML correspondant dans votre twig.

ATTENTION, certains composants nécessite l'import d'un fichier css et js dans votre twig.
Repérez le/les fichiers CSS/JS nécessaires à votre composant dans le code source où vous avez copié le code précédent, puis repérez dans le dossier `src/Core/IconbarBundle/Resources/public` l'emplacement de ces fichiers.
Vous saurez donc comment les importer.

# Utiliser les extensions de filtre twig

Plusieurs filtres twig custom ont été rajouté, vous pouvez les découvrir en consultant le fichier `src/Core/IconbarBundle/Twig/extension/commonExtension.php`



Le template complet se trouve ici :
http://getbootstrapadmin.com/remark/material/iconbar/index.html

# Login on Gitlab registry

```bash
docker login registry.gitlab.com
```
With credentials : `centraleebm / GitlabRepo`

# Build image behind a proxy
```bash
docker build -t registry.gitlab.com/filrouge-fablab/fablab-symfony:staging . --network host --build-arg http_proxy
```

# Send image to docker Hub
```bash
docker push registry.gitlab.com/filrouge-fablab/fablab-symfony:staging
```
