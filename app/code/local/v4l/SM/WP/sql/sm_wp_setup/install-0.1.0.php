<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 23/01/2015
 * Time: 09:12
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/* change content home blog */
$content = <<<EOD
<div class="knwl_base"><!-- Knowladge Base Start -->
<h1>Base de Connaissance</h1>
<div class="living_juice"><!-- Living Juice Start -->
<table border="0">
<tbody>
<tr>
<td><a title="Jus de fruits sante" href="/health-articles/category/living-juice"><img alt="" src="{{skin url='images/living_juices_head.jpg'}}" height="92" width="994" usemap="#Map1" /></a></td>
</tr>
</tbody>
</table>
<div class="mid"><!-- Mid Start -->
<div class="lat_articles"><!-- Articles Start -->
<div class="heading"><span>Derniers Articles</span></div>
<div class="container"><!-- Container Start --> {{block type="wp/listhome" post_ids_to="60,68"}}
<p><a title="Jus de fruits sante" href="/health-articles/category/living-juice">Voir plus d&rsquo;Articles</a></p>
</div>
<!-- Container End --></div>
<!-- Articles End --></div>
<!-- Mid End -->
<div class="bottom">&nbsp;</div>
</div>
<!-- Living Juice End -->
<div class="living_food"><!-- Living Food Start -->
<table border="0">
<tbody>
<tr>
<td><a title="Cuisine vivante" href="/health-articles/category/living-food"><img alt="" src="{{skin url='images/living_food_head.jpg'}}" height="90" width="994" usemap="#Map2" /></a></td>
</tr>
</tbody>
</table>
<div class="mid"><!-- Mid Start -->
<div class="lat_articles"><!-- Articles Start -->
<div class="heading"><span>Derniers Articles</span></div>
<div class="container"><!-- Container Start --> {{block type="wp/listhome" post_ids_to="107,94"}}
<p><a title="Cuisine vivante" href="/health-articles/category/living-food">Voir plus d&rsquo;Articles</a></p>
</div>
<!-- Container End --></div>
<!-- Articles End --></div>
<!-- Mid End -->
<div class="bottom">&nbsp;</div>
</div>
<!-- Living Food End -->
<div class="pure_water"><!-- Pure Water Start -->
<table border="0">
<tbody>
<tr>
<td><a title="Eau Purifi&eacute;e" href="/health-articles/category/pure-water"><img alt="" src="{{skin url='images/pure_water_head.jpg'}}" height="92" width="994" usemap="#Map3" /></a></td>
</tr>
</tbody>
</table>
<div class="mid"><!-- Mid Start -->
<div class="lat_articles"><!-- Articles Start -->
<div class="heading"><span>Derniers Articles</span></div>
<div class="container"><!-- Container Start --> {{block type="wp/listhome" post_ids_to="165,153"}}
<p><a title="Eau Purifi&eacute;e" href="/health-articles/category/pure-water">Voir plus d&rsquo;Articles</a></p>
</div>
<!-- Container End --></div>
<!-- Articles End --></div>
<!-- Mid End -->
<div class="bottom">&nbsp;</div>
</div>
<!-- Pure Water End -->
<div class="pure_air"><!-- Pure Air Start -->
<table border="0">
<tbody>
<tr>
<td><a title="Air Pur" href="/health-articles/category/pure-air"><img alt="" src="{{skin url='images/pure_air_haed.jpg'}}" height="92" width="994" usemap="#Map4" /></a></td>
</tr>
</tbody>
</table>
<div class="mid"><!-- Mid Start -->
<div class="lat_articles"><!-- Articles Start -->
<div class="heading"><span>Derniers Articles</span></div>
<div class="container"><!-- Container Start --> {{block type="wp/listhome" post_ids_to="175"}}
<p><a title="Air Pur" href="/health-articles/category/pure-air">Voir plus d&rsquo;Articles</a></p>
</div>
<!-- Container End --></div>
<!-- Articles End --></div>
<!-- Mid End -->
<div class="bottom">&nbsp;</div>
</div>
<!-- Pure Air End -->
<div class="holistic_exercise"><!-- Holistic Exercise Start -->
<table border="0">
<tbody>
<tr>
<td><a title="Exercices pour le Corps et l&lsquo;Esprit" href="/health-articles/category/holistic-exercise"><img alt="" src="{{skin url='images/holistic_exercise_head.jpg'}}" height="92" width="994" usemap="#Map5" /></a></td>
</tr>
</tbody>
</table>
<div class="mid"><!-- Mid Start -->
<div class="lat_articles"><!-- Articles Start -->
<div class="heading"><span>Derniers Articles</span></div>
<div class="container"><!-- Container Start --> {{block type="wp/listhome" post_ids_to="124,113"}}
<p><a title="Exercices pour le Corps et l&lsquo;Esprit" href="/health-articles/category/holistic-exercise">Voir plus d&rsquo;Articles</a></p>
</div>
<!-- Container End --></div>
<!-- Articles End --></div>
<!-- Mid End -->
<div class="bottom">&nbsp;</div>
</div>
<!-- Holistic Exercise End -->
<div class="healthy_recipes"><!-- Healthy Recipes Start -->
<table border="0">
<tbody>
<tr>
<td><a title="Recettes Sant&eacute;" href="/health-articles/category/healthy-recipes"> <img alt="" src="{{skin url='images/healthy_recipes_head.jpg'}}" height="92" width="994" usemap="#Map" /></a></td>
</tr>
</tbody>
</table>
<div class="mid"><!-- Mid Start -->
<div class="lat_articles"><!-- Articles Start -->
<div class="heading"><span>Derniers Articles</span></div>
<div class="container"><!-- Container Start --> {{block type="wp/listhome" post_ids_to="80,85"}}
<p><a title="Recettes Sant&eacute;" href="/health-articles/category/healthy-recipes">Voir plus d&rsquo;Articles</a></p>
</div>
<!-- Container End --></div>
<!-- Articles End --></div>
<!-- Mid End -->
<div class="bottom">&nbsp;</div>
</div>
<!-- Healthy Recipes End -->
<div class="video">
<div class="heading"><span>Vid&eacute;os</span></div>
<div class="cont">
<div class="vid"><a title="Play The Movie" href="http://www.youtube.com/v/ofEwMcZYoF8&amp;fs=1&amp;rel=0&amp;autoplay=1" rel="shadowbox[rotation];width=480;height=385;player=swf"> <img alt="" src="{{skin url='images/video_knw.jpg'}}" height="204" width="225" /> </a></div>
<div class="vid"><a title="Play The Movie" href="http://www.youtube.com/v/Pn8ARa4UXp4&amp;fs=1&amp;rel=0&amp;autoplay=1" rel="shadowbox[rotation];width=480;height=385;player=swf"><img alt="Oscar 930 Pro" src="{{skin url='images/video2.jpg'}}" height="204" width="225" /></a></div>
<div class="vid"><a title="Play The Movie" href="http://www.youtube.com/v/Beb1Q8XqsLQ&amp;fs=1&amp;rel=0&amp;autoplay=1" rel="shadowbox[rotation];width=480;height=385;player=swf"> <img alt="" src="{{skin url='images/video2-vibro.jpg'}}" height="204" width="225" /> </a></div>
<div class="vid"><img alt="" src="{{skin url='images/video3.jpg'}}" height="204" width="225" /></div>
</div>
</div>
</div>
<!-- Knowladge Base End -->
EOD;

$page = Mage::getModel('cms/page')->load('health-articles');
$page->setData('content',$content);
if(!$page->getData('page_id')) {
    $data = array('title'=>'Base de Connaissance',
        'identifier'=>'health-articles',
        'is_active'=>'1',
        'stores' => array(6)
    );
    $page->setData($data);
}
$page->save();

/* disable top link */
$config = Mage::getModel('core/config');
$config->saveConfig('wordpress/toplink/enabled', 1);
$config->saveConfig('wordpress/toplink/label', 'Articles Santé');

$installer->endSetup();