<?php get_header(); ?>

  <div class="container chapters-container" id="page">

    <span class="scroll-arrow" title="Skrolla f&ouml;r att forts&auml;tta">Skrolla f&ouml;r att forts&auml;tta</span>

    <!--    Chapter 1    -->

    <?php
      $args = array('post_type' => 'front_push', 'posts_per_page' => 1);
      $query = new WP_Query($args);
      $pushes = array();
      while ($query->have_posts()): $query->the_post();
        $pushes = get_field('push_repeater');
      endwhile;
    ?>

    <section id="chapter1-block" class="chapter">
      <span id="chapter1" class="pointer"></span>

      <ul class="sequence-block" id="unbuild">
        <li class="first"><img class="sequence-img" id="img-0" src="<?php echo IMG; ?>/sequence/01.jpg" /></li>
      </ul>

      <article class="gom text-content section-text" id="chapter1-text">
        <h1 class="heading-1"><?php echo $pushes[0]['titel']; ?></h1>
        <?php echo $pushes[0]['text']; ?>
      </article>

    </section>


    <!--    Chapter 2    -->

    <section id="chapter2-block" class="chapter">
      <span id="chapter2" class="pointer"></span>

      <div class="image-container">

        <img id="chapter-2-special-img" src="<?php echo IMG; ?>/pallar/pall.jpg" />

        <div class="chapter2-icons-container">

          <ul class="chapter2-icons icons gom group-1">
              <li class="i-1 unique"><a href="<?php echo URL; ?>/produkter/xp1/#one"><span>Slitstark</span></a></li>
              <li class="i-2 unique"><a href="<?php echo URL; ?>/produkter/xp1/#two"><span>L&auml;tt</span></a></li>
              <li class="i-3 unique"><a href="<?php echo URL; ?>/produkter/xp1/#three"><span>Anpassningsbar</span></a></li>
              <li class="i-4 unique"><a href="<?php echo URL; ?>/produkter/xp1/#sixteen"><span>Brands&auml;ker</span></a></li>
          </ul>
          <ul class="chapter2-icons icons gom group-2">
              <li class="i-5 unique"><a href="<?php echo URL; ?>/produkter/xp1/#four"><span>V&auml;derbest&auml;ndig</span></a></li>
              <li class="i-6 unique"><a href="<?php echo URL; ?>/produkter/xp1/#five"><span>Temperatur-<br />oberoende</span></a></li>
              <li class="i-7 unique"><a href="<?php echo URL; ?>/produkter/xp1/#eleven"><span>Resistent mot olja<br />och kemikalier</span></a></li>
          </ul>
          <ul class="chapter2-icons icons gom group-3">
              <li class="i-8 unique"><a href="<?php echo URL; ?>/produkter/xp1/#six"><span>Ergonomisk</span></a></li>
              <li class="i-9 unique"><a href="<?php echo URL; ?>/produkter/xp1/#eight"><span>Insektsfri</span></a></li>
          </ul>
          <ul class="chapter2-icons icons gom group-4">
              <li class="i-10 unique"><a href="<?php echo URL; ?>/produkter/xp1/#nine"><span>Hygienisk</span></a></li>
              <li class="i-11 unique"><a href="<?php echo URL; ?>/produkter/xp1/#ten"><span>Absorberar inte<br />olja och kemikalier</span></a></li>
              <li class="i-12 unique"><a href="<?php echo URL; ?>/produkter/xp1/#twelve"><span>100 %<br />&aring;tervinningsbar</span></a></li>
          </ul>

        </div>

      </div>

      <article class="gom text-content section-text" id="chapter2-text">
        <h2 class="heading-2"><?php echo $pushes[1]['titel']; ?></h2>
        <?php echo $pushes[1]['text']; ?>
      </article>

    </section>



    <!--    Chapter 3    -->

    <section id="chapter3-block" class="chapter right-content">
      <span id="chapter3" class="pointer"></span>

      <div class="image-container">

        <img id="chapter3-image" class="gom image-with-pointers" src="<?php echo IMG; ?>/pallar/ekonomi.jpg" />

        <div class="chapter3-icons-container">

          <ul class="chapter3-icons icons gom group-1">
            <li class="i-13 unique"><a href="<?php echo URL; ?>/produkter/xp1/#thirteen"><span>L&aring;g<br />livscykelkostnad</span></a></li>
            <li class="i-14 unique"><a href="<?php echo URL; ?>/produkter/xp1/#fourteen"><span>Utbytbara detaljer</span></a></li>
          </ul>
          <ul class="chapter3-icons icons gom group-2">
            <li class="i-15"><a href="<?php echo URL; ?>/produkter/xp1/#one"><span>Slitstark</span></a></li>
            <li class="i-16 unique"><a href="<?php echo URL; ?>/produkter/xp1/#fifteen"><span>Oberoende av<br />m&aring;ttstandard</span></a></li>
          </ul>
          <ul class="chapter3-icons icons gom group-3">
            <li class="i-17 unique"><a href="<?php echo URL; ?>/produkter/xp1/#sixteen"><span>Brands&auml;ker</span></a></li>
            <li class="i-18"><a href="<?php echo URL; ?>/produkter/xp1/#twelve"><span>100 %<br />&aring;tervinningsbar</span></a></li>
          </ul>
          <ul class="chapter3-icons icons gom group-4">
            <li class="i-19"><a href="<?php echo URL; ?>/produkter/xp1/#six"><span>Ergonomisk</span></a></li>
          </ul>

        </div>

      </div>

      <article class="gom text-content right-aligned-text section-text" id="chapter3-text">
        <h2 class="heading-2"><?php echo $pushes[2]['titel']; ?></h2>
        <?php echo $pushes[2]['text']; ?>
      </article>

    </section>



    <!--    Chapter 4    -->

    <section id="chapter4-block" class="chapter right-content">
      <span id="chapter4" class="pointer"></span>

      <div class="image-container">

        <img id="chapter4-image" class="gom image-with-pointers" src="<?php echo IMG; ?>/pallar/arbetsmiljo.jpg" />

        <div class="chapter4-icons-container">

          <ul class="chapter4-icons icons gom group-1">
            <li class="i-21 unique"><a href="<?php echo URL; ?>/produkter/xp1/#seventeen"><span>Greppvänlig</span></a></li>
          </ul>
          <ul class="chapter4-icons icons gom group-2">
            <li class="i-22 unique"><a href="<?php echo URL; ?>/produkter/xp1/#eighteen"><span>Dammar ej</span></a></li>
          </ul>
          <ul class="chapter4-icons icons gom group-3">
            <li class="i-20 unique"><a href="<?php echo URL; ?>/produkter/xp1/#two"><span>L&auml;tt</span></a></li>
            <li class="i-23 unique"><a href="<?php echo URL; ?>/produkter/xp1/#nineteen"><span>Stick- och<br />flisfri</span></a></li>
            <li class="i-24 unique"><a href="<?php echo URL; ?>/produkter/xp1/#twenty"><span>Ingen risk för<br />utstickande spikar</span></a></li>
          </ul>

        </div>
      </div>

      <article class="gom text-content right-aligned-text section-text" id="chapter4-text">
        <h2 class="heading-2"><?php echo $pushes[3]['titel']; ?></h2>
        <?php echo $pushes[3]['text']; ?>
      </article>

    </section>



    <!--    Chapter 5    -->

    <section id="chapter5-block" class="chapter right-content">
      <span id="chapter5" class="pointer"></span>

      <div class="image-container">

        <img id="chapter5-image" class="gom image-with-pointers" src="<?php echo IMG; ?>/pallar/miljo.jpg" />

        <div class="chapter5-icons-container">

          <ul class="chapter5-icons icons gom group-1">
            <li class="i-25 unique"><a href="<?php echo URL; ?>/produkter/xp1/#twentyone"><span>H&aring;llbar</span></a></li>
            <li class="i-27"><a href="<?php echo URL; ?>/produkter/xp1/#twelve"><span>100 %<br />&aring;tervinningsbar</span></a></li>
            <li  class="i-28 unique"><a href="<?php echo URL; ?>/produkter/xp1/#twentythree"><span>Rent, v&auml;rdefullt<br />stålskrot</span></a></li>
          </ul>
          <ul class="chapter5-icons icons gom group-2">
            <li class="i-26 unique"><a href="<?php echo URL; ?>/produkter/xp1/#twentytwo"><span>Motst&aring;ndskraftig</span></a></li>
          </ul>

        </div>

      </div>

      <article class="gom text-content right-aligned-text section-text" id="chapter5-text">
        <h2 class="heading-2"><?php echo $pushes[4]['titel']; ?></h2>
        <?php echo $pushes[4]['text']; ?>
      </article>

    </section>



    <!--    Chapter 6     -->

    <section id="chapter6-block" class="chapter">
      <span id="chapter6" class="pointer"></span>

      <article class="gom text-content section-text" id="chapter6-text">
        <h2 class="heading-2"><?php echo $pushes[5]['titel']; ?></h2>
        <?php echo $pushes[5]['text']; ?>
      </article>

      <div class="laning-page map-block" id="chapter6-map">
        <img src="<?php echo IMG; ?>/karta.png" alt="map" />
          <!-- The map is loaded via AJAX when the user scrolls here -->
      </div>

    </section>

    <?php get_footer(); ?>
