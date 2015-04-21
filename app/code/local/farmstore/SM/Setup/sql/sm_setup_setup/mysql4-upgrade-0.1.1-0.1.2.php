<?php
/**
 * Created by PhpStorm.
 * User: Ms TRANG
 * Date: 9/10/14
 * Time: 11:05 AM
 */
/* @var  Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    UPDATE `shipping_premiumrate`
    SET `price_from_value` = '400.0001',
		`price_to_value` = '10000000.0000'
    WHERE `delivery_type` = 'Free Shipping';

    UPDATE `shipping_premiumrate`
    SET `price_to_value` = '400.0000',
        `delivery_type` = 'Standard Shipping and Handling',
        `weight_to_value` = '10.0000'
    WHERE `delivery_type` = 'AusPost Regular';

    UPDATE `shipping_premiumrate`
    SET `weight_to_value` = '10.0000'
    WHERE `delivery_type` = 'Courier';

    UPDATE `shipping_premiumrate`
    SET `weight_to_value` = '10.0000',
        `delivery_type` = 'Registered - Express'
    WHERE `delivery_type` = 'AusPost Express';

    INSERT INTO `shipping_premiumrate` (`website_id`,
										`dest_country_id`,
                                        `condition_name`,
                                        `weight_from_value`,
                                        `weight_to_value`,
                                        `price_from_value`,
                                        `price_to_value`,
                                        `item_from_value`,
                                        `item_to_value`,
                                        `price`,
                                        `cost`,
                                        `delivery_type`)
           VALUES ('1', 'AU', 'package_standard', '10.0001', '10000000.0000', '0', '10000000.0000', '0', '10000000.0000', '0', '0', 'Over 10kg')
");

$installer->endSetup();