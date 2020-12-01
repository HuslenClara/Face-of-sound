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
    <div class="center">
        <div class="nes-container with-title post">
        
        <span class="title">Шуугиан</span>
        
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="post">
                <strong>Author:</strong>
                    <input type="text" name="author" class="form-control" placeholder="Author">

                <label for="Post">Шуугианы тайлбар</label><br>
                
                <textarea name="body" id="post-txt" placeholder="Шуугианы тухай..." rows="3" cols="35" required></textarea>
            </div>
            <input class="nes-btn is-success" type="submit" id="submit" value="Submit">
        </form>
        </div>
        @if(count($posts) > 1)
        @foreach ($posts as $post)
        <div class="nes-container with-title post"> 
            <span class="title">{{ $post->author }}</span>
            <span class="title title-right">{{ $post->created_at }}</span>
            {{ $post->body }}
             <a href="/posts/{{$post->id}}/edit" class="nes-btn edit-btn"><img src="{{URL('/icons/write.png')}}" class="edit-post"></a>
        </div>
        @endforeach
        {{$posts->links()}}
        @else
        <p>Шуугиан олдсонгүй...</p>
        @endif
    </div>
    
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
        </div>
        <div class="nes-balloon from-left">
            <p>You are gonna be okay.</p>
        </div>
    </div>
</div>
@endsection