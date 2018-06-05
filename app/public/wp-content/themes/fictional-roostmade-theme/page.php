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
            <p>DON'T FORGET TO REPLACE THIS TEXT LATER</p>
          </div>
        </div>
      </div>

      <div class="container container--narrow page-section">

        <!-- below: we want to know if the current page has a parent page, and to only display the code below to only show if its a child page -->
        <?php
        $mus_the_parent = wp_get_post_parent_id(get_the_ID());
        // we're making a variable here, and adding a function at the end,
        // so that we can call the result of this function easily and the number is stored within   $mus_the_parent
        // so what this is saying is like this... hey wordpress, get the ID of the current page we're viewing,
        // and then use that number to look up the number of its parent page
        // if the page IS a parent page, then it will display 0

        if ($mus_the_parent) {  ?>
          <!-- in an if statement like this, if the value in the parenthesis is a number other than 0,
          then it will always return it as true. if its 0, it will return as false -->
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
              <a class="metabox__blog-home-link" href="<?php echo get_permalink($mus_the_parent);?>">
                <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($mus_the_parent); ?></a>
                <span class="metabox__main"><?php the_title() ?></span>
            </p>
          </div>
          <?php
      }

         ?>

<?php
  $mus_testArray = get_pages( array(
    'child_of' => get_the_ID()
    // if the current page has children, then this function will return a collection of the children
    // if it doesnt have children, this function won't return anything (it will return False or NULL or zero)
    // and within an if statement, if it is zero, then it will evaluate as false
  ));

  // get_pages is similar to wp_list_pages, but doesn't output the name of the pages for you, it returns the pages in memory

  if($mus_the_parent or $mus_testArray ) {?>
      <!-- here we are trying to find out if the current page is a child or a parent page, or if its just a stand alone page. -->
      <!-- if the page is a standalone page, then it will not return the set of button links -->
      <!-- if it is a child or a parent page, then it will return the set of button links -->

        <div class="page-links">
          <h2 class="page-links__title"><a href="<?php echo get_permalink($mus_the_parent);?>"><?php echo get_the_title($mus_the_parent); ?></a></h2>
          <ul class="min-list">
            <?php

            // this means only if the current page has a parent, and is not 0, then perform the if function
            // so if $mus_the_parent is true, and it is not zero, then run the function of $mus_findChildrenOf = $mus_the_parent;
            // if its not true, then run the else function

            if($mus_the_parent) {
              $mus_findChildrenOf = $mus_the_parent;
            } else {
              $mus_findChildrenOf = get_the_ID();
            }

            // null means empty or nothing, as in, don't show the thing, cuz its nothing.
              wp_list_pages(array(
                // this function outputs the names of the pages for you
                'title_li' => NULL,
                'child_of' => $mus_findChildrenOf,
                'sort_column' => 'menu_order',
                // wordpress sorts the list of links automatically by alphabetical order, if we don't want that, and we want our own order
                // then we use "  'sort_column' => 'menu_order'," which sets the order of the links, based on the order number we assigned to each page
                // within the admin page

              ));
             ?>
          </ul>
        </div>

        <div class="generic-content">
          <p><?php the_content(); ?></p>
        </div>

      </div>
<?php } ?>


<?php  }
get_footer();// gets the contents of footer.php

 ?>
