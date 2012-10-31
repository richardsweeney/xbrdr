<?php get_header(); ?>

<div class="container-fluid wider-page" id="page">
  <?php rps_print_secondary_navigation(); ?>
  <p class="breadcrumb-navigation">
    <a href="<?php echo URL; ?>">xbrdr.com</a>
    <img src="<?php echo IMG; ?>/breadcrumbs.jpg" />
    <a href="<?php echo URL; ?>/om-oss/detta-ar-crossborder/">Om Oss</a>
    <img src="<?php echo IMG; ?>/breadcrumbs.jpg" />
    <a href="<?php echo URL; ?>/om-oss/press/">Press</a>
    <img src="<?php echo IMG; ?>/breadcrumbs.jpg" />
    <a class="active" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </p>
  <div class="tab-pane active" id="press">
    <div class="row-fluid">
      <div class="span12">
        <h1>Press</h1>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span3 well">
        <?php dynamic_sidebar('rps-press-widget'); ?>
      </div>

      <div class="span9" id="news-column">
      <?php while (have_posts()): the_post(); ?>
        <article class="single-news-item">
          <h1><?php the_title(); ?></h1>
          <strong><?php the_time('j F, Y'); ?></strong>
          <?php the_content(); ?>
        </article>
      <?php endwhile; wp_reset_query(); ?>
      </div>
      <?php get_footer(); ?>
