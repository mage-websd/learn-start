<?php
$installer = $this;
$installer->startSetup();
$installer->run("UPDATE xmaincategory SET store_id='4'
");
$installer->endSetup();
