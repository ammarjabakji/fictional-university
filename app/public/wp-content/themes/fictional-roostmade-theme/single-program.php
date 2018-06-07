
<?php
// we built this page off of the content from single-event.php
// wordpress will look for the name of my post type, with a "single-" in
// front of it, to look for to use as formatting for a new post tyoe

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
            <p>Math Program Sub Heading</p>
          </div>
        </div>
      </div>

      <div class="container container--narrow page-section">


      <div class="generic-content">
        <div class="metabox metabox--position-up metabox--with-home-link">

          <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
            <i class="fa fa-trophy" aria-hidden="true"></i> &nbsp;Back To All Programs</a>
            <span class="metabox__main"><?php the_title(); ?></span>
          </p>

        </div>
        <?php the_content(); ?>
      </div>



      <?php
      // this code below we have borrowed from front page, on front page it found and then output the upcoming events in general,
      // now we're using it to find and output the events only for the specific program we're looking at
      // We will use a meta query to add another filter to look for references to the current program post
      // below we have a meta query with an array, and an array inside of that
      // this array is like a filter, and we can go like inception and put filters on filters on filters yo
      // to find exactly what we want here, which is this
      // What is todays date? we store that in a variable
      // What type of event are we trying to determine exists?
          // - We want events
          // - events in the future
          // - we want to display only 2
          // - we only want events that are LIKE the program page we're looking at
          // - we want to sort them from soonest to furthest away
          // - we are going to store all of this in its own variable object we created
      // Then we call an IF statement, if these upcoming events exist, then...
      // show them, inside of our while loop, which has all the formatting, to repeat over and over for the upcoming events
      $mus_today = date('Ymd');

      $mus_programEvents = new WP_Query(array(
          'posts_per_page' => -1, // -1 returns all results, which we want. default is 10
          'post_type' => 'event', // the default of order by is to sory by 'post_date', 'rand' is random.
          'orderby' => 'meta_value_num',  // meta value is how we tell WP howe we sort by meta key
          'meta_key' => 'event_date',
          'order' => 'ASC', // order the thing we decided, by ascending
          'meta_query' => array(
                              array(
                                'key' => 'event_date',
                                // the key is the custom field we're looking in
                                'compare' => '>=',
                                'value' => $mus_today,
                                'type'  => 'numeric'
                                ),
                              array(
                                // this array is doing this:
                                // we have set this array to find out if the array
                                // of related programs is LIKE (which means contains)
                                // the ID number of the current program post
                                'key' => 'related_programs',
                                // the key is the custom field we're looking in
                                'compare' => 'LIKE',
                                // and since we only want events where the value of
                                // this custom field is like to the numerical ID of the current program post
                                'value' => '"' . get_the_ID() . '"'
                                // this is where we write the numerical ID of the current program post, for example if the ID of the
                                // X program is 88. but instead of hard coding 88 for each program we're going to make it
                                // dynamic for whatever program we're currently viewing but WP doesn't save a true array to a database value,
                                // instead, PHP serializes this array first, into a big messy string of text and then WP wraps each item
                                // in the string with quotes So instead of searching just for the ID, such as 88
                                // We instead want to search for "88" because "88" will be
                                // include the results we want. So we Concatenate (which means to link thigns together in a series or chain)
                                // the results of our get the id function, by adding:
                                //  a period before and after the function, and
                                //  a double quote wrapped in single quotes
                                // before, we get the id, and again after we get the id
                                )
                          )
      ));

      if($mus_programEvents->have_posts()) {
        // we wrapped this whole area in an IF statement, so that the program page
        // will only show "upcoming events" IF there actually is an upcoming event
        // when we say "->" this means "look inside"
        // so we're saying in this function above...

        // look in side of our object, $mus_programEvents, if the object has posts,
        // then the IF function will evaluate to true
        // when a functions parenthesis evaluates to true, then it will perform
        // whatever is in the curly brackets, which is all of the info about upcoming events


          echo '<hr class="section-break" />';


          ?><h2 class="headline headline--medium">Upcoming <?php echo get_the_title();?> Events</h2> <?php

          while($mus_programEvents->have_posts()) {
            $mus_programEvents->the_post(); ?>

            <div class="event-summary">
              <a class="event-summary__date t-center" href="#"><span class="event-summary__month"><?php
                  $eventDate = new DateTime(get_field('event_date'));
                  echo $eventDate->format('M') ?>
                </span>
                <span class="event-summary__day"><?php echo $eventDate->format('j') ?></span></a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php if (has_excerpt()) {
                    echo get_the_excerpt();
                  } else {
                    echo wp_trim_words(get_the_content(), 18);
                    } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>

            <?php }
      }

?>
      </div>

<?php  }
get_footer();// gets the contents of footer.php

 ?>
