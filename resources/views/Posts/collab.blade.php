@extends('layouts.master')

@section('content')

@include('includes.concat')

<link rel="stylesheet" type="text/css" href="{{ asset('css/collab.css') }}">

<div class="nes-container with-title post-edit">
    <span class="title">Шуугиан дээр өөрийн аяыг нэмэх</span>
    <audio></audio>
    <button class="nes-btn" id="btnStart" hidden>START RECORDING</button>
    <button class="nes-btn" id="colbtnStart">START RECORDING</button>
    <button class="nes-btn" id="btnStop">STOP RECORDING</button>
    <br><br>
    <form id="post-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <?php
        $audio = "http://localhost:8000/audioFiles/".$post->audio."";

            echo'<div class="nes-container with-title post"> 
            <span class="title">'.$post->user->username.' </span>
            <span class="title title-right">'.$post->created_at.' </span>
            <p>'.$post->body.'</p> 

            <audio id="parentAud" controls controlsList="nodownload" src="'.$audio.'"></audio>
            </div>
            <p id="parentAudID">'.$audio.'</p>'
        ?>
        <br><br>
        <progress id="progress-bar" class="nes-progress is-primary" value="0" max="100"></progress>
        <p id="loading"></p>
        <br>
        <audio id="aud2" controls></audio>
        <div class="post">
            <label for="Post">Шуугианы тайлбар</label><br>
            <textarea name="body" id="post-txt" placeholder="Шуугианы тухай..." rows="3" cols="35" required></textarea>
            <input type="file" name="audiofile" id="audio-input">
        </div>
        <input type="text" name="parent_post_id" value="{{$post->id}}" hidden>
        <input class="nes-btn is-success" type="submit" id="submit" value="Submit">
    </form>
    <a href="/" class="nes-btn is-error">Cancel</a>

</div>

@endsection