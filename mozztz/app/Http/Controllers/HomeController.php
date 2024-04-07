<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $posts = Post::paginate(3);
        return view('home.index', ['posts' => $posts]);
    }

    public function show($post_id){
        $post = Post::getPostById($post_id);
        return view('home.show', ['post' => $post]);
    }

    public function delete($post_id){
        return;
    }

    public function edit(Request $request,$post_id){
        $post = Post::getPostById($post_id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if($request->hasFile('preview')){
            $image = $request->file('preview');
            $image_name = $post_id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);

            $postImage = $post->images()->firstOrNew([]);
            $postImage->url = 'images/' . $image_name;
            $postImage->save();
            $post->preview = $postImage->url;
        }

        $post->save();

        return redirect()->route('show_page', $post_id)->with('success', 'Пост успешно обновлен');
    }
}
