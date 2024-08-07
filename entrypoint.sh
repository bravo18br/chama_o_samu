#!/bin/bash

# Carrega as variáveis de ambiente do arquivo .env
source /root/.env

# Move o arquivo .env para o diretório clonado
mv /root/.env /var/www/html/.env

# Verifica se o arquivo de database já existe antes de criar um novo
if [ ! -f /var/www/html/database/database.sqlite ]; then
  touch /var/www/html/database/database.sqlite
fi

mkdir /var/www/html/storage/app/public/fotos

# Define as permissões corretas
chown -R www-data:www-data /var/www/html
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/database
chown -R www-data:www-data /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/storage/app/public/fotos

chmod -R 775 /var/www/html
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/database
chmod -R 775 /var/www/html/storage/logs
chmod -R 775 /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/database/database.sqlite
chmod -R 775 /var/www/html/storage/app/public/fotos

# Atualizar dependências do projeto
cd /var/www/html
composer install --no-interaction --prefer-dist --optimize-autoloader

# Executa os comandos do Laravel
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan view:clear
php artisan config:clear
php artisan config:cache
php artisan key:generate --force

# Executa o comando original do contêiner
exec "$@"
