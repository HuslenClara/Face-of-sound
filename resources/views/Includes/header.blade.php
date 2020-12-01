<link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
<header>
  
  <div class="topnav nes-container">

    @guest

  @if (Route::has('register'))
    <a class="nav-link nes-btn is-success" href="{{ route('register') }}">Register</a>
  @endif
  @if (Route::has('login'))
    <a class="nav-link nes-btn is-primary" href="{{ route('login') }}">Login</a>
  @endif

  @endguest
    @auth
      <a class="nes-btn is-error" id="logout-icon" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
    
    <div class="nes-container is-rounded nav-elements">
      <a class="topnav-item" href="#home"><img src="{{URL('/icons/star.png')}}" class="element-icon"></a>
      <a class="topnav-item" href="#news"><img src="{{URL('/icons/mail.png')}}" class="element-icon"></a>
      <a class="topnav-item" href="#contact"><img src="{{URL('/icons/notice.png')}}" class="element-icon"></a>
      <a class="topnav-item" href="/dashboard"><img src="{{URL('/icons/woman.png')}}" class="element-icon"></a>
    </div>
    
@endauth
    <a id="music-doe" href="/">MUSIC  DOE</a>
  </div>

</header>