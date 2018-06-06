<?php get_header();// gets the contents of header.php ?>


<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Welcome!</h1>
      <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
      <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
      <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
  </div>

  <div class="full-width-split group">
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

        <?php

        // below we are using wordpress queries to find the upcoming events....
        // ....THEN in the while loop below it, we output the contents of this query
        $mus_today = date('Ymd');

        // this WP Query we're going to tell wordpress which data we want to query from the database
        // then we will have this variable or object $mus_homepageEvents that will contain everything we need
        // then we can loop through the object to display the content on the front end
        $mus_homepageEvents = new WP_Query(array(
          'posts_per_page' => 2,
          // if we set this to negative 1, it returns all at once
          'post_type' => 'event',
           // the default of order by is to sory by 'post_date', 'rand' is random.
          'orderby' => 'meta_value_num',
          // meta value is how we tell WP howe we sort by meta key
          'meta_key' => 'event_date',
          'order' => 'ASC',
          // order the thing we decided, by ascending

          // a meta query is here so we can have fine grain controls over searching for particular values
          'meta_query' => array(
            array(
              'key' => 'event_date',
              // the key is the custom field we're looking in
              'compare' => '>=',
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
        // the while loop will keep repeating as long as   $mus_homepageevents still has posts
        // which means it will always be pulling the events to display dynamically as they are posted
        while($mus_homepageEvents->have_posts()) {
          // run function the post, this gets the data ready for each post, each time the loop repeats itself
          // only we don't want to call the global version of the_post, we want to begin to look within the objects
          // thats why we put   $mus_homepageevents first
          $mus_homepageEvents->the_post(); ?>

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
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                  } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
            </div>
          </div>

          <?php }

         ?>



        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>

      </div>
    </div>

    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

        <?php
        // we are creating a new custom query,
        $mus_homepagePosts = new WP_Query( array(

        // first by creating a new variable or OBJECT called $mus_homepagePosts
        // our new variable equals a NEW instance, of the wordpress query class
        // this is object oriented programming
        // we don't have to know or care how WP_Query works
        // because the creators of WP maintain that class and they will to the heavy lifting for us
        // we are going to supply this query, with an associative array of arguments
        // so the class knows what to look for
        'posts_per_page' => 2,
        // wordpress by default pulls the 10 most recent posts, we're telling it to pull 2
        // this is just one of many parameters we could use
        // 'category_name' => 'awards'
        // this means only give us the category names of posts under the category of awards
        // 'post_type' => 'page'
        // this will give us all the pages we've created
      ));


        // example of object oriented programming
        // $mus_dog = new Animal();
        // dog variable equals a new instance of a class named Animal
        // $mus_cat = new Animal();
        // class is a blueprint we can use again ang again to create different objects
        // above, dog and cat are objects, and animal is the class (or blueprint)
        // instead of creating a dog from scratch, and a cat from scratch, we're creating them from a handy blueprint
        // because while dogs and cats are different, they also have a lot in common
        // the class of animal, will give these objects access to useful functions
        // $mus_dog->musDrinkWater();
        // here we are taking our dog object, and looking inside of it, and calling a function drink water
        // and now we can store the drinkwater function, and leverage it

        // this while loop will give us the two most recent blog posts
        while($mus_homepagePosts->have_posts()) {
          // if we left this as defailt -  while(have_posts())
          // this is tied to the default query of the url
          // instead of using these functions, we want to use querys that use our custom query object
          // $mus_homepagePosts->have_posts   -   we're telling this while loop to
          // as long as when we look inside our homepageposts object, for a function called have_posts

          $mus_homepagePosts->the_post(); ?>
          <!-- we are making the while loop code, reference our custom query. -->


          <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink();?>">
              <span class="event-summary__month"><?php the_time('M');?></span>
              <span class="event-summary__day"><?php the_time('d');?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
              <!-- this function below decides what to show under the title of the articles on the front page,
              if the article has an "excerpt" then it will show that only, otherwise it will just show the first 18 words of the post -->
              <p><?php if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 18);
              } ?><a href="<?php the_permalink();?>" class="nu gray">Read more</a></p>
            </div>
          </div>
          <?php
        }
        wp_reset_postdata();
        // whenever we use a custom query, we should get in the habit of ending it, with wp_reset_postdate();
        // this is how we clean up and reset wordpress data and global variables back to the state
        // that it was in when it made its default auto query based on the URL before we came along and a custom query
        // calling this function isn't always necessary, especially when you're at the bottom of a template file,
        // but its good practice
         ?>




        <p class="t-center no-margin"><a href="<?php echo site_url('/blog');?>" class="btn btn--yellow">View All Blog Posts</a></p>
      </div>
    </div>
  </div>

  <div class="hero-slider">
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Transportation</h2>
        <p class="t-center">All students have free unlimited bus fare.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
        <p class="t-center">Our dentistry program recommends eating apples.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image:  url(<?php echo get_theme_file_uri('images/bread.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Free Food</h2>
        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
      </div>
    </div>
  </div>
</div>




<?php get_footer();// gets the contents of footer.php

 ?>
