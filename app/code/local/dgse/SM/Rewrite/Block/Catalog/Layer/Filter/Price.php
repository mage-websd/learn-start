<?php


class SM_Rewrite_Block_Catalog_Layer_Filter_Price extends Sns_Ajaxfilter_Block_Catalog_Layer_Filter_Price
{

    /*
     * custom than extension
    * Get JS that brings the slider in Action
    *
    * @return JavaScript
    */
    public function setProductCollection(){
        if($categoryId = $this->getRequest()->getParam('cat')) {
            $this->_productCollection = Mage::getModel('catalog/category')->load($categoryId)->getProductCollection();
        }elseif($this->_currentCategory){
            $this->_productCollection = $this->_currentCategory->getProductCollection();

        }else{
            $this->_productCollection = Mage::getSingleton('catalogsearch/layer')->getProductCollection();
        }
        $this->_productCollection->addAttributeToFilter(array(
            array(
                'attribute' => 'image',
                'neq'       => 'no_selection',
            ),
            array(
                'attribute' => 'require_img',
                'eq'       => '1',
            ),
        ))
            ->addAttributeToFilter(array(array(
                'attribute' => 'price',
                'gt'       => '0',
            )));

        $attributeCodes = $this->getRequest()->getParams();
		if(count($attributeCodes) > 0) {
			foreach($attributeCodes as $attributeCode => $attributeValue) {
				if(Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product',$attributeCode)->getId()){
					$this->_productCollection->addAttributeToFilter(array(array(
						'attribute' => $attributeCode,
						'eq'       => $attributeValue,
					)));
				}
			}
		}
        if(Mage::app()->getRequest()->getRouteName() != 'catalogsearch') {
            $this->_productCollection->addAttributeToSelect('*')->addAttributeToSort('price', 'ASC');
        }
    }

    public function getSliderJs(){

        $baseUrl = $this->getCurrentUrlWithoutParams();

        if($this->isAjaxSliderEnabled()){
            $ajaxCall = 'ajaxFilter(url);';
        }else{
            $ajaxCall = 'window.location=url;';
        }

        $html = '
			<script type="text/javascript">
				$sns_jq(function($) {
					var newMinPrice, newMaxPrice, url, temp;
					var categoryMinPrice = '.$this->_minPrice.';
					var categoryMaxPrice = '.$this->_maxPrice.';

					//check number
					function isNumber(n) {
					  return !isNaN(parseFloat(n)) && isFinite(n);
					}

					//remove comma
					function removeCommaPrice(price) {
						return price.toString().replace(/\,/g,"");
					}

					//add comma
					function addCommaPrice(DOM) {
						priceBox = DOM.val();
						priceBox = removeCommaPrice(priceBox);
						priceBox = priceBox.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						DOM.val(priceBox);
					}

					//add comma
					function addCommaPricesBox(minPrice, maxPrice) {
						newMinPriceComma = removeCommaPrice(minPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						newMaxPriceComma = removeCommaPrice(maxPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						$("#minPrice").val(newMinPriceComma);
						$("#maxPrice").val(newMaxPriceComma);
					}

					// ajax when change dom price
					function ajaxPriceBoxChange(DOM,temp) {
						var value = removeCommaPrice(DOM.val());
						if(value < categoryMinPrice || value > categoryMaxPrice){
							DOM.val(temp);
							return;
						}
						newMinPrice = $("#minPrice").val();
						newMaxPrice = $("#maxPrice").val();
						url = getUrl(newMinPrice, newMaxPrice);
						'.$ajaxCall.'
					}

					$(".priceTextBox").focus(function(){
						temp = $(this).val();
					});

					$(".priceTextBox").keypress(function(e){
						if(e.keyCode == 13){
							ajaxPriceBoxChange($(this),temp);
						}
					});
					keyCodeAllowController1 = [8,13,46]; //delete, backspace, enter
					keyCodeAllowController2 = [];
					for(i = 35; i <= 40 ; i++){ //left,right,up,down,end,home
					    keyCodeAllowController2.push(i);
					}
					for(i = 48; i <= 57 ; i++){ //number
					    keyCodeAllowController1.push(i);
					}
					for(i = 96; i <= 105 ; i++){ //number pad
					    keyCodeAllowController1.push(i);
					}
					keyCodeAllow = [].concat(keyCodeAllowController1).concat(keyCodeAllowController2);
					$(".priceTextBox").keydown(function(e) {
                        if(keyCodeAllow.indexOf(e.keyCode) == -1) {
                            e.preventDefault();
                            return false;
                        }
					});
					$(".priceTextBox").keyup(function(e) {
						if(keyCodeAllowController1.indexOf(e.keyCode) != -1) {
							newMinPrice = $("#minPrice").val();
							newMaxPrice = $("#maxPrice").val();
							addCommaPricesBox(newMinPrice,newMaxPrice);
						}
					});

					$(".priceTextBox").blur(function(){
						ajaxPriceBoxChange($(this),temp);
					});

					$( "#slider-range" ).slider({
						range: true,
						min: categoryMinPrice,
						max: categoryMaxPrice,
						values: [ '.$this->getCurrMinPrice().', '.$this->getCurrMaxPrice().' ],
						slide: function( event, ui ) {
							newMinPrice = ui.values[0];
							newMaxPrice = ui.values[1];

							$( "#amount" ).val( "'.$this->getCurrencySymbol().'" + newMinPrice + " - '.$this->getCurrencySymbol().'" + newMaxPrice );
							addCommaPricesBox(newMinPrice,newMaxPrice);
						},stop: function( event, ui ) {

							// Current Min and Max Price
							var newMinPrice = ui.values[0];
							var newMaxPrice = ui.values[1];

							// Update Text Price
							$( "#amount" ).val( "'.$this->getCurrencySymbol().'"+newMinPrice+" - '.$this->getCurrencySymbol().'"+newMaxPrice );
							addCommaPricesBox(newMinPrice,newMaxPrice);
							url = getUrl(newMinPrice,newMaxPrice);
							if(newMinPrice != '.$this->getCurrMinPrice().' && newMaxPrice != '.$this->getCurrMaxPrice().'){
								clearTimeout(timer);
								//window.location= url;

							}else{
									timer = setTimeout(function(){
										'.$ajaxCall.'
									}, 200);
								}
						}
					});
					addCommaPricesBox($("#minPrice").val(), $("#maxPrice").val());

					function getUrl(newMinPrice, newMaxPrice){
						newMinPrice = removeCommaPrice(newMinPrice);
						newMaxPrice = removeCommaPrice(newMaxPrice);
						return "'.$baseUrl.'"+"?min="+newMinPrice+"&max="+newMaxPrice+"'.$this->prepareParams().'";
					}
				});
			</script>
		';
        return $html;
    }
}
