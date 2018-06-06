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
            <span class="metabox__main">Event Date: <?php echo $mus_thisEventDate ?></span>
          </p>

        </div>
        <?php the_content(); ?>

      </div>

      <?php
        // where we find the related programs

        $mus_relatedPrograms = get_field('related_programs');

        if($mus_relatedPrograms) {
            // we can leave this if blank, because if the page doesnt have a related program, then it will evaluate to false, and won't show it

            echo '<hr class="section-break" />';
            echo '<h2 class="headline headline--medium">Related Programs</h2>';
            echo '<ul class="link-list min-list">';

            foreach($mus_relatedPrograms as $mus_program) {
              // echo get_the_title($mus_program);
              // we write echo because functions that begin with get don't output on their own
              // each item that lives in our array is a wordpress post object
              // we write $mus_program because thats the keyword we chose to represent each item that lives in the array
              ?>

              <li>
                <a href="<?php echo get_the_permalink($mus_program); ?>"><?php echo get_the_title($mus_program);?></a>
              </li>

            <?php  }
            echo '</ul>';

        }
       ?>

      </div>

<?php  }
get_footer();// gets the contents of footer.php

 ?>
