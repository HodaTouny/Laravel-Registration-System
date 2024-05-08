<!-- Header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','HomePage')</title>
    <link rel="stylesheet" href="{{ URL('BootstrapCss/bootstrap.min.css') }}">
    <link rel="icon" href="{{URL('assets/usicon.png')}}">
</head>
<body>
    <header>
    <div class="p-3 mb-2" style="background-color: #753873;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <a href="/" class="d-flex text-white align-items-center my-2 my-lg-0 text-decoration-none">
                <img src="../assets/logo.png" width="180"></a>
                <div class="d-flex flex-wrap align-items-center">
                    <button type="button" class="btn btn-light text-dark me-2 signup">Sign up</button>
                    <button type="button" class="btn btn-light text-dark login disabled">Sign in</button>
                </div>
            </div>
        </div>
    </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">        <p class="col-md-4 mb-0 text-muted">FCAI 2024, Web based</p>
        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </footer>
</body>
</html>