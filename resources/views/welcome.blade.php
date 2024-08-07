<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/storage/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/assets/app-C24ONnXZ.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Chama o Samu</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @env('local')
    <div class="cartao" style="color: white; font-size: 25px; position: fixed; top: 10px; right: 10px; z-index: 1000; background: rgba(0, 0, 0, 0.7); padding: 10px; border-radius: 5px;">
        <p class="d-block d-sm-none">TELA XS - max-width: 575px</p>
        <p class="d-none d-sm-block d-md-none">TELA SM - max-width: 767px</p>
        <p class="d-none d-md-block d-lg-none">TELA MD - max-width: 991px</p>
        <p class="d-none d-lg-block d-xl-none">TELA LG - max-width: 1199px</p>
        <p class="d-none d-xl-block d-xxl-none">TELA XL - max-width: 1399px</p>
        <p class="d-none d-xxl-block">TELA XXL - min-width: 1400px</p>
    </div>
    <div class="cartao" style="color: white; font-size: 30px; position: fixed; top: 10px; left: 10px; z-index: 1000; background: rgba(0, 0, 0, 0.7); padding: 10px; border-radius: 5px;">
        <p>MODO DE DESENVOLVIMENTO</p>
        <p>APP_ENV=local</p>
    </div>
    @endenv
    <div class="background-image"></div>
    <div class="overlay"></div>
    <input id="idUrlsToCache" class="d-none" value="{{ json_encode($urlsToCache) }}">
    <div class="cartao d-flex justify-content-center align-items-center">
        <img class="img-fluid w-sm-75 w-md-50 w-lg-25" src="{{ asset('/storage/images/logo-CS-tipo-cor-192.png') }}">
    </div>

    <div class="cartao">
        <div class="row m-1">
            <div class="col-sm-6 p-1 d-flex flex-column align-items-center">
                <img class="image-welcome" src="{{ asset('/storage/images/surdo-imagem.png') }}">
            </div>
            <div class="col-sm-6 p-1 d-flex flex-column align-items-center justify-content-center">
                <div class="texto_welcome" style="text-align: justify;">
                    @env('local')
                    <a class="btn btn-warning m-1 p-3" href="{{ route('briefing') }}" role="button">
                        <b>BRIEFING (desenvolvedores)</b>
                    </a>
                    @endenv
                    <p>Esta aplicação foi criada para assegurar o atendimento médico de urgência a pessoas com
                        deficiência auditiva e/ou com incapacidade de fala (afonia) ao Serviço de Atendimento Móvel de
                        Urgência (SAMU).</p>
                    <p>Conforme <a href="https://araucaria.atende.net/diariooficial/edicao/2045/texto/203101" style="color: blue; text-decoration: underline;" target="_blank">Lei Municipal nº 4.375 de
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
            <div class="col-sm-6 p-1 d-flex justify-content-center">
                <a class="btn-cor-principal-1 btn-entrar" href="{{ route('login') }}" role="button"><b>Entrar</b></a>
                <a class="btn-cor-principal-1 btn-registrar" href="{{ route('register') }}" role="button"><b>Registrar</b></a>
            </div>
        </div>
    </div>

    <footer class="cartao d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center">
            <div class="row">
                <div class="item-footer col-sm-4">
                    <a target="_blank" href="mailto:prefeitura@araucaria.pr.gov.br">
                        <div class="icone_footer icone_email"></div>
                    </a>
                    <a target="_blank" href="mailto:prefeitura@araucaria.pr.gov.br">
                        <p class="texto_footer">prefeitura@araucaria.pr.gov.br</p>
                    </a>
                </div>
                <div class="item-footer col-sm-4">
                    <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                        <div class="icone_footer icone_mapa"></div>
                    </a>
                    <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                        <p class="texto_footer">Abrir mapa</p>
                    </a>
                </div>
                <div class="item-footer col-sm-4">
                    <a href="tel:+554136141400">
                        <div class="icone_footer icone_telefone"></div>
                    </a>
                    <a href="tel:+554136141400">
                        <p class="texto_footer">(041) 3614-1400</p>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="cartao">
        <p class="text-center texto_copyright">&copy; 2024 Copyright: Prefeitura Municipal de Araucária - Secretaria Municipal da
            Ciência, Inovação, Tecnologia e Desenvolvimento</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('build/assets/app-D2jpX1vH.js') }}" type="module"></script>
    <script type="module" src="{{ asset('/storage/js/vlibras.js') }}"></script>
    <script>
        var appEnv = "{{ env('APP_ENV') }}";
        var appDebug = "{{ env('APP_DEBUG') }}"
    </script>
    <script type="module" src="{{ asset('/storage/js/git.js') }}"></script>
</body>

</html>
