@extends('layouts.master')

@section('content')
    
    <h2>Шуугианыг засварлах</h2>

    <div class="nes-container with-title post">
        
        <span class="title">Шуугиан</span>
        
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="post">
                <label for="Post">Шуугианы тайлбар</label><br>
                
                <textarea name="body" id="post-txt" placeholder="Шуугианы тухай..." rows="3" cols="35" required>{{ $post->body }}</textarea>
            </div>
            <input class="nes-btn is-success" type="submit" id="submit" value="Submit">
            
        </form>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="nes-btn is-error">Delete</button>
            </form>
        
        </div>

@endsection