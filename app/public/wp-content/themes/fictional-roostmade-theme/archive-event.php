<?php
get_header();
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Upcoming Events</h1>
      <div class="page-banner__intro">
        <p>View our Events</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">
  <?php
  // we use while post because we want to do something once for each
    while(have_posts()) {
      the_post(); ?>
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
          <span class="event-summary__day"><?php echo $eventDate->format('d') ?></span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
          <p><?php echo wp_trim_words(get_the_content(), 30);?><a href="<?php the_permalink();?>" class="nu gray">Learn more</a></p>
        </div>
      </div>

  <?php  }


  // blog pagination
  echo paginate_links();

   ?>
  </div>

<?php
get_footer();

 ?>
