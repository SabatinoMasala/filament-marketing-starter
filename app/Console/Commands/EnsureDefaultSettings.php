<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class EnsureDefaultSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ensure-default-settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $locale = 'en';
        $defaultSettings = Setting::defaults();
        collect($defaultSettings)->each(function($group, $groupKey) use ($locale) {
            collect($group)->each(function($value, $key) use ($locale, $groupKey) {
                $type = 'string';
                if (isset($value['type'])) {
                    $type = $value['type'];
                }
                if (isset($value['data'])) {
                    $value = $value['data'];
                }
                if (Setting::where('key', $key)->where('group', $groupKey)->exists()) {
                    return;
                }
                $setting = Setting::create([
                    'key' => $key,
                    'group' => $groupKey,
                    'value' => [
                        $locale => [
                            [
                                'type' => $type,
                                'data' => [
                                    'value' => $value
                                ]
                            ]
                        ]
                    ]
                ]);
                $setting->save();
            });
        });
    }
}
