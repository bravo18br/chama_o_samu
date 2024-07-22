<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/storage/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Chama o Samu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="background-image"></div>
    <div class="cartao">
        <p class="text-center fw-bold fs-2">Chama o Samu</p>
    </div>
    <div class="cartao">
        <a class="btn btn-warning m-1 p-3" href="{{ route('home') }}" role="button"><b>VOLTAR</b></a>

        <p class="fw-bold fs-2">Resumo:</p>
        <p>O público alvo é SURDO ou MUDO (ou ambos)</p>
        <p>O objetivo é que eles consigam abrir um chamado de emergência para o SAMU, usando de preferência as imagens.
        </p>
        <p>Abaixo tem um usuário de cada tipo, para experimentar as funções</p>
        <p>Os relatórios são features extras, estou ajustando ainda...</p>
        <table class="m-1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2;">Login
                    </th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2;">Senha
                    </th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2;">Tipo
                    </th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2;">
                        Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">super_admin@gmail.com</td>
                    <td style="border: 1px solid #000; padding: 8px;">12345678</td>
                    <td style="border: 1px solid #000; padding: 8px;">SuperADM</td>
                    <td style="border: 1px solid #000; padding: 8px;">Para nós usarmos, para manutenção. Colocarei mais
                        recursos, caso haja necessidade.</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">operador_samu@gmail.com</td>
                    <td style="border: 1px solid #000; padding: 8px;">12345678</td>
                    <td style="border: 1px solid #000; padding: 8px;">Operador SAMU</td>
                    <td style="border: 1px solid #000; padding: 8px;">É o atendente do SAMU, que vai receber, tratar e
                        encerrar os chamados. Ele não consegue reabrir um chamado encerrado.</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">user_alfa@gmail.com</td>
                    <td style="border: 1px solid #000; padding: 8px;">12345678</td>
                    <td style="border: 1px solid #000; padding: 8px;">Usuário ALFA</td>
                    <td style="border: 1px solid #000; padding: 8px;">É um usuário alfabetizado. Legendas são exibidas.
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">user_analfa@gmail.com</td>
                    <td style="border: 1px solid #000; padding: 8px;">12345678</td>
                    <td style="border: 1px solid #000; padding: 8px;">Usuário ANALFA</td>
                    <td style="border: 1px solid #000; padding: 8px;">É um usuário analfabeto. Não tem legendas.</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;">samu_admin@gmail.com</td>
                    <td style="border: 1px solid #000; padding: 8px;">12345678</td>
                    <td style="border: 1px solid #000; padding: 8px;">Admin SAMU</td>
                    <td style="border: 1px solid #000; padding: 8px;">É um administrador do SAMU. Ele pode cadastrar os
                        operadores. Pode reabrir chamado.</td>
                </tr>
            </tbody>
        </table>
        <a class="btn btn-warning m-1 p-3" href="{{ route('home') }}" role="button"><b>VOLTAR</b></a>
    </div>

    <footer class="cartao d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center">
            <div class="row">
                <div class="item-footer col-sm-4">
                    <a target="_blank" href="mailto:prefeitura@araucaria.pr.gov.br">
                        <img src="{{ asset('/storage/images/email.png') }}" alt="" class="icone_footer">
                    </a>
                    <a target="_blank" href="mailto:prefeitura@araucaria.pr.gov.br">
                        <p class="texto_footer">prefeitura@araucaria.pr.gov.br</p>
                    </a>
                </div>
                <div class="item-footer col-sm-4">
                    <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                        <img src="{{ asset('/storage/images/mapa.png') }}" class="icone_footer">
                    </a>
                    <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                        <p class="texto_footer">Abrir mapa</p>
                    </a>
                </div>
                <div class="item-footer col-sm-4">
                    <a href="tel:+554136141400">
                        <img src="{{ asset('/storage/images/telefone.png') }}" class="icone_footer">
                    </a>
                    <a href="tel:+554136141400">
                        <p class="texto_footer">(041) 3614-1400</p>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <div class="cartao">
        <p class="text-center">&copy; 2024 Copyright: Prefeitura Municipal de Araucária - Secretaria Municipal da
            Ciência, Inovação, Tecnologia e Desenvolvimento</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="module" src="{{ asset('/storage/js/vlibras.js') }}"></script>
</body>

</html>