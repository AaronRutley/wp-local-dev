## Local Dev Plugin (Beta)

Very simple plugin for local dev helpers including:

* Admin bar colour change (local only)
* Image Proxy (Hacky JS for a first pass)
* Live Reload

### To use, define the following in your (local) wp-config.php

```
define('LOCAL_URL', 'http://yoursite.dev');
define('REMOTE_URL', 'http://yoursite.com');
define('LOCAL_LIVE_RELOAD', true);
define('LOCAL_IMAGE_PROXY', true);
```
