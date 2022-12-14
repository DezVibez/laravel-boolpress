@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach    
    </ul>
</div>
@endif

<div class="container">

    @if($post->exists)
    <form action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
    @else
    <form action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" method="POST">
    @endif
        @csrf
        
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control"
             id="title" required minlenght="5" maxlenght="50" value="{{ old('title', $post->title)  }}" name="title">
        </div>

        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content">
                {{ old('content', $post->content) }}
            </textarea>
        </div>

        <div class="form-group">

            <div>
            <label for="image">Immagine</label>
            </div>
            
            <input type="file" class="@error('image') is-invalid @enderror" id="image-field"
                name="image">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <img class="float-left mr-2 img-fluid w-25"  id="preview"
            src="{{ $post->image ? asset('storage/'. $post->image) : 'https://wopart.eu/wp-content/uploads/2021/10/placeholder-7.png' }}" 
            alt="{{$post->image ? $post->title : 'placeholder' }}">
        </div>

        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id">
                <option value="">Nessuna Categoria</option>
                @foreach($categories as $category)
                @if(old('category_id', $post->category_id ) == $category->id) selected @endif
                <option value="{{ $category->id }}">{{ $category->label }}</option>
                @endforeach
            </select>
        </div>

        <hr>
        @if (count($tags))
            <h4>Tags</h4>
            @foreach($tags as $tag)
            <div class="form-check form-check-inline">
                <input type="checkbox" 
                    class="form-check-input" 
                    id=" tag-{{ $tag->label }}" 
                    name="tags[]" 
                    value="{{ $tag->id }}"
                    @if (in_array($tag->id, old('tags', $prev_tags))) checked @endif> 
                <label class="form-check-label" for=" tag-{{ $tag->label }}">{{ $tag->label }}</label>
            </div>
            @endforeach
        @endif
        
        
        <hr>
        
        <footer class="d-flex justify-content-between">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                Torna indietro <i class="fa-solid fa-rotate-left"></i>
            </a>
            
            <button type="submit" class="btn btn-success">
                Crea <i class="fa-solid fa-plus"></i>
            </button>
        </footer>
    </form>
    
</div>