<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Category;
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

    public function create_view(){
        return view('home.create');
    }

    /**
     *@param Request $request
     */
    public function create(Request $request){
        $validatedPost = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->author_id = auth()->user()->id;
        $post->content = $request->content;
        $post->save();

        return redirect(route('home_page'))->with('success', 'Post created.');
    }
    public function showPublished(){
        $posts = Post::where('status', PostStatus::PUBLISHED)->paginate(3);
        return view('home.index', ['posts' => $posts]);
    }
    /**
     *@param int $post_id
     */
    public function show($post_id){
        $post = Post::getPostById($post_id);
        $categories = Category::all();
        return view('home.show', ['post' => $post, 'categories' => $categories]);
    }

    public function showDrafts(){
        $posts = Post::where('status', PostStatus::DRAFT)->paginate(3);
        return view('home.index', ['posts' => $posts]);
    }

    /**
     * @param int $post_id
     */
    public function delete($post_id){
        $post = Post::find($post_id);

        if(!$post) {
            return response()->json(['message' => 'not found'], 404);
        }
        $post->delete();
        return redirect(route('home_page'));
//        return response()->json(['message' => 'deleted successfully'], 200);
    }

    /**
     *@param Request $request
     * @param int $post_id
     */
    public function edit(Request $request,$post_id){
        $post = Post::getPostById($post_id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->categories()->sync($request->input('category_ids'));


        if($request->hasFile('preview')){
            $image = $request->file('preview');
            $image_name = $post_id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);

            $postImage = $post->images()->firstOrNew([]);
            $postImage->url = 'images/' . $image_name;
            $postImage->save();
            $post->preview = $postImage->url;
        }

        if($request->has('status')){
            $post->status = PostStatus::DRAFT;
        }else{
            $post->status = PostStatus::PUBLISHED;
        }

        $post->save();

        return redirect()->route('show_page', $post_id)->with('success', 'Пост успешно обновлен');
    }
}
