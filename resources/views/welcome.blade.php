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
                <div>
                    <div class="d-flex flex-wrap align-items-center">
                        <button type="button" class="btn btn-light text-dark me-2 signup">{{__('messages.sign_up')}}</button>
                        <button type="button" class="btn btn-light text-dark login disabled">{{__('messages.sign_in')}}</button>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 10px;">
                                {{__('messages.en')}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuButton">
                                <a class="dropdown-item" href={{url('locale/en')}} >{{__('messages.en')}}</a>
                                <a class="dropdown-item"  href={{url('locale/ar')}} >{{__('messages.ar')}}</a>
                            </div>
                        </div>
                    </div>
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
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">@lang('messages.home')</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">@lang('messages.features')</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">@lang('messages.pricing')</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">{{__('messages.faqs')}}</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">{{__('messages.about')}}</a></li>
        </ul>
      </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ URL('js/Languages.js') }}"></script>

</body>
</html>
