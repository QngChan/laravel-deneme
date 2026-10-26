<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        return view('Pages.main', compact('posts'));
    }

    public function contact(): View
    {
        return view('Pages.contact');
    }

    public function post(): View
    {
        $post = Post::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->first();

        return view('Pages.post', compact('post'));
    }

    public function showPost(Post $post): View
    {
        abort_if($post->published_at === null, 404);

        return view('Pages.post', compact('post'));
    }

    public function about(): View
    {
        return view('Pages.about');
    }
}
