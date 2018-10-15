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

4. Fill in `.env` with your local config values.  Pay particular attention to
   the `PRIMARY_SITE_URL` value which will depend on your local hostnames.  For
   example:  `http://www.classicpress.local:8000`

5. Point the relevant hostnames to `127.0.0.1` in your `/etc/hosts` file.  For
   example:

```
127.0.0.1 classicpress.local
127.0.0.1 www.classicpress.local
127.0.0.1 translate.classicpress.local
```

6. Run a development server on PHP 7.0 or greater:

```
php -S classicpress.local:8000
```

7. If you have
   [WP-CLI](https://wp-cli.org/) installed locally, which we highly recommend,
   you can add yourself as a local, administrative user:

```
wp user create localdev localdev@example.com --role=administrator --user_pass=localdev
wp super-admin add localdev
```

8. Log in and use/develop the site!  Please submit issues or changes back to
   this repository.
