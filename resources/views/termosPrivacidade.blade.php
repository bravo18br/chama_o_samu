<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/storage/css/style.css') }}" rel="stylesheet" type="text/css">
    <title>Política de Privacidade e Termos de Uso</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <x-development-mode-alert />
    <x-background-image />

    <div class="cartao flex justify-center items-center p-4">
        <a href="{{ route('home') }}"><img src="{{ asset('/storage/images/logo-CS-tipo-cor-192.png') }}" alt="Logo"></a>
    </div>

    <div class="cartao">
        <h1 class="text-center text-3xl font-bold mb-6">Política de Privacidade</h1>
        <p class="mb-6">Ter seus dados pessoais bem cuidados é um direito protegido pela Lei 13.709, conhecida como a Lei Geral de Proteção de Dados Pessoais (LGPD). Com esta Política de Privacidade, buscamos dar transparência sobre como nós tratamos os seus dados.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Como são coletados</h2>
        <p class="mb-4">Nós podemos coletar os seguintes, mas não somente, dados pessoais (nome, cpf, rg, e-mail, endereço, localização, etc) além de dados estatísticos e profissionais.</p>
        <p class="mb-4">Dependendo do serviço, podem ser coletados mais ou menos dados do que os informados. As maneiras pelas quais os coletamos podem ser:</p>
        <ul class="list-disc list-inside mb-6">
            <li><strong>Pelo seu preenchimento</strong> - Em geral, nós coletamos seus dados quando você preenche campos de cadastro em algum dos nossos sistemas, aplicativos ou formulários.</li>
            <li><strong>Por meio de outros bancos de dados da Administração Pública</strong> - Alguns dos seus dados podem ser coletados por meio de APIs de banco de dados de sistemas de outros órgãos ou entidades da Administração Pública.</li>
            <li><strong>Por meio de cookies</strong> - Também podemos coletar informações através de cookies, pequenos arquivos de texto enviados pelo site ao computador do usuário e que nele ficam armazenados. Podem ser armazenados, por exemplo, dados sobre o dispositivo utilizado pelo usuário, bem como seu local e horário de acesso ao site.</li>
        </ul>
        <p class="mb-6">As informações eventualmente armazenadas em cookies também são consideradas dados pessoais e todas as regras previstas nesta Política de Privacidade também são aplicáveis a eles.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Como usamos</h2>
        <p class="mb-4">De acordo com a LGPD, só podem ser coletados os dados com uma finalidade bem definida. Por isso, nós coletamos seus dados, e somente os necessários, para os seguintes fins:</p>
        <ul class="list-disc list-inside mb-6">
            <li>Fornecer o máximo de informações relevantes para o SAMU no momento de uma emergência</li>
            <li>Criar relatórios estatísticos anônimos para melhorar o fornecimento de serviços públicos à população</li>
            <li>Melhorar as políticas de acesso à informação</li>
            <li>Prover suporte técnico e operacional e garantir a segurança e a funcionalidade dos serviços</li>
            <li>Prevenir atividades ilegais, fraudulentas ou suspeitas, que possam provocar danos ao Órgão ou a terceiros</li>
            <li>Prevenir problemas técnicos ou de segurança</li>
            <li>Seus dados podem ser usados para atividades de pesquisa, análises e inovação das nossas atividades</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Com quem compartilhamos</h2>
        <p class="mb-4">Para concretizar a finalidade legal Chama o Samu, contamos com a ajuda de parceiros, sejam eles públicos ou privados, os quais podem participar de alguma forma do ciclo de tratamento dos seus dados pessoais. Podemos compartilhar os seus dados com:</p>
        <ul class="list-disc list-inside mb-6">
            <li><strong>Órgão ou entidades parceiros</strong> - Podemos compartilhar seus dados com órgãos ou instituições da Administração Pública, para execução de outras políticas públicas</li>
            <li><strong>Parceiros como AWS, Google Cloud</strong> - bem como provedores e demais prestadores e mantenedores de serviços técnicos de dados e internet</li>
            <li><strong>Autoridades judiciais</strong> - em caso de ordem judicial, conforme legislação pertinente.</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Como protegemos seus dados</h2>
        <p class="mb-4">Nós adotamos boas práticas de segurança da informação alinhadas aos padrões técnicos e regulatórios exigidos. Assim, buscamos proteger seus dados de possíveis vulnerabilidades.</p>
        <ul class="list-disc list-inside mb-6">
            <li><strong>Controles de Acesso Lógico</strong> - Nossos sistemas possuem controle lógico de usuários</li>
            <li><strong>Controles de proteção física e do ambiente de rede</strong> - contamos com sala segura com controle de acesso biométrico, além de possuir controles de acesso físico (portaria, vigilância) ao interior da Prefeitura</li>
            <li><strong>Cópia de Segurança</strong> - Cópias de segurança, conhecidas como “backups”, são realizadas periodicamente, o que evita que seus dados não sejam perdidos em caso de incidentes</li>
            <li><strong>Controles Criptográficos</strong> - Nossa comunicação interna é criptografada, evitando que não autorizados tenham acesso a seus dados</li>
            <li><strong>Registro de Eventos, Rastreabilidade e Salvaguarda de Logs</strong> - As ações registradas pelos usuários em eventos relevantes ficam registradas em logs. Assim, é possível saber quem as realizou.</li>
            <li><strong>Responsabilização</strong> - Os contratos firmados com empresas preveem cláusulas de responsabilidade em caso de descumprimento</li>
            <li><strong>Segurança Web</strong> - Possuímos soluções de segurança de redes modernas, como firewalls e balanceadores de carga, alinhados com o padrão internacional de qualidade e boas práticas</li>
        </ul>

        <h1 class="text-center text-3xl font-bold mt-8 mb-6">Termos de Uso</h1>
        <p class="mb-6">Antes de usufruir do serviço, é necessário que fique claro para você quais são seus direitos, suas obrigações, bem como a maneira de enviar uma dúvida ou reclamação para nós.</p>
        <p class="mb-6">A SMCIT se compromete a cumprir todas as legislações inerentes ao uso correto dos dados pessoais do cidadão de forma a preservar a privacidade dos dados utilizados no serviço, bem como a garantir todos os direitos e garantias legais que você possui.</p>
        <p class="mb-6">É nossa responsabilidade implementar controles de segurança para proteção dos dados que foram coletados. Buscamos a constante melhoria deste documento, e você será sempre avisado quando alguma alteração ocorrer aqui.</p>
        <p class="mb-6">Ao utilizar algum de nossos serviços, você confirma que leu e compreendeu nossos termos e políticas e concorda com eles.</p>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Seus direitos</h2>
        <p class="mb-4">Como titular dos dados, você possui direitos bem definidos pela LGPD:</p>
        <ul class="list-disc list-inside mb-6">
            <li><strong>Direito de Acesso</strong> - Os titulares têm o direito de obter informações claras e transparentes sobre o tratamento de seus dados pessoais, podendo solicitar acesso a essas informações.</li>
            <li><strong>Direito de Retificação</strong> - Os titulares têm o direito de corrigir dados pessoais imprecisos ou desatualizados que estejam sob tratamento.</li>
            <li><strong>Direito de Eliminação (ou "direito ao esquecimento")</strong> - Os titulares podem solicitar a exclusão de seus dados pessoais, desde que não haja uma base legal que justifique a sua retenção.</li>
            <li><strong>Direito de Oposição</strong> - Os titulares podem se opor ao tratamento de seus dados pessoais em determinadas situações, como em casos de marketing direto.</li>
            <li><strong>Direito de Portabilidade</strong> - Os titulares têm o direito de receber os dados pessoais que forneceram a uma organização em um formato estruturado e de uso comum, bem como o direito de transmitir esses dados a outra organização.</li>
            <li><strong>Direito de Informação</strong> - As organizações devem informar aos titulares sobre como seus dados serão tratados, de forma clara e compreensível.</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-8 mb-4">Como exercer seus direitos</h2>
        <p class="mb-6">Em caso de dúvidas ou problemas relacionados ao tratamento de dados, você pode entrar em contato diretamente conosco.</p>
        <p class="mb-6">Ao acessar, você pode solicitar as informações e efetuar os pedidos relativos aos seus dados pessoais.</p>

        <div class="flex justify-center items-center">
        <a class="bg-red-600 hover:bg-red-500 text-white font-bold py-3 px-4 m-1 rounded" href="{{ route('home') }}" role="button"><b>VOLTAR</b></a>
        </div>
    </div>

    <footer class="cartao flex flex-col justify-center items-center">
        <div class="flex flex-col items-center">
            <div class="flex flex-wrap justify-center">
                <div class="w-full sm:w-1/3 p-4 flex flex-col items-center">
                    <a target="_blank" href="mailto:prefeitura@araucaria.pr.gov.br">
                        <div class="w-24 h-24 bg-center bg-no-repeat transition-all duration-300 ease-in-out bg-[url('/storage/images/email-preto-390px.svg')] hover:bg-[url('/storage/images/email-laranja-390px.svg')]"></div>
                    </a>
                    <a target="_blank" href="mailto:prefeitura@araucaria.pr.gov.br">
                        <p class="text-center text-gray-700">prefeitura@araucaria.pr.gov.br</p>
                    </a>
                </div>
                <div class="w-full sm:w-1/3 p-4 flex flex-col items-center">
                    <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                        <div class="w-24 h-24 bg-center bg-no-repeat transition-all duration-300 ease-in-out bg-[url('/storage/images/mapa-preto-390px.svg')] hover:bg-[url('/storage/images/mapa-laranja-390px.svg')]"></div>
                    </a>
                    <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                        <p class="text-center text-gray-700">Abrir mapa</p>
                    </a>
                </div>
                <div class="w-full sm:w-1/3 p-4 flex flex-col items-center">
                    <a href="tel:+554136141400">
                        <div class="w-24 h-24 bg-center bg-no-repeat transition-all duration-300 ease-in-out bg-[url('/storage/images/telefone-preto-390px.svg')] hover:bg-[url('/storage/images/telefone-laranja-390px.svg')]"></div>
                    </a>
                    <a href="tel:+554136141400">
                        <p class="text-center text-gray-700">(041) 3614-1400</p>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="cartao">
        <p class="text-center text-gray-700">&copy; 2024 Copyright: Prefeitura Municipal de Araucária - Secretaria Municipal da
            Ciência, Inovação, Tecnologia e Desenvolvimento</p>
    </div>

</body>

</html>
