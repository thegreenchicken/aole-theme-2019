* ajax-parts: (unused) files which are meant to be requested via ajax. These files generate only JSON or XML without style.
* assets: static files that are needed by the template, such as fall-back pictures.
* css: contains compiled css sheets.
* customizer: contains functions that add controls to the customizer.
* includes: files which are included in different template parts. These files need certain variables to have specific contents before inclusion. Read `includes/readme.md` for more details.
* js: javascript assets. Each file performs a specific group of functions.
* library: this folder is inherited from `foundationpress` theme, and contains some of the few functions that are still useful.
* template-parts-sections: contains the headers for the different sections (pages that list different post types) such as the pilots list page, the events listing page, and one that applies to any other section page.
* 404.php: self explanatory
* footer.php: contains the footer. It calls a page named "footer", so that it's possible to change it through the wp-admin panel.
* functions.php: this is required by wordpress. It contains many functions that customize the template such as adding custom post types and taxonomies, among other things.
* header.php: contains the header which is included on every page.
* index.php: in accordance to the wp template hierarchy, it is the default post-listing page. Currently unused.
* page-events.php: displays the "events" page. It forces a list of posts of the "event" type. This means that although "events" seems like an `archive-{post_type}.php `, it is actually a `page-{slug}.php`. It has been done in this way so that it is possible to have a description with custom fields before the posts list.
* page-home.php: displays the "home" page. It forces a list of posts of the "event" type. This means that although "home" seems like an `archive-{post_type}.php `, it is actually a `page-{slug}.php`. It has been done in this way so that it is possible to have a description with custom fields before the posts list.
* page-jobs.php: displays the "jobs" page. It forces a list of posts of the "event" type. This means that although "jobs" seems like an `archive-{post_type}.php `, it is actually a `page-{slug}.php`. It has been done in this way so that it is possible to have a description with custom fields before the posts list.
* page-news.php: displays the "news" page. It forces a list of posts of the "event" type. This means that although "news" seems like an `archive-{post_type}.php `, it is actually a `page-{slug}.php`. It has been done in this way so that it is possible to have a description with custom fields before the posts list.
* page-pilots.php: displays the "pilots" page. It forces a list of posts of the "event" type. This means that although "pilots" seems like an `archive-{post_type}.php `, it is actually a `page-{slug}.php`. It has been done in this way so that it is possible to have a description with custom fields before the posts list.
* page.php: single page template, currently unused.
* readme.md: this readme file
* screenshot.jpg: picture of the theme that will appear as the theme preview in the wp-admin
* search.php: displays search results. Currently unused, however it can be visited by using /search/<terms>
* searchform.php: unused, currently inaccessible.
* sidebar.php: unused
* single-event.php
* single-pilot.php
* single.php
* style.css: required by wordpress, it only contains information about the theme.
* woocommerce.php: unused
