<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minha Aplicação')</title>

    <!-- Incluindo Bootstrap via CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- AJAX e Bootstrap JS via CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Inicio</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer class="mt-5">
        <div class="text-center py-3">
            © 2024 - Meu Sistema
        </div>
    </footer>

    <!-- Coloque outros scripts aqui, caso necessário -->
    @stack('scripts')

</body>
</html>
