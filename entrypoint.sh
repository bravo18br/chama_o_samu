#!/bin/bash

# Carrega as variáveis de ambiente do arquivo .env
source /root/.env

# Verifica se GITHUB_TOKEN está definido
if [ -z "$GITHUB_TOKEN" ]; then
  echo "Erro: GITHUB_TOKEN não está definido"
  exit 1
fi

# Login no GitHub usando o token
echo $GITHUB_TOKEN | gh auth login --with-token

# Clona o repositório no diretório /var/www/html
gh repo clone https://github.com/prefeitura-araucaria/samu-acessibilidade /var/www/html

# Move o arquivo .env para o diretório clonado
mv /root/.env /var/www/html/.env

# Criar o database
touch /var/www/html/database/samu-acessibilidade.db

# Define as permissões corretas
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/database

#Atualizar dependências do projeto
cd /var/www/html
composer update
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan view:clear
php artisan config:cache
php artisan key:generate

# Executa o comando original do contêiner
exec "$@"
