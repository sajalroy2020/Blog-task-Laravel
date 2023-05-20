<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">


            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="{{route('home')}}" class="nav-link pr-3 text-white">Home</a></li>
              <li><a href="{{route('post')}}" class="nav-link px-3 text-white">Post Create</a></li>
              <li><a href="{{route('postList')}}" class="nav-link px-3 text-white">Post List</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
              <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form>

            <div class="text-end">
                @guest
                    @if (Route::has('signin'))
                        <a href="{{route('signin')}}"><button type="button" class="btn btn-outline-light me-2">Sign-in</button></a>
                    @endif
                    @if (Route::has('signin'))
                        <a href="{{route('signup')}}"><button type="button" class="btn btn-warning">Sign-up</button></a>
                    @endif

                    @else

                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>{{ Auth::user()->name }}</b>
                        </button>
                        <ul class="dropdown-menu">
                            <div class="text-dark">
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </ul>
                    </div>
                @endguest
            </div>
          </div>
        </div>
      </header>


     <div class="mb-5">
        <div class="container">
            @if(session()->has('SUCCESS_MESSAGE'))
                <div class="alert alert-success mt-2">
                    {{ session()->get('SUCCESS_MESSAGE') }}
                </div>
            @endif
            @if(session()->has('ERROR_MESSAGE'))
                <div class="alert alert-danger mt-2">
                    {{ session()->get('ERROR_MESSAGE') }}
                </div>
            @endif
            @yield('content')
        </div>
     </div>



      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
