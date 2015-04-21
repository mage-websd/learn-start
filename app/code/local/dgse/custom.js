jQuery(document).ready(function ($) {

//Remove the "Multiple" location from the main menu
if( jQuery( '.locations-item > ul > li > a[title="Multiple"]' ).length ){
	jQuery( '.locations-item > ul > li > a[title="Multiple"]' ).parent().remove();
}
/**
 * custom selectbox in android
 */
    var nua = navigator.userAgent;
    var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1);
    if (isAndroid) {
        $('select.form-control').removeClass('form-control').css('width', '100%');
    }
});
/**
 *  collapse block
 *  format: collapse-parent > collapse-block > collapse-title & collapse-content - activity < 980px
 *  if  collapse-parent have class collapse-all: activity all media
 *
 *  collapse-title have collapse-dropped: collapse
 *  collapse-parent-refine: resize open default
 *  collapse-show-resize: show block if resize windowad
 * @type {string}
 */
var domCollapse = '.collapse-parent';
var flagLoad = false;
function activityCollapse() {
    jQuery('.collapse-parent:not(.collapse-all) > .collapse-block > .collapse-title.collapse-dropped').next().slideDown();
    jQuery('.collapse-parent:not(.collapse-all) > .collapse-block > .collapse-title:not(.collapse-dropped)').next().slideUp();
}
function activityCollapseAll() {
    jQuery('.collapse-all > .collapse-block > .collapse-title.collapse-dropped').next().slideDown();
    jQuery('.collapse-all > .collapse-block > .collapse-title:not(.collapse-dropped)').next().slideUp();
}

function collapseBlock(ajax) {
    var widthWindow = jQuery(window).width();
    jQuery(document).off('click',domCollapse + '.collapse-all > .collapse-block > .collapse-title');
    jQuery(document).off('click',domCollapse + ':not(.collapse-all) > .collapse-block > .collapse-title');

    jQuery(document).on('click',domCollapse +'.collapse-all > .collapse-block > .collapse-title',function() {
        jQuery(this).toggleClass('collapse-dropped');
        activityCollapseAll();
    });

    if(ajax) {
        activityCollapseAll();
    }
    else {
        if(flagLoad) { //if resize
            if(widthWindow < 960) {
                jQuery('.collapse-title').removeClass('collapse-dropped');
                jQuery('.collapse-title.collapse-show-resize').addClass('collapse-dropped');
                activityCollapseAll();
            }
        }
        else {
            activityCollapseAll();
        }
    }
    if(widthWindow < 980) {
        activityCollapse();
        jQuery(document).on('click',domCollapse +':not(.collapse-all) > .collapse-block > .collapse-title',function(e) {
            jQuery(this).toggleClass('collapse-dropped');
            activityCollapse();
        });
    }
    else {
        jQuery(domCollapse+':not(.collapse-all) > .collapse-block > .collapse-content').show();
    }
}
jQuery(document).ready(function($) {
    jQuery(window).resize(function() {
        collapseBlock(0);
    });
    jQuery(window).load(function() {
        collapseBlock(0);
        flagLoad = true;
    });
});
/* end collapse block*/
