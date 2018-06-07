

<?php
// we named this file "page-past-events.php" to link to http://fictional-roostmade.local/past-events/ on its own
// this means that this new template file is now controlling this URL
// we built this page based off of the content from archive-event.php
get_header();
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Past Events</h1>
      <div class="page-banner__intro">
        <p>A recap of our past events</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo site_url('/events'); ?>">
          <i class="fa fa-calendar" aria-hidden="true"></i> Events Home</a>
          <!-- <span class="metabox__main">
            Posted By <?php the_author_posts_link(); ?> on <?php the_time('M j, Y'); ?> in <?php echo get_the_category_list(', ');?>
          </span> -->
      </p>
    </div>


  <?php
  // we need to look for events in the past.
  // we're borrowing code we wrote from front-page.php below, and changing it to fit this need,


  $mus_today = date('Ymd');
  // this WP Query we're going to tell wordpress which data we want to query from the database
  // then we will have this variable or object $mus_pasteEvents that will contain everything we need
  // then we can loop through the object to display the content on the front end
  $mus_pastEvents = new WP_Query(array(
    'paged' => get_query_var('paged',1),
    // paged tells the custom query which page number of results it should be on
    // get_query_var is designed to get information about the current url
    // we are interested in the number at the end of the URL
    // (where it says the page number, because before it was not linking the results of the pagination to the previous content)
    // we added a second argument called 1, so that if we're on the first result (which doesnt have a page number in the URL)
    // this 1 argument, is the page number to use, for a default, just in case wordpress can't find the page dynamically
    'posts_per_page' => 4,
    // if we set this to negative 1, it returns all at once - WP default is 10
    'post_type' => 'event',
     // the default of order by is to sory by 'post_date', 'rand' is random.
    'orderby' => 'meta_value_num',
    // meta value is how we tell WP howe we sort by meta key
    'meta_key' => 'event_date',
    'order' => 'DSC',
    // order the thing we decided, most recent first.

    // a meta query is here so we can have fine grain controls over searching for particular values
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '<',
        'value' => $mus_today,
        'type'  => 'numeric'
        // only show us posts, if the key is compared to the value is true
        // which means, if the event date, is greater than or equal to todays date
        // we created $mus_today here, and added it at the top so we can call on it when we need and its easier to understand
      )
    )
    // this meta query above here is how we filter out old events, we can filter out anything.
    // we're nesting one array in another array, to do this
    // only return posts it the event date is greater than or equal to todays date

  ));




  // we use while post because we want to do something once for each
  // and we are also going to set our while loop to look within our new variable
    while($mus_pastEvents->have_posts()) {
    $mus_pastEvents->the_post(); ?>
    <!-- (look inside past events, then call'the_post') -->
      <div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month"><?php
            $eventDate = new DateTime(get_field('event_date'));
            // this line of code creates an object that is a representation of the current date
            // we provided an argument of a date in the future, the date of our event
            // this is how we store the date of our event in this function so we can call it anytime
            echo $eventDate->format('M')
            // here we are echoing out the date of our event, just the month, calling the function we just made

          ?></span>
          <span class="event-summary__day">'<?php echo $eventDate->format('y') ?></span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
          <p><?php echo wp_trim_words(get_the_content(), 30);?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
        </div>
      </div>

  <?php  }
  // blog pagination

  // because we're on the /past-events-page URL, and we're relyong on our own custom query,
  // not the default WP query like on the regular events page
  // we will have to jump through a few hoops to get pagination working

  // we are going to add information within the parenthesis of the "paginate_links();" below
  // to giev this function information about our custom query, so we give it an array
  // we are goign to tell it how many pages of results there are going to be
  // so if we had 30 past events, and we displayed 10 per page, we'd have 3 pages of past events
  echo paginate_links(array(
    'total' => $mus_pastEvents->max_num_pages
    // we are looking within the past events object we created earlier, for a property called max number of pages
    // we need our query to pay attention to paged results yet
    // to fix this we added a new parameter in the $mus_pastEvents section up top called 'paged'
  ));

   ?>
  </div>

<?php
get_footer();

 ?>
