<!-- this page was built off of the code we wrote on archive event -->
<?php
get_header();
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Programs</h1>
      <div class="page-banner__intro">
        <p>There is something for everyone, take a look around.</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">

    <!-- <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo site_url('/program'); ?>">
          <i class="fa fa-calendar" aria-hidden="true"></i> Programs Home</a>
          <span class="metabox__main"> <a href="<?php echo site_url('/past-events'); ?>">View Past Events Here</a></span>
      </p>
    </div> -->


    <ul class="link-list min-list">



  <?php
  // we use while post because we want to do something once for each
    while(have_posts()) {
      the_post(); ?>
      <li>
        <a href="<?php the_permalink(); ?>"><?php the_title();  ?>  </a>
      </li>



  <?php  }


  // blog pagination
  echo paginate_links();

   ?>
   </ul>
  </div>

<?php
get_footer();

 ?>
