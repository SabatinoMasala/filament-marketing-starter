# Filament marketing starter

In this video, I talked about how we use Filament over at [Unipage for our marketing website](https://unipage.be/nl).

[![Watch the video](https://i.ytimg.com/vi/U5eViAKHD0o/maxresdefault.jpg)](https://youtu.be/U5eViAKHD0o)

I've gotten a couple of requests to open-source the template, and here we are.

# Getting started

Clone the repository and run the following commands:

```bash
# Install dependencies
composer install
# Migrate the database & fill it with data
php artisan migrate
# Create a first user
php artisan filament:user
```

Visit /admin and log in with the user you just created.
Now you can manage pages & articles in the Filament admin panel.

# How do blocks work?

Blocks are a way to create reusable components that can be added to pages.
We have a dynamic Renderer component that can render any block that is added to the `Components/blocks` directory.
Using a glob Vite is able to load all the blocks and make them available to render:
```
// Template
<component :is="getComponent(section.type)" :data="section.data" />

// Script
const blocks = import.meta.glob('./blocks/*.vue', { eager: true });
const makeComponent = (name) => {
    return blocks[`./blocks/${name}.vue`].default;
}

const getComponent = (type) => {
    const component = capitalize(snakeToCamel(type));
    return makeComponent(component);
}
```

# How do settings work?

[KeyValue](https://filamentphp.com/docs/3.x/forms/fields/key-value) in Filament only allows for strings to be added, but we found this was a bit too limiting.
In this template, a Setting is an eloquent model with a key/value and a group. In Filament, the value of the setting is mapped to a single block, and in the code you can access the setting as follows:

In PHP:
```php
c('routes.blog'); // 'Routes' is the group, 'blog' is the key
```

In Vue:
```Vue
<template>
    <pre>$page.props.globals.routes.blog</pre>
</template>
<script setup>
import {usePage} from "@inertiajs/vue3";
const blog = usePage().props.globals.routes.blog;
</script>
```

You can configure 'defaults' in the Config model, and when you deploy the website it's important these defaults get copied over to the database so you can customize them in Filament.
In your deploy script, add the following command:
```
php artisan app:ensure-default-settings
```

# Configuring an AWS serverless image handler

This starter kit is able to use the AWS serverless image handler to resize images on the fly.
Set up this service by following the steps outlined here: https://aws.amazon.com/solutions/implementations/serverless-image-handler/

To activate the service, add the following environment variables to your `.env` file:

```bash

# Configure S3 as the filesystem for the images
FILESYSTEM_DISK=s3
FILAMENT_FILESYSTEM_DISK=s3

# Configure AWS credentials
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=... # The region where your S3 bucket is deployed
AWS_BUCKET=... # The name of the S3 bucket
AWS_BUCKET_ROOT=... # The root folder in the S3 bucket where the images are stored, e.g. "images"
AWS_USE_PATH_STYLE_ENDPOINT=false

# The following variables are used by the frontend and should be added to .env
VITE_AWS_DEFAULT_REGION="${AWS_DEFAULT_REGION}"
VITE_AWS_BUCKET="${AWS_BUCKET}"
VITE_AWS_BUCKET_ROOT="${AWS_BUCKET_ROOT}"
VITE_CDN_URL=... # The URL of the CloudFront distribution that serves the images
```

And that's it, images uploaded to S3 will now be served through your serverless image handler.
`resources/js/Helpers/Asset.js` is responsible for generating the URLs for the images as the URL needs to be base64 encoded.

# SSR

This starter kit is set up to use SSR with Laravel's Inertia.js.
Simply run:
```
yarn build
php artisan inertia:ssr
```

And you should be good to go.

# Generating sitemaps

This template uses https://github.com/spatie/laravel-sitemap to generate sitemaps, refer to the docs.

# Responsecache

This template uses https://github.com/spatie/laravel-responsecache to cache the entire response coming from a controller.
By default, it is incompatible with Inertia, hence we created an [InertiaAwareCacheProfile](https://github.com/SabatinoMasala/filament-marketing-starter/blob/main/app/Http/CacheProfiles/InertiaAwareCacheProfile.php). Using this profile, the library is able to create 2 cached versions per page:
- An HTML representation (first visit)
- A JSON representation (subsequent visit using Inertia)

When pages/posts/settings are updated, we need to clear the cache 2 times (JSON + HTML) as seen here: https://github.com/SabatinoMasala/filament-marketing-starter/blob/0fb1b3bdbb4d6d325e31d23ab88ec413e5cb9888/app/Models/Page.php#L23

Other than that, it's best practice to clear the entire cache when doing a deploy, so the new assets (js, css, images) are correctly loaded.

# Projects using this template

Feel free to send a PR to add your project to the list.

- https://unipage.be/nl
- https://videomat.io/
