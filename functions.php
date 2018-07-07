<?php

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');	
	
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'custom-logo' );
	
function register_my_menus() {
  register_nav_menus(
    array(
      'main' => __( 'Hoofd Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );
	
	function arphabet_widgets_init() {
		
		register_sidebar( array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar',
			'before_widget' => '<div class="sidebar">',
			'after_widget'  => '</div>',
		) );		
		
		register_sidebar( array(
			'name'          => 'Footer een',
			'id'            => 'footer_een',
			'before_widget' => '<div class="footer_een">',
			'after_widget'  => '</div>',
		) );
		
		register_sidebar( array(
			'name'          => 'Footer twee',
			'id'            => 'footer_twee',
			'before_widget' => '<div class="footer_twee">',
			'after_widget'  => '</div>',
		) );	
		
		register_sidebar( array(
			'name'          => 'Footer drie',
			'id'            => 'footer_drie',
			'before_widget' => '<div class="footer_drie">',
			'after_widget'  => '</div>',
		) );	
		
		register_sidebar( array(
			'name'          => 'Footer vier',
			'id'            => 'footer_vier',
			'before_widget' => '<div class="footer_vier">',
			'after_widget'  => '</div>',
		) );	
		
		register_sidebar( array(
			'name'          => 'Conditions Menu Copyright',
			'id'            => 'conditions',
			'before_widget' => '<div class="conditions">',
			'after_widget'  => '</div>',
		) );		
}

add_action( 'widgets_init', 'arphabet_widgets_init' );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page('Logo');
	acf_add_options_page('Opties');
	
}


function wpdocs_custom_excerpt_length( $length ) {
    return 5;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 5 );


function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//paginations for newsletter

     //define in function file
      function custom_pagination($numpages = '', $pagerange = '', $paged='')  {

      if (empty($pagerange)) {
        $pagerange = 2;
      }

      /**
       * This first part of our function is a fallback
       * for custom pagination inside a regular loop that
       * uses the global $paged and global $wp_query variables.
       * 
       * It's good because we can now override default pagination
       * in our theme, and use this function in default queries
       * and custom queries.
       */

      if ($paged == '') {
          global $paged;
          if (empty($paged)) {
            $paged = 1;
          }
      }
      if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if(!$numpages) {
            $numpages = 1;
        }
      }

      /** 
       * We construct the pagination arguments to enter into our paginate_links
       * function. 
       */

      $pagination_args = array(
        'base'            => get_pagenum_link(1) . '%_%',
        'format'          => 'page/%#%',
        'total'           => $numpages,
        'current'         => $paged,
        'show_all'        => false,
        'end_size'        => 1,
        'mid_size'        => $pagerange,
        'prev_next'       => true,
        'prev_text'       => __('&#9668;'),
        'next_text'       => __('&#9658;'),
        'type'            => 'plain',
        'add_args'        => true,
        'add_fragment'    => '',
        'after_page_number' => '',
        'before_page_number' =>'',
        );
     $paginate_links = paginate_links($pagination_args);

      if ( $paginate_links ) {
        echo "<nav class='custom-pagination'>";
          //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
          echo $paginate_links;
        echo "</nav>";
      }
    }
    
    add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 18;
  return $cols;
}

 // step 1 add a location rule type
  add_filter('acf/location/rule_types', 'acf_wc_product_type_rule_type');
  function acf_wc_product_type_rule_type($choices) {
    // first add the "Product" Category if it does not exist
    // this will be a place to put all custom rules assocaited with woocommerce
    // the reason for checking to see if it exists or not first
    // is just in case another custom rule is added
    if (!isset($choices['Product'])) {
      $choices['Product'] = array();
    }
    // now add the 'Category' rule to it
    if (!isset($choices['Product']['product_cat'])) {
      // product_cat is the taxonomy name for woocommerce products
      $choices['Product']['product_cat_term'] = 'Product Category Term';
    }
    return $choices;
  }
  
  // step 2 skip custom rule operators, not needed
  
  
  // step 3 add custom rule values
  add_filter('acf/location/rule_values/product_cat_term', 'acf_wc_product_type_rule_values');
  function acf_wc_product_type_rule_values($choices) {
    // basically we need to get an list of all product categories
    // and put the into an array for choices
    $args = array(
      'taxonomy' => 'product_cat',
      'hide_empty' => false
    );
    $terms = get_terms($args);
    foreach ($terms as $term) {
      $choices[$term->term_id] = $term->name;
    }
    return $choices;
  }
  
  // step 4, rule match
  add_filter('acf/location/rule_match/product_cat_term', 'acf_wc_product_type_rule_match', 10, 3);
  function acf_wc_product_type_rule_match($match, $rule, $options) {
    if (!isset($_GET['tag_ID'])) {
      // tag id is not set
      return $match;
    }
    if ($rule['operator'] == '==') {
      $match = ($rule['value'] == $_GET['tag_ID']);
    } else {
      $match = !($rule['value'] == $_GET['tag_ID']);
    }
    return $match;
  }
  
// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '&rsaquo;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive">' . post_type_archive_title($prefix, false) . '</li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}



acf_add_options_page( array(

'page_title' 	=> 'Projecten instellingen',
'menu_title' 	=> 'Projecten instel.',
'menu_slug' 	=> 'Projecten_instellingen',
'capability' 	=> 'edit_posts', 
'icon_url' => 'dashicons-category',
'position' => 9

) );

acf_add_options_page( array(

'page_title' 	=> 'Gegevens',
'menu_title' 	=> 'Gegevens',
'menu_slug' 	=> 'gegevens',
'capability' 	=> 'edit_posts', 
'icon_url' => 'dashicons-admin-users',
'position' => 2

) );


function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 10 );

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Projecten';
    $submenu['edit.php'][5][0] = 'Projecten';
    $submenu['edit.php'][10][0] = 'Nieuw project';
    $submenu['edit.php'][16][0] = 'Project Tag';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Projecten';
    $labels->singular_name = 'Projecten';
    $labels->add_new = 'Nieuw project';
    $labels->add_new_item = 'Project toevoegen';
    $labels->edit_item = 'Bewerk project';
    $labels->new_item = 'Project';
    $labels->view_item = 'Bekijk project';
    $labels->search_items = 'Zoek een project';
    $labels->not_found = 'Project niet gevonden';
    $labels->not_found_in_trash = 'Geen project gevonden in prullemand';
    $labels->all_items = 'Alle projecten';
    $labels->menu_name = 'Projecten';
    $labels->name_admin_bar = 'Projecten';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

?>