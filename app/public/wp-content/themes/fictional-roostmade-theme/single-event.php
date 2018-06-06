<!-- wordpress will look for the name of my post type, with a "single-" in
front of it, to look for to use as formatting for a new post tyoe -->
<?php
get_header();// gets the contents of header.php



// how many times do we want to repeat this while loop? - as long as we have posts.
  while(have_posts()) {
    the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
        <div class="page-banner__content container container--narrow">
          <h1 class="page-banner__title"><?php the_title(); ?>
          </h1>
          <div class="page-banner__intro">
            <p>DON'T FORGET TO REPLACE THIS TEXTx LATER</p>
          </div>
        </div>
      </div>

      <div class="container container--narrow page-section">


      <div class="generic-content">


        <?php the_meta(); ?>


        <?php





        $mus_find_event_date = new DateTime(get_field('event_date'));
        // this line of code creates an object that is a representation of the event date
        // we provided an argument of the date of our event
        // this is how we store the date of our event in this function so we can call it anytime
        $mus_thisEventDate = $mus_find_event_date->format('l, F jS, Y')
        // we then created a variable to store the event date within, but with the formatting we wanted
        // so to plug in our event date written out
        ?>

        <div class="metabox metabox--position-up metabox--with-home-link">

          <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
            <i class="fa fa-calendar" aria-hidden="true"></i> Events Home</a>
            <span class="metabox__main"><?php echo $mus_thisEventDate ?></span>
          </p>

        </div>
        <?php the_content(); ?>

      </div>


      </div>

<?php  }
get_footer();// gets the contents of footer.php

 ?>
