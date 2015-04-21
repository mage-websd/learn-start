<?php
$installer = $this;
$installer->startSetup();
$model = Mage::getModel('cms/block');
$block = $model->load('home_bottom');

$content = '<div class="bot-content"><!-- Bottom Content Start -->
<div class="left-col"><!-- Left Col Start --> <!--
<div class="health-tips">
<div class="heading">
<h1>6 Conseils pour une Vie Saine</h1>
</div>
<div class="cont">
<ul>
<li><a title="juicers" href="/extracteurs-de-jus/extracteurs-de-jus-electrique" _mce_href="/extracteurs-de-jus/extracteurs-de-jus-electrique">1. Buvez des Jus de Fruits Frais et Bio</a></li>
<li><a title="kitchen" href="/appareils-de-cuisine" _mce_href="/appareils-de-cuisine">2. Mangez des Produits Frais et Bio</a></li>
<li><a title="filteration" href="/filtres-a-eau" _mce_href="/filtres-a-eau">3. Buvez de l&rsquo;Eau Purifi&eacute;e</a></li>
<li><a title="air-purification" href="/purificateurs-d-air" _mce_href="/purificateurs-d-air">4. Respirez un Air Purifi&eacute;</a></li>
<li><a title="fitness" href="/fitness" _mce_href="/fitness">5. Faites de l&rsquo;Exercice Holistiquement</a></li>
<li><a href="#" _mce_href="#">6. Partez pour un S&eacute;jour Bien-Etre</a></li>
</ul>
</div>
</div>
-->
<div class="health-retreats">
<div class="head">S&eacute;jours Bien-Etre</div>
<div class="link">
<div class="bray">
<h1><a title="byron bay" href="http://www.mullumsari.com/" target="_blank">Byron Bay, Australie</a></h1>
<div class="arrow"><a title="byron bay" href="http://www.mullumsari.com/" target="_blank"><img alt="arrow" src="{{skin url=images/health-retreats-arrow.png}}" height="19" width="20" /></a></div>
</div>
<div class="bali">
<h1><a title="bali" href="http://www.baliyogaretreat.com/" target="_blank">Bali</a></h1>
<div class="arrow"><a title="bali" href="http://www.baliyogaretreat.com/" target="_blank"><img alt="arrow" src="{{skin url=images/health-retreats-arrow.png}}" height="19" width="20" /></a></div>
</div>
</div>
</div>
<link href="//cloudfront.reviews.co.uk/icon-global/style.css" rel="stylesheet" />
<script type="text/javascript" src="//dash.reviews.co.uk/packages/widget/vitality-4-life-fr/2014-09-15.07.09.33-210.js"></script>
<div id="reviewscoukWidget" style="width: 210px;">&nbsp;</div>
<script type="text/javascript">// <![CDATA[
jQuery("#reviewscoukWidget").reviewscouk(reviewscoukTemplate);
// ]]></script>
</div>
<!-- Left Col End -->
<div class="right-col"><!-- Right Col Start -->
<div class="text">
<div class="text_top">&nbsp;</div>
<div class="text_mid">
<h1>Votre Sant&eacute;&hellip;Notre Raison d&rsquo;Etre!</h1>
<p>Depuis plus de 20 ans, <strong>Vitality 4 Life</strong> con&ccedil;oit, fabrique et distribue une gamme haute qualit&eacute; de produits pour la <strong>sant&eacute;</strong> et pour le<strong> bien-&ecirc;tre</strong>. Gr&acirc;ce &agrave; son expertise in&eacute;gal&eacute;e, <strong>Vitality 4 Life France</strong> importe et distribue tous nos produits. Combinez des <strong>jus de fruits et l&eacute;gumes frais et bio</strong> avec une <strong>alimentation saine et vivante</strong>, buvez une<strong> eau purifi&eacute;e</strong> et respirez un <strong>air de qualit&eacute;,</strong> faite de l&rsquo;exercice de fa&ccedil;on holistique et vous aurez tous les composants pour une vie en bonne sant&eacute; et &eacute;panouie&hellip;</p>
<p>Nos meilleurs produits incluent des <strong>extracteurs de jus, filtres &agrave; eau, d&eacute;shydrateurs d&rsquo;aliments, plateformes d&rsquo;exercice vibrantes, accessoires de yoga</strong>, et bien plus encore&hellip;</p>
</div>
</div>
<div class="article_container">{{block type="wp/listhome" template="wp/home_page_acticles.phtml" post_ids_to="107"}} {{block type="wp/listhome" template="wp/home_page_recettes.phtml" post_ids_to="94"}}</div>
</div>
</div>';

$block->setContent($content);
$block->save();

$installer->endSetup();