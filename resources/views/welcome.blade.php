<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/storage/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/assets/app-C24ONnXZ.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Chama o Samu</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="background-image"></div>
    <input id="idUrlsToCache" class="d-none" value="{{ json_encode($urlsToCache) }}">
    <div class="carao">
        <p class="text-center fw-bold fs-2">Chama o Samu</p>
    </div>
    <div class="carao">
        <div class="row m-1">
            <div class="col-sm-6 p-1 d-flex flex-column align-items-center">
                <img class="img-fluid w-sm-75 w-md-50 w-lg-25" src="{{ asset('/storage/images/surdo-imagem.jpg') }}"
                    style="border-radius:5px;">
            </div>
            <div class="col-sm-6 p-1 d-flex flex-column align-items-center justify-content-center">
                <div style="text-align: justify;">
                    <a class="btn btn-warning m-1 p-3" href="{{ route('briefing') }}" role="button"><b>BRIEFING
                            (desenvolvedores)</b></a>
                    <p>Esta aplicação foi criada para assegurar o atendimento médico de urgência a pessoas com
                        deficiência auditiva e/ou com incapacidade de fala (afonia) ao Serviço de Atendimento Móvel de
                        Urgência (SAMU).</p>
                    <p>Conforme <a href="https://araucaria.atende.net/diariooficial/edicao/2045/texto/203101"
                            style="color: blue; text-decoration: underline;" target="_blank">Lei Municipal nº 4.375 de
                            15 de março de 2024</a>.</p>
                    <p>Para utilizar o aplicativo e garantir atendimento rápido e eficiente, clique no botão
                        <b>Registrar</b>.
                    </p>
                    <p>Caso já seja cadastrado, clique em <b>Entrar</b> no botão abaixo!</p>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 p-1 d-flex flex-column align-items-center">

            </div>
            <div class="col-sm-6 p-1 d-flex flex-column align-items-center">
                <div>
                    <a class="btn btn-primary m-1 p-3" href="{{ route('login') }}" role="button"><b>Entrar</b></a>
                    <a class="btn btn-secondary m-1 p-3" href="{{ route('register') }}"
                        role="button"><b>Registrar</b></a>
                </div>
            </div>
        </div>
    </div>

    <footer class="carao d-flex flex-column justify-content-center align-items-center">
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
    <div class="carao">
        <p class="text-center">&copy; 2024 Copyright: Prefeitura Municipal de Araucária - Secretaria Municipal da
            Ciência, Inovação, Tecnologia e Desenvolvimento</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('build/assets/app-D2jpX1vH.js') }}" type="module"></script>
    <script type="module" src="{{ asset('/storage/js/vlibras.js') }}"></script>
</body>

</html>