<?php get_header(); ?>
<?php $pt = $post->post_title; ?>

<div class="container-fluid wider-page" id="page">
  <nav>
    <div id="nav-sidebar" class="row-fluid">
      <div class="span12">
        <div class="row-fluid introtabs">
          <div class="span3">
            <h1><?php _e('Produkter', 'xbrdr'); ?></h1>
          </div>
          <div class="span6 offset3">
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!--sidhuvud-->
  <div class="row-fluid product-row introtabs">
    <div class="span12 tab-previews">

    <?php
      $args = array('post_type' => 'product', 'posts_per_page' => 3);
      $query = new WP_Query($args);
      while ($query->have_posts()): $query->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
        $excerpt = get_post_meta($post->ID, '_produkt-excerpt', true);
        $class = (get_the_title() == $pt) ? 'span4 active' : 'span4';
      ?>

      <div class="<?php echo $class; ?>">
        <div class="box-shadow">
          <img src="<?php the_field('field_name'); ?>" alt="" />
          <!-- ok; What. The. FUCK?! Inline style element?!! This is to get the images to vertically align (sorry, sorry, sorry). -->
          <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>" style="background: url('<?php the_field('extra_bild'); ?>') no-repeat center center">
          </a>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
          <?php the_title('<h3>','</h3>'); ?>
        </a>
        <p><?php echo $excerpt; ?></p>
      </div>

      <?php
        endwhile; wp_reset_query();
        //Main loop
        while(have_posts()): the_post();
      ?>

    </div>
  </div>

  <!-- Tabs -->
  <div class="row-fluid introtabs producttabs">
    <div class="span12">
      <ul class="nav nav-tabs product-tab">
        <?php if($post->post_title == 'XP1'): ?>
          <li class="js">
            <a href="#spec" title="" data-id="spec" data-toggle="tab">Specifikation</a>
          </li>
          <li class="js active">
            <a href="#fordelar" title="" data-id="fordelar" data-toggle="tab">Fördelar</a>
          </li>
        <?php else: ?>
          <li class="active padd-right">
            <a href="#fordelar" title="" data-toggle="tab">Fördelar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <!-- tabs -->

  <div class="tab-content no-float show-hide-container">
  <!-- fordelar tab -->
    <section id="fordelar">
      <div class="row-fluid tab-previews product-row">
        <div class="span12">
          <br>
          <div class="thumbnail">
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            <img class="post-thumbnail" src="<?php echo $image[0]; ?>" alt="<?php esc_attr(the_title()); ?>">
          </div>
          <?php $subheader = get_post_meta($post->ID, '_produkt-subheader', true); ?>
          <h2><?php echo $subheader; ?></h2>
          <div class="lead margin-l-r content-container">
            <?php the_content(); ?>
          </div>
        </div>
      </div>

      <?php rps_get_product_information(); ?>

    </div>

    <?php endwhile; ?>

<?php get_footer(); ?>
