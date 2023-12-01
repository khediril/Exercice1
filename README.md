# pour récupérer ce projet sur votre machine:

Tapez les commandes suivantes:

$ git clone https://github.com/khediril/Exercice1.git
$ cd Exercice1
$ composer install
$ symfony console doctrine:database:create

effsacer le contenu du dossier migration du projet ensuite taper les commandes suivantes

$ symfony console make:migration
$ symfony console doctrine:migrations:migrate
