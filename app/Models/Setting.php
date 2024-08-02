<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Setting extends BaseModel
{
    use HasTranslations;
    protected $translatable = ['value'];

    static function globals()
    {
        // Because this gets invoked in the web.php file, the very first time we run the application this will crash
        try {
            $settings = Setting::all();
        } catch (\Exception $e) {
            return [];
        }
        $retval = [];
        $settings
            ->map(function($setting) {
                return [
                    'group' => $setting->group,
                    'key' => $setting->key,
                    'parsed' => $setting->parsed(),
                ];
            })
            ->groupBy('group')
            ->each(function($group, $key) use (&$retval) {
                $arr = [];
                $group->each(function($item) use (&$arr) {
                    $arr[$item['key']] = $item['parsed'];
                });
                $retval[$key] = $arr;
            });
        return $retval;
    }

    static function defaults()
    {
        return [
            'general' => [
                'copyright' => 'Sabatino Masala'
            ],
            'seo' => [
                'title' => 'Filament marketing starter',
            ],
            'routes' => [
                'blog' => '/blog',
            ],
            'nav' => [
                'nav_cta_text' => 'Fork me on Github',
                'nav_cta_link' => 'https://github.com/sabatinomasala/filament-marketing-starter',
                'banner' => 'Welcome to the starter kit!',
                'navlinks' => [
                    'type' => 'navlink',
                    'data' => [
                        [
                            'name' => 'Blog',
                            'link' => '/en/blog'
                        ]
                    ]
                ],
            ],
            'footer' => [
                'linkgroups' => [
                    'type' => 'footer',
                    'data' => [
                        [
                            'title' => 'Socials',
                            'links' => [
                                [
                                    'name' => 'Youtube Channel',
                                    'link' => 'https://www.youtube.com/channel/UCU1VNvcwKDmsHqbTtUOaZ-w'
                                ],
                                [
                                    'name' => 'Github',
                                    'link' => 'https://github.com/sabatinoMasala'
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ];
    }
    public function parsed()
    {
        if (!empty($this->value)) {
            try {
                return array_values($this->value)[0]['data']['value'];
            } catch (\Exception $e) {
                \Log::error('Could not parse setting ' . $this->key);
            }
        }
        return null;
    }

}
