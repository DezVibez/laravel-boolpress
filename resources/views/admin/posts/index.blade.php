@extends('layouts.app')

@section('content')

   
<header class="d-flex justify-content-between container">
    <h1>
        Post List
    </h1>

    <a href="{{ route('admin.posts.create') }}" >
            
        
            <button class="btn btn-success btn-sm mt-2">
                <i class="fa-solid fa-plus"></i> Crea Nuovo
            </button>

    </a>

</header>

<main class="container">
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titolo </th>
      <th scope="col">Categoria</th>
      <th scope="col">Autore</th>
      <th scope="col">Slug</th>
      <th scope="col">Creato il</th>
      <th scope="col">Modificato il</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody>
    @forelse($posts as $post)
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{{ $post->title }}</td>
      <td> <span class="badge badge-pill badge-{{ $post->category['color'] ?? ''}}">{{ $post->category['label'] ?? ''}}</span> </td>
      <td>{{ $post->user_id }}</td>
      <td>{{ $post->slug }}</td>
      <td>{{ $post->created_at }}</td>
      <td>{{ $post->updated_at }}</td>
      <td>

      <div class="d-flex">
        <a href="{{ route('admin.posts.show', $post) }}">
            <button class="btn btn-sm btn-primary">
            <i class="fa-solid fa-magnifying-glass">
                
            </i>
            </button>
        </a>

        <a href="{{ route('admin.posts.edit', $post) }}">
            <button class="btn btn-sm btn-warning mx-2">
            <i class="fa-solid fa-pen">
                
            </i>
            </button>
        </a>

        <form action="{{ route('admin.posts.destroy', $post->id ) }}" method="POST">
            
            @method('DELETE')
            @csrf
            <button class="btn btn-danger btn-sm " type="submit">
                <i class="fa-solid fa-trash"></i>
            </button>

        </form>
      </div>
        

      </td>
    </tr>
    @empty
    <tr>
      <td scope="row"> <h3 class="text-center"> Nessun post </h3> </td>
    </tr>
    @endforelse
    
  </tbody>
</table>

<nav class="mt-3">
  @if($posts->hasPages())
    {{$posts->links()}}
  @endif
</nav>

</main>


@endsection