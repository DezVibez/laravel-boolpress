@extends('layouts.app')

@section('content')

<div class="container">
    
    
    <header>
        <h1>
            {{ $post->title }}
        </h1>
    </header>
    
    <div class="clearfix">
        @if($post->image)
        <img class="float-left mr-2" src="{{$post->image}}" alt="{{$post->id}}">
        @endif
        <p>
            {{ $post->content }}
        </p>
        <div>
            <strong>Creato il:</strong> <time>{{ $post->created_at }}</time>
            
            <strong>Modificato il:</strong> <time>{{ $post->updated_at }}</time>

            <strong>Categoria:</strong> <time>{{ $post->category_id }}</time>
        </div>
    </div>
    
    <hr>
    
    
    
    
    <footer class="d-flex align-items-center justify-content-between">
        <form action="{{ route('admin.posts.destroy', $post->id ) }}" method="POST">
            
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">
                <i class="fa-solid fa-trash"></i> Elimina
            </button>

        </form>

        <a href="{{ route('admin.posts.edit', $post) }}">
            <button class="btn btn-warning">
            <i class="fa-solid fa-pen">
                Modifica
            </i>
            </button>
        </a>


        <a class="btn btn-secondary" href=" {{ route('admin.posts.index') }}">
            <i class="fa-solid fa-rotate-left"></i> Indietro
        </a>
    </footer>
    
    
</div>
    @endsection

