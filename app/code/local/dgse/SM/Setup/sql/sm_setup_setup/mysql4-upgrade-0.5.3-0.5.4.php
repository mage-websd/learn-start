<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$content = <<<EOT
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{skin url='redirectchoice/css/popup.css'}}" />
<input class="choiceModal-state" id="choiceModal-1" type="checkbox" />
<label class="choiceModal" for="choiceModal-1">
  <div class="choiceModal__inner" style="width:35%;">
<h2>Contact one of our bullion experts to learn more or place an order</h2>
<a href="http://dgse.imiqa.com/contactus"><label class="button btn-cart">Go to Locations page</label></a> <label class="button btn-cart" for="choiceModal-1">Stay at this page</label>
  </div>
</label>
<script>
    jQuery("#choiceModal-1").click();
</script>

<div id="right_side">
<div class="bullion-page-header">
<h1>Bullion Catalog</h1>
<span>Select Bullion Metal</span></div>
<ul class="bullion-cate-img">
<li><a class="link_rare_coin_bullion" href="{{store url='Gold'}}"><img src="{{media url="wysiwyg/Precious-Metals-Catalog-Gold.jpg"}}" alt="" /><span>Gold&nbsp;&nbsp;&nbsp;&nbsp;</span></a></li>
<li><a class="link_rare_coin_bullion" href="{{store url='Silver'}}"> <img src="{{media url="wysiwyg/Precious-Metals-Catalog-Silver.jpg"}}" alt="" /><span>Silver&nbsp;&nbsp;</span></a></li>
<li><a class="link_rare_coin_bullion" href="{{store url='Platinum'}}"> <img src="{{media url="wysiwyg/Precious-Metals-Catalog-Platinum.jpg"}}" alt="" /><span>Platinum</span></a></li>
<li><a class="link_rare_coin_bullion" href="{{store url='Palladium'}}"> <img src="{{media url="wysiwyg/Precious-Metals-Catalog-Palladium.jpg"}}" alt="" /><span>Palladium </span></a></li>
</ul>
</div>
EOT;

Mage::getModel('cms/page')->load('bullion', 'identifier')->setContent($content)->save();
$installer->endSetup();