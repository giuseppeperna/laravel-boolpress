<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\PostInformation;
use App\Category;
use App\Tag;
use App\User;
use Faker\Generator as Faker;


class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($search) {
            $posts = DB::table('users')
            ->join('posts', 'user_id', '=', 'users.id')
            ->join('posts_information', 'post_id', '=', 'posts.id')
            ->where('title', 'LIKE', "%$search%")->orWhere('name', 'LIKE', "%$search%")->get();
        }else{
            $posts = Post::paginate(20);
        }

        
        return view('posts.index', compact('posts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request, Faker $faker)
    {
        $userId = Auth::id();
        $data = $request->validated();

        $newPost = Post::create([
            "title" => $data["title"],
            "image_path" => $data["image_path"]->storePublicly('img'),
            "user_id"=> $userId,
            "category_id" => $data["category_id"]
        ]);
        $newPost->save();

        $postInfo = PostInformation::create([
            "post_id" => $newPost->id,
            "description" => $data["description"],
            "slug" => $faker->slug
        ]);

        $postInfo->save();

        foreach ($data["tags"] as $tag){
            $newPost->tags()->attach($tag);
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $info = $post->postInfo;
        $category = $post->categories;

        return view('posts.show', compact('post', 'info', 'category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'categories' => Category::all(),
            'post' => $post,
            'tags' => Tag::all()
        ];

        return view('posts.edit', $data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->tags()->detach();
        $post->update($data);

        $post->postInfo->update($data);
        foreach ($data["tags"] as $tag) {
            $post->tags()->attach($tag);
        }

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->postInfo->delete();
        
        foreach ($post->tags as $tag){
            
            $post->tags()->detach($tag->id);
        }
        $post->delete();

        return redirect()->route('posts.index');
    }
}
