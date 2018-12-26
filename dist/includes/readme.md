# folder explanation
to reuse code, it is necessary to invoke some files into others. Wordpress has a builtin function for this called `get_template_part()`. The limitation with this method, however, is that php vars are not passed to the requested part. In order to reuse template parts such as post-listing pages, this is needed. One example, is that a different pilots list is required in the homepage, in the pilots page and in the "other pilots" section of a single pilot page. To avoid writing three times the pilot listing page that just vary in the query, I prefered to include files 'the php way', so that php variables can be passed to the included file. I is the simplest and most understandable way, in my view.

## inclusion example
```php

//request an array of posts, using $args as arguments
$args = array( 'post_type' => 'jobs' );
$posts = get_posts($args);
// iterate over the results
foreach ($posts as $post) : setup_postdata($post);
  //locate_template wp function adds fail-safety.
  //lister-job.php has the $post variable available.
  include locate_template('includes/lister-job.php');
endforeach;
//this actually is redundant, unless you do a WP_query
// wp_reset_postdata();

```
# filenames
a post list has two reusable code parts: a single item display function, and a list display function, which calls the single item display function repeatedly.
files are named as plural when their function is to display a list of items, and singular when its function is to display a single item.
* some post types such as events do not have a plural post lister function because the post lists were too different from a normal post.
# more information
Read the comments on each file to learn more in specific about these functions.
