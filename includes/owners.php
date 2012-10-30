<div class="members-container">
  <h1 class="down"><?php the_title(); ?></h1>
  <div class="row-fluid">
  <?php
    $args = array('post_type' => 'owner', 'posts_per_page' => -1);
    $query = new WP_Query($args);
    $i = 1;
    while($query->have_posts()): $query->the_post();
      $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
      ?>
      <?php if (($i % 4) == 0) echo '<div class="row-fluid">'; ?>
        <div class="span4 well boardmember">
          <div class="thumbnail">
            <img src="<?php echo $image[0]; ?>" alt="<?php esc_attr(the_title()); ?>" />
          </div>
          <?php the_title('<h3>','</h3>'); ?>
          <?php the_content(); ?>
        </div>
      <?php if (($i % 4) == 0) echo '</div>'; ?>
    <?php $i++; endwhile; ?>
  </div>
</div>
