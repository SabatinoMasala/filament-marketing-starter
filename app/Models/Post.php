<?php

namespace App\Models;

use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\Translatable\HasTranslations;

class Post extends BaseModel
{
    use HasTranslations;
    protected $translatable = ['title', 'slug', 'content', 'short_description', 'seo', 'meta'];

    protected $dates = [
        'published_at'
    ];

    public function clearCache($locale = 'nl')
    {
        $slug = $this->getTranslation('slug', $locale);
        $url = '/' . $locale . c('routes.blog');
        if (!empty($slug)) {
            $url .= '/' . $slug;
        }
        ResponseCache::selectCachedItems()->usingSuffix('inertia')->forUrls([$url])->forget();
        ResponseCache::selectCachedItems()->usingSuffix('no-inertia')->forUrls([$url])->forget();
    }

}
