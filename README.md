# ClassicPress Network

This is the code repository for the `*.classicpress.net` multisite network.

## Local development

1. Clone this repository:

```
git clone https://github.com/ClassicPress/ClassicPress-Network.git
cd ClassicPress-Network
```

2. Get a database dump and install it.  For now, you'll need to ask a site
   administrator for help with this.

3. If you're working on the main site, you'll need to grab a copy of the
   `elementor-pro` plugin (for now, until we can remove it).  Ask a site
   administrator for help with this.

4. Fill in `.env` with your local config values.  Be sure to set
   `WP_DEBUG=true`, and pay particular attention to the `PRIMARY_SITE_URL`
   value which will depend on your local hostnames.  For example:
   `http://www.classicpress.local:8000`

5. [Install `composer`](https://getcomposer.org/doc/00-intro.md)
   if you don't already have it, and run `composer install`.

6. Point the relevant hostnames to `127.0.0.1` in your `/etc/hosts` file.  For
   example:

```
127.0.0.1 classicpress.local
127.0.0.1 www.classicpress.local
127.0.0.1 translate.classicpress.local
```

7. If you have
   [WP-CLI](https://wp-cli.org/)
   installed locally, which we highly recommend, you can replace the multisite
   installation URLs in the database to fix some issues across the site:

```
for i in www translate docs; do
   wp search-replace --network $i.classicpress.net $i.classicpress.local:8000
done
# if you are not using https locally:
wp search-replace --network https: http:
```

8. Run a development server on PHP 7.0 or greater:

```
php -S classicpress.local:8000
```

9. Add yourself as a local, administrative user (also requires WP-CLI):

```
bin/add-local-user.sh
# or
bin/add-local-user.sh mylocaluser mylocalpass
```

10. Log in and use/develop the site!  Please submit issues or changes back to
    this repository.
