# Projeto CHAMA O SAMU

Este projeto foi desenvolvido pela equipe de desenvolvimento da SMCIT (Prefeitura Municipal de Araucária - Secretaria Municipal da Ciência, Inovação, Tecnologia e Desenvolvimento) com o objetivo de atender lei municipal que visa facilitar a abertura de chamados para o SAMU por usuários surdos/mudos.

[LEI N° 4.375 DE 15 DE MARÇO DE 2024](https://sapl.araucaria.pr.leg.br/norma/1833)
Dispõe sobre a criação do aplicativo “CHAMA O SAMU” para assegurar o atendimento médico de urgência a pessoas com deficiência auditiva e com incapacidade de fala ao Serviço de Atendimento Móvel de Urgência (SAMU)."

## Tecnologias Utilizadas

O projeto utiliza as seguintes tecnologias, dentre outras:

- **Laravel**: Framework PHP utilizado para o desenvolvimento do backend da aplicação.
- **Livewire**: Biblioteca utilizada para o desenvolvimento de interfaces dinâmicas no Laravel.
- **Tailwind CSS**: Framework CSS utilizado para o design e estilização da interface do usuário.
- **Vite**: Ferramenta de compilação de JavaScript utilizada para o desenvolvimento frontend.
- **Axios**: Cliente HTTP utilizado para fazer requisições assíncronas ao servidor.
- **Germano Ricardi Brazilian Helper**: Biblioteca PHP para auxiliar na manipulação de dados brasileiros, como CPF e CEP.
- **Carbon**: Biblioteca para manipulação de datas e horas em PHP.
- **Laravel Breeze**: Pacote Laravel para autenticação de usuários.
- **Nesbot Carbon**: Extensão da biblioteca Carbon para manipulação de datas e horas em PHP.
- **TongeDev RFB Document**: Biblioteca PHP para validação de CPFs.

## Equipe de Desenvolvimento SMCIT

Este projeto foi criado pela equipe de desenvolvimento da Secretaria Municipal de Ciência e Tecnologia (SMCIT) da cidade de Araucária PR.
A equipe é composta por desenvolvedores especializados em diferentes áreas, incluindo desenvolvimento web, design de interfaces e gerenciamento de projetos.

### Membros da Equipe:

- [Francisco Cartaxo](https://github.com/chicocartaxo) - Coordenador.
- [Andre Callman](https://github.com/andrecallman) - Gerente de Projeto.
- [Christoffer Klein](https://github.com/bravo18br) - Desenvolvedor Fullstack.
- [Williane Leal](https://github.com/willianeleal) - Desenvolvedor Frontend.

## Licença

Este projeto é licenciado sob a Licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para detalhes.

## Backup arquivos importantes
- database/database.sqlite (todo o DB)
- storage/app/public/fotos (as fotos que os usuários enviaram nos chamados)
- storage/logs (os logs de serviço)

## Início básico LOCAL
- gh repo clone bravo18br/chama_o_samu prod_araucaria_chama_o_samu
- Criar o .env (ver o .env.example na base do projeto)
    - Ajustar APP_ENV para local ou prod e APP_DEBUG para true ou false
    - Ajustar APP_URL (http://127.0.0.1:8000)
    - Setar MAIL_USERNAME e MAIL_PASSWORD pois o login de usuários depende dessas credenciais (ver abaixo detalhes de como conseguir)
    - Setar SUPER_ADM_USER e SUPER_ADM_PASS (será o superuser para manutenção/acesso god mode). Esse usuário é criado apenas em modo "prod".
- composer install
- php artisan migrate --force
- php artisan db:seed --force
- php artisan storage:link
- php artisan view:clear
- php artisan config:clear
- php artisan key:generate --force
- php artisan serve

## Início básico DOCKER
- gh repo clone bravo18br/chama_o_samu prod_araucaria_chama_o_samu
- Criar o .env (ver o .env.example na base do projeto)
    - Ajustar APP_ENV para local ou prod e APP_DEBUG para true ou false
    - Ajustar APP_URL (http://ip_do_servidor:porta_do_docker)
    - Setar MAIL_USERNAME e MAIL_PASSWORD pois o login de usuários depende dessas credenciais (ver abaixo detalhes de como conseguir)
    - Setar SUPER_ADM_USER e SUPER_ADM_PASS (será o superuser para manutenção/acesso god mode). Esse usuário é criado apenas em modo "prod".
- Se APP_ENV=prod descomentar a linha 37 (php artisan config:cache) em entrypoint.sh na raiz do projeto
- docker compose up -d --build (vai iniciar os serviços, após uns 2min já responde no navegador)
- docker exec -it prod_araucaria_chama_o_samu /bin/bash (se precisar entrar na máquina)
- os logs ficam em /var/www/html/storage/logs
- tail -f /var/www/html/storage/logs/apache_error.log
- tail -f /var/www/html/storage/logs/apache_access.log
- tail -f /var/www/html/storage/logs/integrado.log

## Início básico SWARM
1. **Clonar o repositório:**

   ```bash
   gh repo clone bravo18br/chama_o_samu prod_araucaria_chama_o_samu
   ```

2. **Criar o arquivo `.env`:**

   - Utilize o arquivo `.env.example` como base para criar o `.env` na raiz do projeto.
   - Ajuste as seguintes variáveis conforme necessário:
     - `APP_ENV` para `local` ou `prod`.
     - `APP_DEBUG` para `true` ou `false`.
     - `APP_URL` (exemplo: `http://ip_do_servidor:porta_do_docker`).
     - `MAIL_USERNAME` e `MAIL_PASSWORD` (necessários para o login dos usuários).
     - `SUPER_ADM_USER` e `SUPER_ADM_PASS` (credenciais do superusuário para manutenção/acesso god mode). Este usuário é criado apenas em modo "prod".

3. **Ajustar o `entrypoint.sh` (opcional):**

   - Se `APP_ENV=prod`, descomente a linha 37 (`php artisan config:cache`) no arquivo `entrypoint.sh` na raiz do projeto para otimizar o cache de configuração.

3.5. **Criar o build da aplicação:**   
   - docker build -t chama_o_samu:prod -f Dockerfile-swarm .

4. **Implantar o stack no Docker Swarm:**

   ```bash
   docker stack deploy -c docker-swarm.yml prod_araucaria_chama_o_samu
   ```

   - Esse comando vai iniciar os serviços definidos no arquivo `docker-swarm.yml`. Após cerca de 2 minutos, o serviço deve estar acessível no navegador.

5. **Comandos úteis no Docker Swarm:**

   - **Visualizar os containers em execução:**
     ```bash
     docker service ps prod_araucaria_chama_o_samu_app
     ```
     - Este comando lista as tarefas do serviço, mostrando o status dos containers.

   - **Acessar o shell de um container:**
     ```bash
     docker exec -it <container_id> /bin/bash
     ```
     - Substitua `<container_id>` pelo ID do container desejado. Esse comando permite que você acesse o shell do container para realizar manutenções ou verificações.

   - **Monitorar os logs do serviço:**
     ```bash
     docker service logs -f prod_araucaria_chama_o_samu_app
     ```
     - Esse comando mostra os logs em tempo real do serviço `prod_araucaria_chama_o_samu_app`.

6. **Localização dos logs:**

   - Os logs do sistema podem ser encontrados nas seguintes localizações dentro do container:
     - `/var/www/html/storage/logs/apache_error.log` (erros do Apache)
     - `/var/www/html/storage/logs/apache_access.log` (acessos do Apache)
     - `/var/www/html/storage/logs/integrado.log` (logs personalizados da aplicação)

## Conseguir Credenciais do GMAIL

Para obter as credenciais do GMAIL, siga os passos abaixo:

1. **Acesse a conta do Google:**
   - Abra seu navegador e vá para [Google](https://accounts.google.com).
   - Faça login com sua conta do Google.

2. **Navegue até as Configurações de Segurança:**
   - Clique na sua foto de perfil no canto superior direito e selecione "Gerenciar sua Conta do Google".
   - No menu lateral esquerdo, clique em "Segurança".

3. **Ative a verificação em duas etapas:**
   - Em "Como fazer login no Google", clique em "Verificação em duas etapas" e siga as instruções para ativá-la.

4. **Crie uma senha de aplicativo:**
   - Após ativar a verificação em duas etapas, vá para a seção "Senhas de app".
   - Selecione "Correio" e "Computador Windows" (ou outro dispositivo se preferir) e clique em "Gerar".
   - Uma senha será gerada. Copie essa senha.

5. **Adicionar as credenciais ao arquivo `.env`:**
   - No arquivo `.env`, defina `MAIL_USERNAME='usuario@gmail.com'` e `MAIL_PASSWORD='senha_gerada'`.
