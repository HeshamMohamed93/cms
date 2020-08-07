<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $search = request()->query('search');
        if (request()->query('search')) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(3);
        } else {
            $posts = Post::simplePaginate(3);
        }
        return view('welcome')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', $posts);
    }

    public function category(Category $category)
    {
        return view('blog.category')->with('category', $category)
            ->with('posts', $category->posts()->simplePaginate(3))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')->with('tag', $tag)
            ->with('posts', $tag->posts()->simplePaginate(3))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
