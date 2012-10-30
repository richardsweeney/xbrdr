<?php get_header(); ?>

<div class="container-fluid wider-page" id="page">
  <nav>
    <div id="nav-sidebar" class="row-fluid">
      <div class="span12">
        <div class="row-fluid introtabs">
          <div class="span3">
            <h1>Produkter</h1>
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
      ?>

      <div class="span4">
        <div class="thumbnail">
          <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
            <img class="post-thumbnail" src="<?php echo $image[0]; ?>" alt="<?php esc_attr(the_title()); ?>">
          </a>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
          <?php the_title('<h3>','</h3>'); ?>
        </a>
        <p><?php echo $excerpt; ?></p>
      </div>

    <?php endwhile; ?>

      <div class="span4">
        <div class="thumbnail">
          <a href="XS1.html" title="XS1"><img src="../assets/images/product2.png" alt=""></a>
        </div>
        <a href="XS1.html" title="XS1"> <h3>XS1</h3> </a>
        <p>
          Ett av de viktigaste tillbehören till lastpallen CrossBorder XP1 är pallkragen CrossBorder
          XS1, som både skyddar och håller ihop lasten.
        </p>
      </div>
      <div class="span4">
        <div class="thumbnail">
          <a href="speciallosningar.html" title=""><img src="../assets/images/product4.png" alt=""></a>
        </div>
        <a href="speciallosningar.html" title="Specialöverbyggnader"> <h3>Specialöverbyggnader</h3> </a>
        <p>
          Många kunder har behov av lösningar som är omöjliga att standardisera. Därför har vi skapat konceptet Specialöverbyggnader.
        </p>
      </div>
    </div>
  </div>
  <div class="row-fluid introtabs producttabs">
    <div class="span12">
      <ul class="nav nav-tabs">
        <li>
          <a href="#spec" title="" data-toggle="tab">Specifikation</a>
        </li>
        <li class="active">
          <a href="#fordelar" title="" data-toggle="tab">Fördelar</a>
        </li>

      </ul>
    </div>
  </div>
  <!--tabbar-->
  <div class="tab-content no-float">
    <!-- fordelar tab -->
    <div class="tab-pane active" id="fordelar">
      <div class="row-fluid tab-previews product-row">
        <div class="span12">
          <br>
          <div class="thumbnail"><img src="../assets/images/pallen.png">
          </div>
          <h2>Egenskaperna som gör skillnad</h2>
          <p class="lead shorter">
            CrossBorder XP1 är byggd i korrosionsskyddad höghållfast stålplåt och sammanfogad med
            hjälp av självpenetrerande stansnit, en epokgörande och beprövad teknik hämtad från
            bilindustrin. Tack vare sin låga vikt och modularitet är den dessutom fullt anpassningsbar
            till alla tänkbara tillämpningar och användningsområden.
          </p>
        </div>
      </div>
      <section>
        <a name="fordelar"></a>
        <div class="row-fluid egenskaper">
          <div class="span12">
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="one"><img src="<?php echo IMG; ?>/icons/icon_90x90_slitstark.png"></a></span>
                <h3>Slitstark</h3>
                <p>
                  Det höghållfasta stål som används i XP1 är fyra gånger starkare än vanligt stål.
                  Galvaniseringen är ett självläkande rostskydd som ger full effekt även över tid.
                  Konstruktionen är stryktålig för att klara påfrestningar vid truckhantering.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="two"><img src="<?php echo IMG; ?>/icons/icon_90x90_latt.png"></a></span>
                <h3>Lätt</h3>
                <p>
                  CrossBorder XP1 i standardformat väger 17 kilo. Det är sju kilo mindre än en ny, torr EURpall.
                  XP1 absorberar inget vatten, och behåller alltså sin låga vikt hela sin livslängd.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="three"><img src="<?php echo IMG; ?>/icons/icon_90x90_anpassningsbar.png"></a></span>
                <h3>Anpassningsbar</h3>
                <p>
                  Modulär konstruktion och rationell, effektiv och flexibel produktion gör det lätt att anpassa
                  XP1 efter era behov. Det gäller såväl mått som utförande, exempelvis tillbehör och
                  möjligheter att säkra lasten.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="four"><img src="<?php echo IMG; ?>/icons/icon_90x90_vaderbestandig.png"></a></span>
                <h3>Väderbeständig</h3>
                <p>
                  CrossBorder XP1 byggs i galvaniserad höghållfast stålplåt. Galvaniseringen ger ett
                  självläkande rostskydd med full effekt även över tid.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="five"><img src="<?php echo IMG; ?>/icons/icon_90x90_temperatur.png"></a></span>
                <h3>Temperatur-
                <br />
                oberoende</h3>
                <p>
                  Stålet i CrossBorder XP1 har samma egenskaper, i princip oavsett den omgivande
                  temperaturen. Stål blir inte skörare i kyla och pallen har samma förnämliga förmåga att bära
                  last även vid exempelvis 60 °C, en temperatur som är vanlig i en container som står i solen.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="six"><img src="<?php echo IMG; ?>/icons/icon_90x90_ergonomisk.png"></a></span>
                <h3>Ergonomisk</h3>
                <p>
                  CrossBorder XP1 är lätt och greppvänlig och minskar därmed risken för belastnings- och
                  förslitningsskador i armar och rygg.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="seven"><img src="<?php echo IMG; ?>/icons/icon_90x90_saker_last.png"></a></span>
                <h3>Säker last</h3>
                <p>
                  Materialet och konstruktionen eliminerar riskerna för skador orsakade av flisor och
                  utstickande spikar.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="eight"><img src="<?php echo IMG; ?>/icons/icon_90x90_insektsfri.png"></a></span>
                <h3>Insektsfri</h3>
                <p>
                  En träpall innebär risk för spridning av skadliga insekter och insektslarver. Framför allt
                  oroar man sig för långhorningar och tallbock. Den senare sprider tallvedsnematoder, och
                  båda innebär reella risker för enorma skador inom skogsbruket. En pall i stål sprider inga
                  insekter.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="nine"><img src="<?php echo IMG; ?>/icons/icon_90x90_hygienisk.png"></a></span>
                <h3>Hygienisk</h3>
                <p>
                  En pall i stål är lätt att hålla ren och är därför mycket lämplig för transporter av till exempel
                  livsmedel. Den bibehåller också denna egenskap över tid.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="ten"><img src="<?php echo IMG; ?>/icons/icon_90x90_absorberar_inte_olja.png"></a></span>
                <h3>Absorberar inte olja och kemikalier</h3>
                <p>
                  En pall av stål absorberar inte olja och kemikalier. Det minskar risken för kontamination av
                  lasten.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="eleven"><img src="<?php echo IMG; ?>/icons/icon_90x90_resistent_olja_kemikalier.png"></a></span>
                <h3>Resistent mot olja och kemikalier</h3>
                <p>
                  Stål är motståndskraftigt mot oljor och de vanligast förekommande kemikalierna.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="twelve"><img src="<?php echo IMG; ?>/icons/icon_90x90_atervinning.png"></a></span>
                <h3>100% återvinningsbar</h3>
                <p>
                  Crossborder XP1 är tillverkad i stål och helt återvinningsbar utan någon kostsam separation
                  av olika material. Till och med som skrot har den ett ekonomiskt värde – som råvara för
                  produktion av nytt stål. Stål kan återvinnas gång på gång och behåller sina goda egenskaper
                  genom alla processer.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="thirteen"><img src="<?php echo IMG; ?>/icons/icon_90x90_livscykelkostnad.png"></a></span>
                <h3>Låg livscykelkostnad</h3>
                <p>
                  Livscykelkostnaden för CrossBorder XP1 är låg, både genom produkten i sig och genom de
                  besparingar som materialets goda egenskaper ger möjlighet till. Galvaniserat stål påverkas
                  inte av väder och vind, och pallen behöver inte lagras inomhus. Den är också brandsäker,
                  vilket ger lägre brandförsäkringspremier och möjlighet att utnyttja hela lagerytan.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="fourteen"><img src="<?php echo IMG; ?>/icons/icon_90x90_reparera.png"></a></span>
                <h3>Utbytbara detaljer</h3>
                <p>
                  CrossBorder XP1 är moduluppbyggd och konstruerad för att vara tålig och slitstark. Skulle
                  den ändå skadas är det lätt att reparera pallen genom att byta ut en trasig eller deformerad
                  detalj.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="fifteen"><img src="<?php echo IMG; ?>/icons/icon_90x90_oberoende_mattstandard.png"></a></span>
                <h3>Oberoende av måttstandard</h3>
                <p>
                  Modulär konstruktion och rationell, effektiv och flexibel produktion gör det lätt att anpassa
                  pallens mått helt efter era behov.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="sixteen"><img src="<?php echo IMG; ?>/icons/icon_90x90_brandsaker.png"></a></span>
                <h3>Brandsäker</h3>
                <p>
                  Galvaniserat stål är brandsäkert. Det ger lägre brandförsäkringspremier och möjlighet att
                  utnyttja hela lagerytan utan att behöva ta hänsyn till brandskyddsregler för lastpallar i plast
                  eller trä.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="seventeen"><img src="<?php echo IMG; ?>/icons/icon_90x90_greppvanlig.png"></a></span>
                <h3>Greppvänlig</h3>
                <p>
                  Det är lätt att få grepp om en CrossBorder XP1. Det gör arbetsställningen effektivare och minskar risken för arbetsskador.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="eighteen"><img src="<?php echo IMG; ?>/icons/icon_90x90_dammar_ej.png"></a></span>
                <h3>Dammar ej</h3>
                <p>
                  Till skillnad från trä så dammar inte stål. Det gör luften på arbetsplatsen bättre och minskar
                  behovet av städning.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="nineteen"><img src="<?php echo IMG; ?>/icons/icon_90x90_dammfri.png"></a></span>
                <h3>Stick- och flisfri</h3>
                <p>
                  En lastpall av stål håller. Även om den blir utsatt för omild behandling bildar de inga stickor eller flisor. Det är skönt för den som behöver hantera den för hand.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="twenty"><img src="<?php echo IMG; ?>/icons/icon_90x90_spikar.png"></a></span>
                <h3>Ingen risk för utstickande spikar</h3>
                <p>
                  Delarna i CrossBorder XP1 är sammansatta med självpenetrerande stansnitar. När dessa är
                  på plats så stannar de på plats. Ingen risk för skador orsakade av utstickande spikar.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="twentyone"><img src="<?php echo IMG; ?>/icons/icon_90x90_hallbar.png"></a></span>
                <h3>Hållbar</h3>
                <p>
                  De flesta skador på lastpallar beror på omild behandling, till exempel i samband med
                  trucktransporter. Ingen lastpall är oförstörbar, men CrossBorder XP1 är tuffare än de flesta.
                  Och skulle den ändå skadas är det lätt att reparera pallen genom att byta ut en trasig eller
                  deformerad detalj.
                </p>
              </div>
            </div>
            <div class="row-fluid spaceme">
              <div class="span4 well property">
                <span class="well-icon"><a id="twentytwo"><img src="<?php echo IMG; ?>/icons/icon_90x90_motstandskraftig.png"></a></span>
                <h3>Motståndskraftig</h3>
                <p>
                  CrossBorder XP1 är byggd i korrosionsskyddad höghållfast stålplåt och sammanfogad med
                  hjälp av självpenetrerande stansnit. Det är en epokgörande och beprövad teknik som
                  bilindustrin utvecklat för att på en gång kunna erbjuda både låg vikt och stryktålighet.
                </p>
              </div>
              <div class="span4 well property">
                <span class="well-icon"><a id="twentythree"><img src="<?php echo IMG; ?>/icons/icon_90x90_rent_vardefullt_stalskrot.png"></a></span>
                <h3>Rent, värdefullt stålskrot</h3>
                <p>
                  Crossborder XP1 är tillverkad i stål och helt återvinningsbar. Stål kan återvinnas gång på
                  gång och behåller sina goda egenskaper genom alla processer. Därför har pallen ett
                  ekonomiskt värde till och med som skrot – som råvara för produktion av nytt stål.
                </p>
              </div>
            </div>
            <a href="#" title=""><img src="<?php echo IMG; ?>/floating-arrow.png" alt="" /></a>
          </div>
        </div>
      </section>
      <div class="row-fluid">
        <div class="span12">
          <br>
          <br>
          <br>
          <p>
            <!-- AddThis Button BEGIN -->
            <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=xa-506d562f0fcc2f96"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
            <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-506d562f0fcc2f96"></script>
            <!-- AddThis Button END -->
          </p>
        </div>
      </div>
      <footer>
        <p>
          Copyright © 2012 CrossBorder Technologies AB
        </p>
        <p>
          Address: Sjöviksvägen 2, 231 62 Trelleborg, Sweden   |   Phone: +46 410 35 35 90   |   Email: <a href="mailto:info@xbrdr.com">info@xbrdr.com</a>
        </p>
      </footer>
    </div>
    <!-- Spec tab -->
    <div class="tab-pane" id="spec">
      <div class="row-fluid spaceme">
        <div class="span12">
          <!--
          <p class="lead">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id commodo turpis.
          Sed in elit erat. Duis dui sapien, vestibulum sit amet placerat quis. Consectetur adipiscing elit. Vivamus id commodo turpis.
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          </p>
          -->
        </div>
      </div>
      <div class="row-fluid">
        <div class="span12">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th><h3>XP1 Helpall (EUR)</h3></th>
                <th><h3>XP1 Halvpall (EUR)</h3></th>
                <th><h3>XP1 Helpall (USA)</h3></th>
                <th><h3>XP1 Halvpall (USA)</h3></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><h3>Längd</h3></td>
                <td><h4>1200 mm</h4></td>
                <td><h4>800 mm</h4></td>
                <td><h4>1225 mm</h4></td>
                <td><h4>820 mm</h4></td>
              </tr>
              <tr>
                <td><h3>Bredd</h3></td>
                <td><h4>800 mm</h4></td>
                <td><h4>600 mm</h4></td>
                <td><h4>820 mm</h4></td>
                <td><h4>615 mm</h4></td>
              </tr>
              <tr>
                <td><h3>Höjd</h3></td>
                <td><h4>110,5 mm</h4></td>
                <td><h4>110,5 mm</h4></td>
                <td><h4>110,5 mm</h4></td>
                <td><h4>110,5 mm</h4></td>
              </tr>
              <tr>
                <td><h3>Vikt</h3></td>
                <td><h4>14 - 20 kg*</h4></td>
                <td><h4></h4></td>
                <td><h4>14 - 20 kg*</h4></td>
                <td><h4></h4></td>
              </tr>
              <tr>
                <td><h3>Lastkapacitet
                <br />
                Statisk belastning</h3></td>
                <td><h4>5500 kg**</h4></td>
                <td><h4>5500 kg**</h4></td>
                <td><h4>5500 kg**</h4></td>
                <td><h4>5500 kg**</h4></td>
              </tr>
              <tr>
                <td><h3>Lastkapacitet
                <br />
                Dynamisk belastning</h3></td>
                <td><h4>1500 kg**</h4></td>
                <td><h4>1500 kg**</h4></td>
                <td><h4>1500 kg**</h4></td>
                <td><h4>1500 kg**</h4></td>
              </tr>
              <tr>
                <td><h3>Lastkapacitet
                <br />
                Pallställ/stallage</h3></td>
                <td><h4>1500 kg**</h4></td>
                <td><h4>1500 kg**</h4></td>
                <td><h4>1500 kg**</h4></td>
                <td><h4>1500 kg**</h4></td>
              </tr>
              <tr>
                <td><h3>Tillbehör - 2 medar</h3></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
              </tr>
              <tr>
                <td><h3>Tillbehör - 3 medar</h3></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
              </tr>
              <tr>
                <td><h3>Tillbehör - 100 mm mede</h3></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
              </tr>
              <tr>
                <td><h3>Tillbehör - 145 mm mede</h3></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
              </tr>
              <tr>
                <td><h3>Skyddsplatta</h3></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
              </tr>
              <tr>
                <td><h3>Ändkåpa</h3></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
                <td><h4>Ja</h4></td>
              </tr>
            </tbody>
          </table>
          <h3>* Beroende på tillval</h3>
          <h3>** Lastkapaciteten angiven här är på en pall med tre medar, skyddsplatta och ändkåpa</h3>
        </div>
      </div>

<?php get_footer(); ?>
