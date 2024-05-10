
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>LyF Confecciones</title>

  

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->

<link rel="icon" href="public/favicon-16x16.png" sizes="16x16" type="image/png">

<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        content: url('../assets/images/jeans-5394561_640.jpg')
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">

    <!-- Background image -->
<div class="bg-image" style="background-image: url('../assets/images/jeans-5394561_640.jpg');
  height: 100vh;"></div>
<!-- Background image -->
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <img class="logo" src="{{ ("../assets/images/lyflogo5v2.png") }}" alt="logo">      
      <h3 class="float-md-start mb-0">Bienvenido!</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="/catalogo">Catalogo</a>
        {{-- <a class="nav-link" href="#">Empleados</a> --}}
        <a class="nav-link" href="/contacto">Contacto</a>
        <a class="nav-link" href="/login">Login</a>
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>Bienvenido a LyF Confecciones</h1>
    <p class="lead">Somos una empresa dedicada a la confecciones de bluyines y uniformes con un enfoque en producir articulos de calidad superior a un precio justo.</p>
    <p class="lead">
      <a href="/carousel" class="btn btn-lg btn-secondary fw-bold border-white ">Conozcanos</a>
    </p>
  </main>

  <footer class="mt-auto text-white-50">
    <p>LyF Confecciones &copy2024 </p>
  </footer>
</div>


    
  </body>
</html>
