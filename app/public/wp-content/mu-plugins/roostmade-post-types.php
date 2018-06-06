<?php
// below is how we created a new post type, events
// we created this folder, mu-plugins, which means MUST USE plugins
// below is where we created our own custom post types for our website,
// and we want the user of our theme to be able to always access their content even if they change themes,
// creating this folder will help that process, so they aren't locked out of their own content.
function mus_roostmade_post_types() {

  // event post type

  register_post_type('event', array(
    'has_archive' => true,
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'events'),
    'public' => true,
    'menu_icon' => 'dashicons-calendar',
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit This Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event',
       )
    )
);

// program post type

register_post_type('program', array(
  'has_archive' => true,
  'supports' => array('title', 'editor'),
  'rewrite' => array('slug' => 'programs'),
  'public' => true,
  'menu_icon' => 'dashicons-awards',
  'labels' => array(
    'name' => 'Programs',
    'add_new_item' => 'Add New Program',
    'edit_item' => 'Edit Programs',
    'all_items' => 'All Programs',
    'singular_name' => 'Program',
     )
  )
);
// MAKE SURE TO GO TO ADMIN SETTINGS UNDER PERMALINKS - AND CLICK SAVE CHANGES TO UPDATE THE SETTINGS FOR THESE NEW POST TYPES


}
add_action('init', 'mus_roostmade_post_types');
// read more about post types etc.
// https://codex.wordpress.org/Function_Reference/register_post_type
?>
