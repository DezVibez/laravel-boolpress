<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')
        ->orderBy('created_at', 'DESC')
        ->simplePaginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        $prev_tags = [];
        return view('admin.posts.create', compact('post' , 'categories','tags', 'prev_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
            'title' => 'required|string|unique:posts|min:5|max:50',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
            ],

            [
                'title.required' => 'Il titolo è obbligatorio',
                'content.required' => 'Il contenuto è obbligatorio',
                'title.min'=> 'Il titolo deve avere almeno :min caratteri',
                'title.max'=> 'Il titolo deve avere almeno :max caratteri',
                'title.unique'=> "Esiste già un titolo chiamato $request->title",
                'tags.exists' => 'ID del tag non valido',
                'image.image' => 'il file caricato non è di tipo immagine',
                'image.mimes' => "le estensioni consentite sono jpeg,jpg,png"
            ]);

        $data = $request->all();

        $post = new Post();

        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        
        if(array_key_exists('image', $data)){
            $image_url = Storage::put('post_images', $data['image']);
            $post->image = $image_url;
        }

        $post->save();


        if(array_key_exists('tags', $data)){
            $post->tags()->attach($data['tags']);
        }



        return redirect()->route('admin.posts.show', $post)
            ->with('message', 'Post creato con successo')
            ->with('type', 'success');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::select('id','label')->get();
        $categories = Category::select('id','label')->get();
        $prev_tags = $post->tags->pluck('id')->toArray();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'prev_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
            'title' => [ 'required','string','min:5','max:50', Rule::unique('posts')->ignore($post->id) ],
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
            ],

            [
                'title.required' => 'Il titolo è obbligatorio',
                'content.required' => 'Il contenuto è obbligatorio',
                'title.min'=> 'Il titolo deve avere almeno :min caratteri',
                'title.max'=> 'Il titolo deve avere almeno :max caratteri',
                'title.unique'=> "Esiste già un titolo chiamato $request->title",
                'image.url'=> "url dell'immagine non valido",
                'tags.exists' => 'ID del tag non valido'
            ]);


        $data = $request->all();


        $data['slug'] = Str::slug( $data['title'] , '-');
        
        $post->update($data);

        if(array_key_exists('tags', $data)){
            
            $post->tags()->sync($data['tags']);
        }else {
            $post->tags()->detach();    
        }

        return redirect()->route('admin.posts.show', $post)
            ->with('message', 'Post modificato con successo')
            ->with('type', 'success');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('message', 'Il Post è stato eliminato con successo')
            ->with('type', 'success');
    }
}
