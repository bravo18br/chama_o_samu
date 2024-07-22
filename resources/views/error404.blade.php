<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/storage/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>404</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="card m-1">
        <img src="/storage/images/404.jpg">
    </div>

    <footer>
        <div class="carao d-flex">
            <div class="item-footer">
                <a target="_blank" href="#">
                    <img src="{{ asset('/storage/images/email.png') }}" alt="" class="icone_footer">
                </a>
                <a target="_blank" href="#">
                    <p class="texto_footer">emailprefeitura@gmail.com</p>
                </a>
            </div>
            <div class="item-footer">
                <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                    <img src="{{ asset('/storage/images/mapa.png') }}" class="icone_footer">
                </a>
                <a target="_blank" href="https://maps.app.goo.gl/cxMaewfPn7s1SjTL9">
                    <p class="texto_footer">Abrir mapa</p>
                </a>
            </div>
            <div class="item-footer">
                <a target="_blank" href="#">
                    <img src="{{ asset('/storage/images/telefone.png') }}" class="icone_footer">
                </a>
                <a target="_blank" href="#">
                    <p class="texto_footer">(041) 3614-1400</p>
                </a>
            </div>
        </div>
        <div class="carao">
            <p style="text-align: center;">&copy; 2024 Copyright: Prefeitura Municipal de Araucária - Secretaria Municipal da Ciência, Inovação, Tecnologia e Desenvolvimento</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>