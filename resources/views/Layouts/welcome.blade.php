@extends('layouts.master')

@section('title')
Welcome to MusicDoe!
@endsection

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<div class="container">
	<div class="nes-container with-title left is-rounded">
		<span class="title">Events</span>
		<ul class="nes-list is-circle">
			<li>Colors show that is never gonna happen
			</li>
			<li>Colors show that is never gonna happen
			</li>
			<li>Colors show that is never gonna happen
			</li>
		</ul>
	</div>
	<div class="nes-container with-title center">
		
		<span class="title">Шуугиан</span>
		
		<form action="">
			
			<div class="post">
				
				<label for="Post">Шуугианы тайлбар</label><br>
				
				<textarea id="post-txt" placeholder="Шуугианы тухай..." rows="3" cols="40"></textarea>
			</div>
			
			<input class="nes-btn is-success" type="submit" id="submit" value="Submit">
		</form>
	</div>


	
    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Author</th>
            <th>Body</th>
            <th width="280px">Created at</th>
            <th width="280px">Updated at</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ 1 }}</td>
                <td>{{ $post->author }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">

                        <a href="{{ route('posts.show', $post->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('posts.edit', $post->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $posts->links() !!}




	<div class="nes-container with-title right">
		<span class="title">Band</span>
		<ul>
			<li>Member1</li>
			<li>Member2</li>
			<li>Member3</li>
			<li>Member4</li>
		</ul>
		<button class="nes-btn">Start</button>
	</div>
	<div class="nes-container chat-box">
		<div class="nes-balloon from-left">
			<p>Hello NES.css</p>
		</div>
		<div class="nes-balloon from-right">
			<p>Good morning. Thou hast had a good night's sleep, I hope.</p>
		</div>
		<div class="nes-balloon from-left">
			<p>I am lonely</p>
		</div>
		<div class="nes-balloon from-right">
			<p>Me toooo I am so depressed.</p>
		</div>v
		<div class="nes-balloon from-left">
			<p>You are gonna be okay.</p>
		</div>
	</div>
</div>
@endsection