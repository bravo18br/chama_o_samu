### Instruções para Rodar a Aplicação

Para rodar a aplicação, siga os passos abaixo:

1. **Copiar todos os arquivos para uma pasta no servidor Docker:**
   - Faça um clone do projeto para uma pasta no servidor Docker.
   - 

2. **Editar o `.env`:**
   - Abra o arquivo `.env.example` na pasta do projeto.
   - Adicione a linha `GITHUB_TOKEN=<seu_github_token>`.
   - Edite as linhas `MAIL_USERNAME='usuario@gmail.com'` e `MAIL_PASSWORD='senha para aplicaçoes do Google'`.

3. **Rodar o Docker Compose:**
   - Navegue até a pasta do projeto no terminal.
   - Execute o comando:
     ```sh
     docker-compose up -d
     ```

### Conseguir o GITHUB_TOKEN

Para gerar um token de acesso pessoal (Personal Access Token) no GitHub, siga os passos abaixo:

1. **Acesse o GitHub:**
   - Abra seu navegador e vá para [GitHub](https://github.com).
   - Faça login com sua conta do GitHub.

2. **Navegue até as Configurações:**
   - Clique no ícone do seu perfil no canto superior direito.
   - Selecione "Settings" (Configurações) no menu suspenso.

3. **Acesse a seção de Tokens:**
   - No menu lateral esquerdo, clique em "Developer settings" (Configurações de desenvolvedor).
   - Em seguida, clique em "Personal access tokens" (Tokens de acesso pessoal).
   - Selecione "Tokens (classic)" para criar um token de acesso clássico.

4. **Gerar um novo token:**
   - Clique no botão "Generate new token" (Gerar novo token).
   - Dê um nome ao token para referência futura.
   - Selecione as permissões necessárias. Para acessar repositórios privados, selecione `repo`.
   - Desça até o final da página e clique em "Generate token" (Gerar token).

5. **Copiar o token:**
   - O token será exibido uma única vez. Copie-o e armazene-o em um lugar seguro.
   - Adicione o token copiado ao arquivo `.env` da sua aplicação.

### Conseguir Credenciais do GMAIL

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

### Estrutura de Diretórios

Certifique-se de que a estrutura de diretórios no servidor Docker esteja conforme abaixo:

```plaintext
/project-root-folder
│
├── .env
├── docker-compose.yml
├── Dockerfile
├── apache.conf
├── gh_login.sh
└── samu-acessibilidade/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── public/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── tests/
    └── vendor/
```

### Executando a Aplicação

Após configurar tudo conforme acima:

1. **Inicie a aplicação:**
   - No terminal, navegue até a pasta do projeto.
   - Execute:
     ```sh
     docker-compose up -d
     ```

2. **Verifique se os contêineres estão em execução:**
   - Use o comando:
     ```sh
     docker-compose ps
     ```

3. **Acesse a aplicação:**
   - Abra o navegador e acesse:
     ```plaintext
     http://localhost:8098
     ```
   - Ou, se estiver acessando de outro dispositivo na mesma rede, substitua `localhost` pelo endereço IP do servidor.

Seguindo essas instruções, você deverá ser capaz de rodar a aplicação Laravel usando Docker e Docker Compose.