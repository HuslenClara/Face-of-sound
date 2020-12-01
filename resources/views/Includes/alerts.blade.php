@if(count($errors) > 0)
	@foreach($errors->all() as $error)
	<a href="#" class="nes-badge alert-badge">
  		<span class="is-warning">{{$error}}</span>
	</a>
	@endforeach
@endif

@if(session('success'))
	<a href="#" class="nes-badge alert-badge">
  		<span class="is-success">{{session('success')}}</span>
	</a>
@endif

@if(session('error'))
	<a href="#" class="nes-badge alert-badge">
  		<span class="is-error">{{session('error')}}</span>
	</a>
@endif

