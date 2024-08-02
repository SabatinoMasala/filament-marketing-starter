<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug->' . LaravelLocalization::getCurrentLocale(), $slug)->firstOrFail();
        return Inertia::render('Blog/Show', [
            'post' => PostResource::make($post),
        ]);
    }
}
