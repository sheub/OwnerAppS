# TapAndGo

Prérequis : Git, Composer, PHP7, Yarn et NodeJS

1. Cloner le projet
2. Dans le cmd, ce positionner sur le projet et lancer la commande suivante : 
      - composer install && yarn install && npm i && yarn run encore dev
3. Modifier le fichier .env à la racine et définir les paramètres de sa base de données
4. Lancer la commande suivante :
      - bin/console d:d:c && bin/console d:sc:c && bin/console d:f:l --append && php -S localhost:8080 -t public/
5. Et voilà, le site est accessible sur le lien suivant : http://localhost:8080/

# Sécurité
Creation d'un utilisateur : bin/console fos:user:create

Création d'un token temporaire : bin/console oauth:client:create --redirect-uri=http://localhost:8080/ --grant-type=password --grant-type=refresh _token

Utilisation des WS avec une authentification OAUTH2 (grant_type, username, password, client_id, client_secret)
# AM
