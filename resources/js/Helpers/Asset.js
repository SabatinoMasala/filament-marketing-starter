const recipes = {
    BLOG_CARD: {
        resize: {
            width: 600,
            height: 400,
            fit: 'cover'
        }
    },
    BLOG: {
        resize: {
            width: 850,
            fit: 'contain'
        }
    },
    PERSON_SMALL: {
        resize: {
            width: 100,
            height: 100,
            fit: 'cover'
        }
    },
    DETAIL_SECTION: {
        resize: {
            width: 1700,
            height: 1134,
            fit: 'cover'
        }
    },
};
export default function(path, recipe = null) {
    if (!path) return null;
    if (!import.meta.env.VITE_CDN_URL) {
        return '/storage/' + path;
    }
    if (path.indexOf('svg') !== -1) {
        // SVG files cannot be transformed by the CDN, so we use the S3 bucket directly (not ideal, should be fixed in the future)
        return `https://${import.meta.env.VITE_AWS_BUCKET}.s3.${import.meta.env.VITE_AWS_DEFAULT_REGION}.amazonaws.com/${import.meta.env.VITE_AWS_BUCKET_ROOT}/` + path;
    }
    const edits = recipe ? recipes[recipe] : null;
    const properties = {
        key: `${import.meta.env.VITE_AWS_BUCKET_ROOT}/${path}`,
        edits,
    }
    const base64 = btoa(JSON.stringify(properties));
    return import.meta.env.VITE_CDN_URL + base64;
}
