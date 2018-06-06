<!-- this is our behind the scenes file, this is where we can have a conversation with the WP system itself -->

<!-- all custom post types are managed in the mu-plugins folder under roostmade-post-types -->
<?php

function mus_roost_files() {
    // this is the function we made up from the add_action we created below, to run this function
    // that will find the file(s) we wanted wp to find
    // wp_enqueue_style('mus_roost_main_styles', get_stylesheet_uri());
    // write it like this above, to enable browser caching
    wp_enqueue_style('mus_roost_main_styles', get_stylesheet_uri(), NULL, microtime());
    // write it like this, to disable browser caching for only this file (better for development mode)
    // wp_enqueue_style is a WP function that points to the CSS file we want to load,
    // if it was a javascript file we wanted to load, we would have written "wp_enqueue_script"
    // mus_roost_main_styles is the nickname for our style sheet we made up
    // get_stylesheet_uri is a wp function we're calling that points to the style.css file
    wp_enqueue_style('mus_font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('mus_google_fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i
');
    wp_enqueue_script('mus_main_roostmade_js',get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
    // loading a js file requires more arguments then a css file
    // the third argument here address if the js file has any dependencies, it doesnt, so we wrote NULL
    // then wordpress wants a version number for our file, we made one up here "1.0"
    // we would write "1.0" or "2.0" here if this was a live website, to speed thigns up for our users
    // but for the development process...
    // to prevent browser caching as we continue to make little changes all the time, we added the wordpress function of microtime,
    // this attaches the time to the version number,
    // so that its different every time, which means it will force the broswer to reload the js file on each refresh,
    // which is beneficial to us in the development process as we change things so regularly
    // last argument is WP asking, do you want to load this file right before the closing body tag? true or false,
    // we say true, so it loads at the bottom of the page instead of the top, which is better
}

  add_action('wp_enqueue_scripts', 'mus_roost_files');
    // add_action is a wp function where we can tell WP what to do, and it wants us to give it two arguments,
    // we want to load a file, so we write "wp_enqueue_scripts" as the first argument
    // then the second argument is the file, but we're making it a function, to find the file
    // we didnt add parenthesis after our second argument 'mus_roost_files'
    // because we want wordpress to decide when to run it, at precisely the right moment

function mus_roostmade_features() {
  register_nav_menu('mus_headerMenuLocation', 'MUS Header Menu Location');
  register_nav_menu('mus_footerLocationOne', 'MUS Footer Location One');
  register_nav_menu('mus_footerLocationTwo', 'MUS Footer Location Two');


  add_theme_support('title-tag');
    // this is a wp function when you want to enable a feature for your theme
    // this is where we added the page title on the browser tabs
    }
  add_action('after_setup_theme', 'mus_roostmade_features');


  function mus_roostmade_adjust_queries($query) {
    // when wordpress calls our function, it passes along the wordpress query
    // object we can manipulate the object within the body of our functions

    // we are going to wrap it in an if statement so it only applies to the programs custom post types
    // without the if statement, it would apply to every query on our site
    // the condition makes it only apply to the program archive screen
    if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
      // this if statement is to display the entire list of programs on the program archive page,
      // which will override the default of 10 per page, and we want the list alphabetical order
      $query->set('orderby', 'title');
      // this makes the posts ordered by the contents of the title
      $query->set('order', 'ASC');
      // this sets the order of the titles to be alphabetical
      $query->set('posts_per_page', -1);
      // shows all programs, overriding the default of 10 per page

    }


    // we are going to wrap it in an if statement so it only applies to the events custom post types
    // without the if statement, it would apply to every query on our site
    // the condition makes it only apply to the event archive screen
    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {

      // the function only returns true, if we're on the front end of the site, if we're NOT looking at the admin dashboard
      // it's NOT
      // beceause we added an exclamation point first before it
      // and if its the event archive
      // the past part, is... the function will only evaluate to TRUE if the query in question is the default URL based query
      // this way we never maniupulate a custom query
      $mus_today = date('Ymd');

      $query->set('meta_key', 'event_date');
      // above we're setting parameters
      // we're looking in the wordpress query object, calling its method of set
      // then the first arumment is the query parameter that we want to target
      $query->set('orderby', 'meta_value_num');
      $query->set('order', 'ASC');
      $query->set('meta_query', array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $mus_today,
          'type'  => 'numbers'
        )
      ));


    }
  }
  add_action('pre_get_posts', 'mus_roostmade_adjust_queries');
  // before wordpress sends its query off to the database, it gives our function the last word,
  // and adjust the query "pre get posts" right before it pulls the posts
