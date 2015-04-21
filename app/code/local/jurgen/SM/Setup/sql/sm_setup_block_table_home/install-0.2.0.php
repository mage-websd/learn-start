<?php
$installer = $this;

$installer->startSetup();
//Change content statoc block home-table

$store = Mage::getModel('core/store')->load("proteinedieet");
$storeDieetshop = Mage::getModel('core/store')->load('proteinedieet_nl');
if ($store->getStoreId() && $storeDieetshop->getStoreId()) {
    $storeId = $store->getStoreId();
    $storeIdDieetshop = $storeDieetshop->getStoreId();

    $content = //content block
'<table id="fronttable3" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td><a id="frontfotomarge" href="/catalogsearch/advanced/result/?manufacturer=10"> <img class="resize" src="/media/upload/image/ciaocarblogo.gif" alt="" /></a> <a href="/catalogsearch/advanced/result/?name=&amp;description=&amp;short_description=&amp;sku=&amp;price[from]=&amp;price[to]=&amp;manufacturer[]=24&amp;tax_class_id=&amp;lactose="> <img class="resize" src="/media/upload/image/herodiet.jpg" alt="" /> </a></td>
            <td><a href="/caloriearm-dieet/weight-care.html"><img class="resize" src="/media/upload/image/protiplus/weight%20care%20logo.gif" alt="" /></a><a href="/catalogsearch/result/?q=kineslim&amp;x=0&amp;y=0">&nbsp;</a></td>
            <td><a href="/catalogsearch/advanced/result/?name=&amp;description=&amp;short_description=&amp;sku=&amp;price%5Bfrom%5D=&amp;price%5Bto%5D=&amp;manufacturer%5B%5D=30&amp;tax_class_id=&amp;gluten="><img class="resize" src="/media/upload/image/atkins/oie_1320510NV15M2zT.jpg" alt="" /></a><a href="/catalogsearch/advanced/result/?name=&amp;description=&amp;short_description=&amp;sku=&amp;price[from]=&amp;price[to]=&amp;manufacturer[]=11&amp;tax_class_id=&amp;gluten=">&nbsp;</a></td>
            <td><a href="http://www.dieetshop.com/catalogsearch/advanced/result/?manufacturer=19"><img title="pro10 pharma logo" src="http://www.eiwitdieet.nl/media/wysiwyg/pro10pharma_logo.JPG" alt="pro10 pharma logo" width="151" height="51" /></a></td>
        </tr>
        <tr>
            <td><a href="/catalogsearch/advanced/result/?manufacturer=21"><img class="resize" src="/media/upload/image/dieti2.PNG" alt="" /></a></td>
            <td><a href="/glutenvrije-producten.html"><img class="resize" src="/media/upload/image/banner%20LR/gluten-free.gif" alt="" /></a></td>
            <td><a href="/catalogsearch/advanced/result/?name=&amp;description=&amp;short_description=&amp;sku=&amp;price[from]=&amp;price[to]=&amp;manufacturer[]=11&amp;tax_class_id=&amp;gluten="><img class="resize" src="http://proteinedieet.net/images/supplementen/gerlinea/gerlinea-logo.gif" alt="" /></a></td>
            <td><a href="/catalogsearch/result/?q=nutrisaveurs&amp;x=0&amp;y=0"><img class="resize" src="http://users.telenet.be/dieetshop/logo_nutrisaveurs.jpg" alt="" /></a></td>
        </tr>
        <tr>
            <td><a href="/dietimeal.html"><img class="resize" src="/media/upload/image/titre-pro.gif" alt="" /></a></td>
            <td><a href="/catalogsearch/result/?q=kineslim&amp;x=0&amp;y=0"><img class="resize" src="http://users.telenet.be/dieetshop/kineslim.jpg" alt="" /></a></td>
            <td><a href="/catalogsearch/result/?q=modifast"><img class="resize" src="/media/upload/image/modifastprotiplus.png" alt="" /></a></td>
            <td><a href="/walden-farms.html"><img class="resize" src="http://users.telenet.be/dieetshop/waldenfarms%20logo.gif" alt="" /></a></td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>

<p>Hier een overzicht van de fasen van het eiwitdieet. Meer informatie <a href="/eiwitdieet">op deze pagina</a>&nbsp;</p>
<div style="display: block; margin-left: auto; margin-right: auto; width: 580px;"><a href="/verzendwijzen_shop"><img src="/media/upload/image/gratis-levering.png" alt="" width="265" height="110" /></a> <a href="/koekjes.html"><img src="../media/upload/image/EIWITKOEKJES.jpg" alt="" /></a></div>
<p>&nbsp;</p>
<p><a href="/catalogsearch/result/?q=kineslim&amp;x=0&amp;y=0"><img style="margin-left: auto; margin-right: auto; display: block;" src="/media/upload/image/kineslim/banner-kineslim.jpg" alt="" /></a></p>
<p>&nbsp;</p>

<table id="table2" class="dieet pro10" style="width: 100%;" border="0" cellspacing="3">
    <tbody>
        <tr>
            <td><input type="image" name="I5" src="/media/upload/image/voordeel(1).gif" align="top" /></td>
            <td>
                <p style="margin-top: 0; margin-bottom: 0;">Reeds sinds <strong>2005</strong> de grootste webwinkel van eiwitrijke shakes en repen (voorheen <a style="text-decoration: none;" href="http://www.proteinedieet.net">www.proteinedieet.net</a>)</p>
            </td>
            <td><input type="image" name="I4" src="http://www.eiwitdieet.nl/media/upload/image/voordeel(1).gif" /></td>
            <td>meer dan 400 referenties, waaronder een 100-tal die u enkel bij ons zal vinden</td>
        </tr>
        <tr>
            <td><input type="image" name="I1" src="http://www.eiwitdieet.nl/media/upload/image/voordeel(1).gif" /></td>
            <td>Bestel in vertrouwen, u kan ons bereiken via chat, via mail &eacute;n zelfs telefonisch. Geen anoniem postbus</td>
            <td><input type="image" name="I3" src="http://www.eiwitdieet.nl/media/upload/image/voordeel(1).gif" /></td>
            <td>40.000 verzonden bestellingen. Zelfde tarief voor Nederland en Belgi&euml;</td>
        </tr>
    </tbody>
</table>

<p>&nbsp;</p>
<div class="table-home">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <table>
                <tbody>
                    <tr>
                        <td style="color: white;" colspan="2" align="center" valign="middle" bgcolor="#802f00">1. Actief</td>
                    </tr>
                    <tr>
                        <td style="color: white;" colspan="2" align="center" valign="middle" bgcolor="#f4c400">Actieve fase</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#f4c400" width="50">Fase 1 streng<br/>&nbsp;</td>
                        <td align="center" valign="middle" bgcolor="#f4c400" width="50">Fase 2 gemengd<br/>&nbsp;</td>
                    </tr>
                    <tr>
                        <td bgcolor="#f4c400" width="100"><img src="/media/upload/rds086429_100op60.jpg" alt="" width="100" height="60" /></td>
                        <td bgcolor="#f4c400" width="100"><img src="/media/upload/fdc966110_100op60.jpg" alt="" width="100" height="60" /></td>
                    </tr>
                    <tr>
                        <td style="color: white;" align="center" valign="middle" bgcolor="#802f00" width="50">4 tot 6 zakjes</td>
                        <td style="color: white;" align="center" valign="middle" bgcolor="#802f00" width="50">+/- 3 tot 4 zakjes</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#f4c400" width="50">Salades en<br/>groenten</td>
                        <td align="center" valign="middle" bgcolor="#f4c400" width="50">Salades en<br/>groenten</td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-top: 0;" align="center">&nbsp;1 tot 2 weken</p>
                        </td>
                        <td align="center" valign="middle" bgcolor="#f4c400" width="50">groenten: 1 portie150 tot 200g<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center" valign="middle" bgcolor="#f4c400">Gevogelte <br /> Vlees <br /> Vis <br /> Zeevruchten <br /> 1 porties van 150g<br/>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="center" valign="middle">Tot aan</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="center" valign="middle">
                            <p align="center">&nbsp;streefgewicht</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <table>
                <tbody>
                    <tr>
                        <td style="color: white;" colspan="3" align="center" valign="middle" bgcolor="#802f00">2. Opbouwen</td>
                    </tr>
                    <tr>
                        <td style="color: white;" colspan="3" align="center" valign="middle" bgcolor="#e5b797">Overgangsfase</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#e5b797">Ontbijt + prote&iuml;nen</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Fruit + prote&iuml;nen</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Brood + Fruit + prote&iuml;nen</td>
                    </tr>
                    <tr>
                        <td bgcolor="#e5b797" width="100"><img src="/media/upload/fdc907684_100op60.jpg" alt="" width="100" height="60" /></td>
                        <td bgcolor="#e5b797" width="100"><img src="/media/upload/fdc965273_100op60.jpg" alt="" width="100" height="60" /></td>
                        <td bgcolor="#e5b797" width="100"><img src="/media/upload/rds126035_100op60.jpg" alt="" width="100" height="60" /></td>
                    </tr>
                    <tr>
                        <td style="color: white;" align="center" valign="middle" bgcolor="#802f00">+/- 3 zakjes</td>
                        <td style="color: white;" align="center" valign="middle" bgcolor="#802f00">+/- 2 zakjes</td>
                        <td style="color: white;" align="center" valign="middle" bgcolor="#802f00">+/- 2 zakjes</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#e5b797">Salades en groenten</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Salades en groenten</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Salades en groenten</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#e5b797">groenten: 2 porties 150 tot 200g</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">groenten: 2 porties 150 tot 200g</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">groenten: 2 porties 150 tot 200g</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#e5b797">Gevogelte<br /> Vlees<br /> Vis<br /> Zeevruchten<br /> 2 porties van 150g</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Gevogelte<br /> Vlees<br /> Vis<br /> Zeevruchten<br /> 2 porties van 120g</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Gevogelte<br /> Vlees - Vis zuivel<br /> Zeevruchten<br /> 2 porties van 120g</td>
                    </tr>
                    <tr>
                        <td align="center" valign="middle" bgcolor="#e5b797">Ontbijt</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Ontbijt</td>
                        <td align="center" valign="middle" bgcolor="#e5b797">Ontbijt</td>
                    </tr>
                    <tr>
                        <td>
                            <p align="center">&nbsp;&nbsp;&nbsp; 1 week</p>
                        </td>
                        <td align="center" valign="middle" bgcolor="#e5b797"  width="50">Fruit</td>
                        <td align="center" valign="middle" bgcolor="#e5b797"  width="50">Fruit</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    <td>
                        <p align="center">&nbsp; 1 week</p>
                    </td>
                    <td align="center" valign="middle" bgcolor="#e5b797">Brood</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <p align="center">&nbsp; 1 week</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <table>
            <tbody>
                <tr>
                    <td style="color: white;" colspan="2" align="center" valign="middle" bgcolor="#802f00" width="50">3. Evenwicht</td>
                </tr>
                <tr>
                    <td style="color: white;" colspan="2" align="center" valign="middle" bgcolor="#cdc200" width="50">Behoudingsfase</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Zetmelen + prote&iuml;nen</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Altijd</td>
                </tr>
                <tr>
                    <td bgcolor="#cdc200" width="100"><img src="/media/upload/fdc936665_100op60.jpg" alt="" width="100" height="60" /></td>
                    <td bgcolor="#cdc200" width="100"><img src="/media/upload/rds086457_100op60.jpg" alt="" width="100" height="60" /></td>
                </tr>
                <tr>
                    <td style="color: white;" align="center" valign="middle" bgcolor="#802f00" width="50">&nbsp;1 zakje</td>
                    <td style="color: white;" align="center" valign="middle" bgcolor="#802f00" width="50">(1 zakje)</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="100">Salades en groenten</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Salades naar hartelust</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">groenten: 2 porties 150 tot 200g</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">groenten</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Gevogelte<br /> Vlees - vis<br /> Zuivel<br /> Zeevruchten<br /> 2 porties van 120g</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Gevogelte<br /> Vlees - vis<br /> zuivel<br /> Zeevruchten<br /> &nbsp;</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Ontbijt</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50">Ontbijt</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50" height="28">Fruit</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50" height="28">Fruit</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50" height="27">Brood</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" width="50" height="27">Brood</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200" height="27">Zetmelen</td>
                    <td align="center" valign="middle" bgcolor="#cdc200" height="27">Zetmelen</td>
                </tr>
                <tr>
                    <td align="center" valign="middle" bgcolor="#cdc200">periode 1 &amp; 2</td>
                    <td align="center" valign="middle" bgcolor="#cdc200">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="disqus_thread">&nbsp;</div>
<script type="text/javascript">// <![CDATA[
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = "dieetshop";
    var disqus_identifier = "dieetshophome";// required: replace example with your forum shortname

    /* * * DON`T EDIT BELOW THIS LINE * * */
    (function () {
        var
        dsq = document . createElement("script");
        dsq . type = "text/javascript";
        dsq . async = true;
        dsq . src = "http://" + disqus_shortname + ".disqus.com/embed.js";
        (document . getElementsByTagName("head")[0] || document . getElementsByTagName("body")[0]) . appendChild(dsq);
    })();
// ]]></script>
<noscript > Please enable JavaScript to view the & amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;a href = "http://disqus.com/?ref_noscript" & amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;comments powered by Disqus .&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;lt;/a & amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;gt;</noscript >
<p ><a class="dsq-brlink" href = "http://disqus.com" > blog comments powered by < span class="logo-disqus" > Disqus</span ></a ></p >
<p > Disclaimer: Dit zijn spontane reacties van bezoekers . Uw afslankresultaten kunnen minder zijn, identiek of beter . Het resultaat wordt ook pas bereikt na een persoonlijke inspanning .</p > ';
//end content block static


    $blockId = Mage::getModel('cms/block')->getCollection()
        ->addFieldToFilter('identifier','home-page-front-images')
        ->addStoreFilter($storeIdDieetshop, false)
        ->getColumnValues('block_id');
    $blockId = $blockId[0];
    $block = Mage::getModel('cms/block')->load($blockId);
    $block->setContent($content);
    $storeArrayId = $block->getStoreId();
    if(!in_array($storeId,$storeArrayId)) {
        $storeArrayId[] = $storeId;
        $block->setStores($storeArrayId);
    }
    $block->save();
}
$installer->endSetup();