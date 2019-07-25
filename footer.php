<?php
/**
 * WPized Light: Footer
 *
 * Remember to always include the wp_footer() call before the </body> tag
 *
 * @package WordPress
 * @subpackage WPized_Light
 */

if (isset($_POST) && (sizeof($_POST) > 0)) {
  $postFilterData = $_POST;
  $_SESSION['post_data'] = $_POST;
} elseif (isset($_SESSION['post_data'])) {
  $postFilterData = $_SESSION['post_data'];
};

$keywords = array('cat', 'lang', 'page_id');

$pictogramsSelected = array();
if ($postFilterData['clearFilters'] == 'false') {
  foreach ($postFilterData as $key => $status) {
    if (!in_array($key, $keywords)) {
      array_push($pictogramsSelected, $key);
    }
  }
};
?>

<footer class="footer" <?php if (is_category() || strpos(get_page_template(), 'single-offer')) : ?>id="filtr"<?php endif; ?>>
  <div class="footer-pictograms">
    <div class="container">
      <?php if (is_category() || strpos(get_page_template(), 'single-offer')) : ?>
      <h3><?php echo _e('Wybierz jeden lub kilka piktogramów, aby przefiltrować tkaniny') ?></h3>
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="pictograms-filter-form" class="<?php if (count($pictogramsSelected) > 0) { echo 'filtered'; } ?>">
        <input type="hidden" name="clearFilters" id="clear-filters" value="<?php if ($postFilterData['clearFilters']) { echo $postFilterData['clearFilters']; } else { echo 'true'; } ?>">
        <div class="footer-pictograms-buttons">
          <button type="submit" class="footer-pictograms-submit-filters">Filtruj</button>
          <button type="button" class="footer-pictograms-remove-filters">Usuń zaznaczenia</button>
        </div>
        <ul class="footer-pictograms-list">
          <?php
          $pictograms = get_field_object('field_5724f21e1a3c3');
          foreach ($pictograms['choices'] as $index=>$pictogram) :
          ?>
          <li class="footer-pictograms-item<?php if (in_array($index, $pictogramsSelected)) { echo ' active'; } ?>">
            <a href="#" class="footer-pictograms-link" data-filter="<?php echo $index; ?>">
              <span class="pictograms-<?php echo $index; ?>"></span>
              <span class="pictogram-name"><?php _e($pictogram); ?></span>
              <input type="checkbox" name="<?php echo $index; ?>" id="<?php echo $index; ?>" <?php if (in_array($index, $pictogramsSelected)) : ?>checked<?php endif; ?>>
            </a>
          </li>
          <?php 
          endforeach;
          ?>
          <li class="footer-pictograms-item fake"></li>
          <li class="footer-pictograms-item fake"></li>
          <li class="footer-pictograms-item fake"></li>
          <li class="footer-pictograms-item fake"></li>
          <li class="footer-pictograms-item fake"></li>
        </ul>
      </form>
      <?php else : ?>
      <ul class="footer-pictograms-list">
        <?php
        $pictograms = get_field_object('field_5724f21e1a3c3');
        foreach ($pictograms['choices'] as $index=>$pictogram) :
        ?>
        <li class="footer-pictograms-item">
          <span class="pictograms-<?php echo $index; ?>"></span>
          <span class="pictogram-name"><?php _e($pictogram); ?></span>
        </li>
        <?php 
        endforeach;
        ?>
        <li class="footer-pictograms-item fake"></li>
        <li class="footer-pictograms-item fake"></li>
        <li class="footer-pictograms-item fake"></li>
        <li class="footer-pictograms-item fake"></li>
        <li class="footer-pictograms-item fake"></li>
      </ul>
      <?php endif; ?>
    </div>
  </div>
  <div class="footer-disclaimer">
    <div class="container">
      <p><?php _e('Dołożyliśmy wszelkich starań, aby kolorystyka prezentowanych tkanin na zdjęciach odpowiadała naturalnej, jednak ustawienia monitora oraz usytuowanie oświetlenia podczas wykonywania zdjęć mogą mieć wpływ na prezentowaną kolorystykę. Prosimy o weryfikację kolorów na próbnikach oraz ekspozycjach dostępnych w naszej hurtowni.'); ?></p>
    </div>
  </div>
  <div class="footer-gray">
    <div class="container">
      <?php
      if ( has_nav_menu( 'navigation-top' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'navigation-top',
          'container' => false,
          'items_wrap' => '<ul id="%1$s" class="clearfix %2$s footer-nav">%3$s</ul>',
        ) );
      }
      ?><div class="footer-contact-data">
      <p><?php _e('Hurtownia Tkanin i Akcesorii Meblowych'); ?></p>
      <p><?php _e('ul. Wrocławska 5, 63-600 Kępno', 'footer'); ?></p>
      <p class="phones"><?php _e('tel. +48 502 444 222, +48 500 155 604, tel. / fax (62) 782 12 54'); ?></p>
      </div><div class="footer-fb">
        <div class="fb-page" data-href="https://www.facebook.com/Artmeb-Tkaniny-Meblowe-473329152877834/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-height="380" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Artmeb-Tkaniny-Meblowe-473329152877834/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Artmeb-Tkaniny-Meblowe-473329152877834/">Artmeb Tkaniny Meblowe</a></blockquote></div>
      </div>
    </div>
  </div>
  <div class="container">
    <h2 class="footer-heading"><?php _e('U nas znajdziecie ofertę firm', 'woocommerce'); ?></h2>
    <ul class="footer-logos">
      <li class="footer-logos--item">
        <img src="<?php echo get_bloginfo('template_directory') . '/images/logo-fibero.svg'; ?>" alt="fibero logo" width="207" height="97" class="img-responsive">
      </li>
      <li class="footer-logos--item">
        <img src="<?php echo get_bloginfo('template_directory') . '/images/logo-cleanaboo.jpg'; ?>" alt="cleanaboo logo" width="220" height="104" class="img-responsive">
      </li>
      <li class="footer-logos--item">
        <img src="<?php echo get_bloginfo('template_directory') . '/images/logo-maxi-clean.png'; ?>" alt="maxi clean logo" width="125" height="145" class="img-responsive">
      </li>
      <li class="footer-logos--item">
        <img src="<?php echo get_bloginfo('template_directory') . '/images/logo-toccare.jpg'; ?>" alt="toccare logo" width="270" height="53" class="img-responsive">
      </li>
    </ul>
  </div>
  <div class="container medium footer-copyrights">
    <p>
      <?php _e('Copyright &copy; 2016 Artmeb. All Rights Reserved. Materials can be copied or downloaded only after permision from Artmeb.'); ?>
      <span class="footer-copyrights-link"><?php _e('Made by'); ?> <a href="http://www.studio4u.eu/" target="_blank"><strong>Studio4U</strong></a></span>
    </p>
  </div>
</footer>

<?php 
if (!is_home()) {
  echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>';
};

// do not remove
wp_footer();
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.6&appId=619543384878511";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
