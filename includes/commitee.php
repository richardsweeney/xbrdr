<div class="members-container">
  <h1><?php _e('Styrelse', 'xbrdr'); ?></h1>
  <div class="row-fluid">
  <?php
    $args = array('post_type' => 'commitee_member', 'posts_per_page' => -1);
    $query = new WP_Query($args);
    $i = 1;
    while($query->have_posts()): $query->the_post();
      $dob = get_post_meta($post->ID, '_commitee-dob', true);
      $role = get_post_meta($post->ID, '_commitee-role', true);
      $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
      ?>
      <?php if ($i == 4 || $i == 7 || $i == 10) echo '<div class="row-fluid">'; ?>
        <div class="span4 well boardmember">
          <?php if (has_post_thumbnail()): ?>
            <div class="thumbnail">
              <img src="<?php echo $image[0]; ?>" alt="<?php esc_attr(the_title()); ?>" />
            </div>
          <?php endif; ?>
          <?php the_title('<h3>','</h3>'); ?>
          <h5><?php _e('Född', 'xbrdr'); ?> <?php echo $dob; ?></h5>
          <h5><?php echo $role; ?></h5>
          <?php the_content(); ?>
        </div>
      <?php if (($i % 3) == 0) echo '</div> <!-- end row -->'; ?>
    <?php $i++; endwhile; ?>
  </div>
</div>
