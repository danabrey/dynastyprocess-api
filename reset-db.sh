bin/console doctrine:database:drop --force
bin/console doctrine:database:create
yes | bin/console doctrine:migrations:migrate
