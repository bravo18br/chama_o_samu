# Projeto CHAMA O SAMU

Este projeto foi desenvolvido pela equipe de desenvolvimento da SMCIT (Prefeitura Municipal de Araucária - Secretaria Municipal da Ciência, Inovação,
                Tecnologia e Desenvolvimento) com o objetivo de atender lei municipal que visa facilitar a abertura de chamados para o SAMU por usuários surdos/mudos.

[LEI N° 4.375 DE 15 DE MARÇO DE 2024](https://sapl.araucaria.pr.leg.br/norma/1833)
Dispõe sobre a criação do aplicativo “CHAMA O SAMU” para assegurar o atendimento médico de urgência a pessoas com deficiência auditiva e com incapacidade de fala ao Serviço de Atendimento Móvel de Urgência (SAMU)."

## Tecnologias Utilizadas

O projeto utiliza as seguintes tecnologias:

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

Este projeto foi criado pela equipe de desenvolvimento da Secretaria Municipal de Ciência e Tecnologia (SMCIT) da cidade de Araucária PR. A equipe é composta por desenvolvedores especializados em diferentes áreas, incluindo desenvolvimento web, design de interfaces e gerenciamento de projetos.

### Membros da Equipe:

- [Francisco Cartaxo](https://github.com/chicocartaxo) - Coordenador.
- [Andre Callman](https://github.com/andrecallman) - Gerente de Projeto.
- [Christoffer Klein](https://github.com/bravo18br) - Desenvolvedor Fullstack.
- [Williane Leal](https://github.com/willianeleal) - Desenvolvedor Frontend.

## Como Contribuir

Para contribuir com este projeto, siga estas etapas:

1. Faça um fork do repositório
2. Crie uma branch para sua funcionalidade (`git checkout -b feature/MinhaFuncionalidade`)
3. Faça commit das suas alterações (`git commit -am 'Adicionando nova funcionalidade'`)
4. Faça push para a branch (`git push origin feature/MinhaFuncionalidade`)
5. Crie um novo Pull Request

## Licença

Este projeto é licenciado sob a Licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para detalhes.

## Início básico
- gh repo clone bravo18br/chama_o_samu prod_araucaria_chama_o_samu

### REVISANDO ###
- composer install
- conferir .env.example
- php artisan key:generate
- php artisan migrate:refresh
- php artisan db:seed
- php artisan serve
- os usuários de teste podem ser vistos no arquivo de seed (não usar na versão de produção)

## Deploy

- Docker / Docker-compose