<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\PostCollectionResource;
use App\Http\Resources\PostResource;
use App\Models\Module;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show($slug = 'home')
    {
        $page = Page::where('slug->' . app()->currentLocale(), $slug)->firstOrFail();
        $res = $this->render($page);
        if (request('debug')) {
            dd($page);
        }
        return $res;
    }

    protected function render($page)
    {
        $pageData = PageResource::make($page)->toArray(request());
        $pageData['content'] = collect($page['content'])->map(function($content) {
            if ($content['type'] === 'blog_section') {
                $posts = Post::orderBy('published_at', 'desc')->paginate($content['data']['per_page']);
                $content['data'] = [
                    'items' => PostResource::collection($posts->items())->toArray(request()),
                    'meta' => [
                        'base_path' => '/' . request()->path(),
                        'current_page' => $posts->currentPage(),
                        'first_page_url' => $posts->url(1),
                        'from' => $posts->firstItem(),
                        'last_page' => $posts->lastPage(),
                        'last_page_url' => $posts->url($posts->lastPage()),
                        'links' => $posts->linkCollection()->toArray(),
                        'next_page_url' => $posts->nextPageUrl(),
                        'path' => $posts->path(),
                        'per_page' => $posts->perPage(),
                        'prev_page_url' => $posts->previousPageUrl(),
                        'to' => $posts->lastItem(),
                        'total' => $posts->total(),
                    ]
                ];
            } else if ($content['type'] === 'modules_section') {
                $modules = Module::orderBy('sort_order', 'desc')->get();
                $content['data'] = [
                    'items' => ModuleResource::collection($modules)->toArray(request()),
                    'meta' => [
                        'base_path' => '/' . request()->path(),
                    ]
                ];
            }
            return $content;
        })->toArray();
        return Inertia::render('Page', [
            'page' => $pageData,
        ]);
    }
}
