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
# SSL_DIR="/etc/apache2/ssl"
# SSL_KEY="$SSL_DIR/apache-selfsigned.key"
# SSL_CERT="$SSL_DIR/apache-selfsigned.crt"

# Pais_C="BR"
# Estado_ST="Parana"
# Cidade_L="Araucaria"
# Organizacao_O="SMCIT"
# CommonName_CN="172.20.10.37"
# UnidadeOrganizacional_OU="Prefeitura"

# if [ ! -f "$SSL_KEY" ] || [ ! -f "$SSL_CERT" ]; then
#     echo "Criando certificado SSL em $SSL_CERT"
#     mkdir -p "$SSL_DIR"
#     openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
#         -keyout "$SSL_KEY" \
#         -out "$SSL_CERT" \
#         -subj "/C=$Pais_C/ST=$Estado_ST/L=$Cidade_L/O=$Organizacao_O/CN=$CommonName_CN/OU=$UnidadeOrganizacional_OU"
# fi

# Verificar se o certificado foi criado
# if [ ! -f "$SSL_CERT" ]; then
#     echo "Erro: O certificado SSL não foi criado!"
#     exit 1
# fi

# Atualizar dependências do projeto
cd /var/www/html
composer install --no-interaction --prefer-dist --optimize-autoloader

# Espera até que o PostgreSQL esteja disponível
/var/www/html/wait-for-it.sh postgres:5432 --timeout=60 --strict -- echo "PostgreSQL is up - executing commands"

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
