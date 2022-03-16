<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;


class PostController extends Controller
{
    protected $validations = [
        'title' => 'required|string|max:255',
        'content' => 'required|string|max:65535',
        'published' => 'integer|min:0|max:1'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'content' => 'required|string|max:65535',
        //     'published' => 'integer|min:0|max:1',
        // ]);

        $request->validate($this->validations);

        $data = $request->all();

        $tempSlug = Str::of($data['title'])->slug("-");
        $count = 1;
        while (Post::where('slug', $tempSlug)->first()) {
            $tempSlug = Str::of($data['title'])->slug("-") . '-' . $count;
            $count ++;
        }

        $data['slug'] = $tempSlug;
     
        $newPost = Post::create($data);

        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validations);

        $data = $request->all();

        if ($post->title == $data['title']) {
            $tempSlug = $post->slug;
        } else {
            $tempSlug = Str::of($data['title'])->slug("-");
            $count = 1;
            while (Post::where('slug', $tempSlug)->where('id', '!=', $post->id)->first()) {
                $tempSlug = Str::of($data['title'])->slug("-") . '-' . $count;
                $count ++;
            }
        }

        $data['slug'] = $tempSlug;

        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
