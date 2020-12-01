@extends('layouts.app')

@section('title')
    Welcome!
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('posts.create') }}" title="Create a post"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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
                <td>{{ ++$i }}</td>
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

@endsection