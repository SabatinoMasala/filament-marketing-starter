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

## Creating a new block

If you want to create a new block, eg. a Youtube block, you can create a new file in the `Components/blocks` directory called `YoutubeSection.vue`:

```vue
<template>
    <div>
        <iframe width="560" height="315" :src="props.data.url" frameborder="0" allowfullscreen></iframe>
    </div>
</template>
<script setup>
const props = defineProps({
    data: Object,
})
</script>
```

Next up, register the block in Filament/Resources/Blocks/RichContent.php

```php
Builder\Block::make('youtube_section')
->schema([
    Forms\Components\TextInput::make('url'),
]),
```

And that should be it! If you add a YouTube section on a page, it should render this block.

No need to register it in the Renderer component, it will be picked up automatically.

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
`resources/js/Helpers/Asset.js` is responsible for generating the URLs for the images.

# SSR

This starter kit is set up to use SSR with Laravel's Inertia.js.
Simply run:
```
yarn build
php artisan inertia:ssr
```

And you should be good to go.

# Projects using this template

Feel free to send a PR to add your project to the list.

- https://unipage.be/nl
- https://videomat.io/en
