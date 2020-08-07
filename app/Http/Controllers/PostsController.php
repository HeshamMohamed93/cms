<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store', 'edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostsRequest $request
     * @return void
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store('posts');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'category_id' => $request->category_id,
            'image' => $image,
            'user_id' => auth()->user()->id
        ]);
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        session()->flash('success', 'Post Created Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->
        with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category_id']);
        if ($request->hasFile('image')) {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
        $post->update($data);
        session()->flash('success', 'Post Updated Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = POST::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->forceDelete();
            $post->deleteImage();
        } else {
            $post->delete();
        }
        session()->flash('success', 'Post Deleted Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * display trashed posts
     *
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }

    /**
     * restore trashed posts
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore(int $id)
    {
        $post = POST::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post Restored Successfully');
        return redirect(route('posts.index'));
    }
}
