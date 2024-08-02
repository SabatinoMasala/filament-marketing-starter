<?php

namespace App\Models;

use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\Translatable\HasTranslations;

class Page extends BaseModel
{
    use HasTranslations;
    protected $translatable = ['title', 'slug', 'content', 'seo', 'meta'];

    public function clearCache($locale = 'nl')
    {
        $slug = $this->getTranslation('slug', $locale);
        if ($slug === 'home') {
            $slug = '';
        }
        $url = '/' . $locale;
        if (!empty($slug)) {
            $url .= '/' . $slug;
        }
        ResponseCache::selectCachedItems()->usingSuffix('inertia')->forUrls([$url])->forget();
        ResponseCache::selectCachedItems()->usingSuffix('no-inertia')->forUrls([$url])->forget();
    }

}
