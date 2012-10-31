<?php get_header(); ?>

<div class="container-fluid wider-page contact-page" id="page">
  <div class="span12 contact-container">

  <?php while(have_posts()): the_post(); ?>
  <?php
    $tel = get_post_meta($post->ID, '_contact-tel', true);
    $email = get_post_meta($post->ID, '_contact-email', true);
  ?>

    <h1 class="down"><?php the_title(); ?></h1>
    <div class="row-fluid larger-text">

      <div class="span3">
        <?php the_content(); ?>
      </div>

      <div class="span3">
        <h3>&nbsp;</h3>
        <p><?php echo $tel; ?><br>
          <a title="Kontakta CrossBorder" href="mailto:<?php echo esc_attr($email); ?>"><?php echo $email; ?></a>
        </p>
      </div>

      <div class="span6">
        <div class="iframe-container image-border-container">
          <img src="<?php echo IMG; ?>/karta.png" alt="map" />
<!--           <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Sj%C3%B6viksv%C3%A4gen+2+231+62+Trelleborg&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=48.50801,57.919922&amp;ie=UTF8&amp;hq=&amp;hnear=Sj%C3%B6viksv%C3%A4gen+2,+231+62+Trelleborg,+Sweden&amp;ll=55.379552,13.123617&amp;spn=0.008558,0.02105&amp;t=m&amp;z=14&amp;output=embed"></iframe> -->
        </div>
      </div>

    </div>
  <?php endwhile; wp_reset_query(); ?>
  </div>
  <div class="row-fluid introtabs contact-details contact-container">
    <?php rps_get_contact_people(); ?>
  </div>

<?php get_footer(); ?>

