
@extends('layouts.master')

@section('title')
Welcome to MusicDoe!
@endsection

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<div class="container">
    <div class="nes-container with-title left is-rounded">
        <span class="title">Эвэнтүүд</span>
        <ul class="nes-list is-circle">
        @if(count($events) > 0)
        @foreach ($events as $event)
            <li>
            {{ $event->description }}
            </li>
            {{ $event-> date}}
            
            {{ $event-> time}}
        @endforeach
        {{$events->links()}}
        @else
        <p>Эвэнт олдсонгүй...</p>
        @endif
        </ul>
        <a class="nes-btn" href="/events/create">Add Event</a>

    </div>    
    <div class="center">
        <audio id="aud2"></audio>
        
        @auth
        <div class="nes-container with-title write-post">

            <span class="title">Шуугиан</span>


            <button hidden class="nes-btn" id="colbtnStart">START RECORDING</button>
            <button class="nes-btn" id="btnStart">START RECORDING</button>
            <button class="nes-btn" id="btnStop">STOP RECORDING</button>

            

            <form id="post-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="post">
                    <label for="Post">Шуугианы тайлбар</label><br>
                    <textarea name="body" id="post-txt" placeholder="Шуугианы тухай..." rows="3" cols="35" required></textarea>
                    <input type="file" name="audiofile" id="audio-input" hidden>
                </div>
                <input class="nes-btn is-success" type="submit" id="submit" value="Submit">
            </form>

            
        </div>
        @endauth
        @include('includes.alerts')
        @if(count($posts) > 0)
        <?php
        foreach ($posts as $post){
            $audio = "http://localhost:8000/audioFiles/".$post->audio."";

            echo'<div class="nes-container with-title post"> 
            <span class="title">'.$post->user->username.' </span>
            <span class="title title-right">'.$post->created_at.' </span>
            <p>'.$post->body.'</p> 

            <audio controls controlsList="nodownload" src="'.$audio.'"></audio>
            <a href="/posts/'.$post->id.'/collab" class="nes-btn edit-btn">Collab</a>

            </div>';
        }
        ?>
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