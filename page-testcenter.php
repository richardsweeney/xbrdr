<?php get_header(); ?>

<?php
  while(have_posts()): the_post();
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
  ?>

<div class="container-fluid wider-page" id="page">
  <div class="row-fluid">
    <div class="span12 image-border-container">
      <img src="<?php echo $image[0]; ?>" alt="<?php esc_attr(the_title()); ?>" />
    </div>
  </div>
  <div class="row-fluid introtext">
    <div class="span12">
      <h1 class="down"><?php the_title(); ?></h1>
      <div class="lead">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
  <div class="row-fluid spaceme">

  <?php
    endwhile; wp_reset_query();
    $args = array('post_type' => 'test', 'posts_per_page' => '-1');
    $query = new WP_Query($args);
    while ($query->have_posts()): $query->the_post();
      $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
      $excerpt = get_post_meta($post->ID, '_test-excerpt', true);
    ?>
      <div class="span6 testbox">
        <div class="image-border-container">
          <a href="<?php the_permalink(); ?>">
            <img class="image-border" src="<?php echo $image[0]; ?>" alt="<?php esc_attr(the_title()); ?>" />
          </a>
        </div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo $excerpt; ?></p>
      </div>

  <?php endwhile; ?>

  </div>

<?php get_footer(); ?>
