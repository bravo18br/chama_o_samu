#!/bin/bash

# Carrega as variáveis de ambiente do arquivo .env
source /root/.env

# Move o arquivo .env para o diretório clonado
mv /root/.env /var/www/html/.env

# Verifica se o arquivo de database já existe antes de criar um novo
if [ ! -f /var/www/html/database/database.sqlite ]; then
  touch /var/www/html/database/database.sqlite
fi

# Verifica se a pasta existe antes de criar
if [ ! -d /var/www/html/storage/app/public/fotos ]; then
  mkdir -p /var/www/html/storage/app/public/fotos
fi

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

# Gerar certificado SSL autoassinado se não existir
SSL_KEY="/etc/apache2/ssl/apache-selfsigned.key"
SSL_CERT="/etc/apache2/ssl/apache-selfsigned.crt"
Pais_C="BR"
Estado_ST="Parana"
Cidade_L="Araucaria"
Organizacao_O="SMCIT"
CommonName_CN="localhost"

if [ ! -f "$SSL_KEY" ] || [ ! -f "$SSL_CERT" ]; then
    mkdir -p "$SSL_DIR"
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
        -keyout "$SSL_KEY" \
        -out "$SSL_CERT" \
        -subj "/C=$Pais_C/ST=$Estado_ST/L=$Cidade_L/O=$Organizacao_O/CN=$CommonName_CN"
fi

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
