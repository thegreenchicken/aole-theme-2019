<?php
function familyName($fname)
{
    echo "$fname Refsnes.<br>";
}

function get_template_part_with_var($partName,$var){
    $_GET_TEMPLATE_VARS=$var;
    echo "include: ".$partName.".php";
    include locate_template($partName.".php", false, false);
}

function get_pilots($term_slug = false, $amount = "-1")
{
    $req = array(
        'showposts' => $amount,
        'post_type' => 'pilot',
        // 'posts_per_page' => $amount,
        'orderby' => 'desc',

	);
	
    if ($term_slug) {
        $req['tax_query'] = array(
            array(
                'taxonomy' => 'theme_group',
                'field' => 'slug',
                'terms' => $term_slug,
            ),
        );
    }
	
	$pilots_array = get_posts($req);
    // echo "<!-- get_pilots ";
    // print_r($pilots_array);
    // echo " -->";
    return $pilots_array;
}

function get_all_theme_groups_and_pilots()
{

    // Each theme group is a key value pair. Key being the ID of the theme group, value being a two-dimensional array: 'theme_group_info' and 'pilots'
    $theme_groups = array();

    $taxonomies = array(
        'theme_group',
    );

    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => true,
        'exclude' => array(),
        'exclude_tree' => array(),
        'include' => array(),
        'number' => '',
        'fields' => 'all',
        'slug' => '',
        'parent' => '',
        'hierarchical' => true,
        'child_of' => 0,
        'get' => '',
        'name__like' => '',
        'description__like' => '',
        'pad_counts' => false,
        'offset' => '',
        'search' => '',
        'cache_domain' => 'core',
    );

    $theme_group_informations = get_terms($taxonomies, $args);

    foreach ($theme_group_informations as $idx => $theme_group) {
        // echo "<!-- array(
        //                 'taxonomy' => 'theme_group',
        //                 'field' => 'term_id',
        //                 'terms' => $theme_group->term_id,
		// 			),";
        // echo print_r($theme_group);
        // echo "-->";
        $pilots_array = get_posts(
            array('showposts' => -1,
                'post_type' => 'pilot',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'theme_group',
                        'field' => 'term_id',
                        'terms' => $theme_group->term_id,
                    ),
                ),
            )
        );

        $quotes_array = get_posts(
            array('showposts' => -1,
                'post_type' => 'quotes',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'theme_group',
                        'field' => 'term_id',
                        'terms' => $theme_group->term_id,
                    ),
                ),
            )
        );

        $theme_groups[$theme_group_informations[$idx]->term_id]["theme_group_info"] = $theme_group_informations[$idx];
        $theme_groups[$theme_group_informations[$idx]->term_id]["quotes"] = $quotes_array;
        $theme_groups[$theme_group_informations[$idx]->term_id]["pilots"] = $pilots_array;
    }

    return $theme_groups;
}

function get_custom_pattern_class()
{

    $patterns = ["pattern1", "pattern2", "pattern3", "pattern4"];

    return $patterns[array_rand($patterns)];
}

function format_event_date($start_date, $end_date)
{

    $start_date = date_create($start_date);
    $end_date = date_create($end_date);
    if ($start_date != $end_date) {
        return date_format($start_date, "D d F") . "-" . date_format($end_date, "D d F");
    } else {
        return date_format($start_date, "D d F");
    }

}
