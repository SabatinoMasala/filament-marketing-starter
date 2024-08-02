# Filament marketing starter

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
