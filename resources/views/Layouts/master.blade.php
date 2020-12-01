<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

	<link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
</head>
<body>
	@include('includes.header')
    @include('includes.script')

    @show 
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>