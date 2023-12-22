jQuery().ready(function () {

    var dimensioneBaseBody = jQuery('body').css('font-size').replace('px', '')*1;
    var cssAltoContrasto = false;
    var mostraBarra = false;
    var cssGrayScale = false;
    var valoreCookieAltoContrasto = Cookies.get('madisoft_alto_contrasto');
    var valoreCookieGrayScale = Cookies.get('madisoft_gray_scale');
    var dimensioneCarattereBody = Cookies.get('dimensioneCarattereBody');
    var $showLinkEsterni = Cookies.get('showLinkEsterni');
    if( typeof $showLinkEsterni === 'undefined' ){
        $showLinkEsterni = false;
    }
    var menuAccessKeyVisibile = false;

    if( typeof dimensioneCarattereBody !== 'undefined' ){
     settaDimensioneBody(dimensioneCarattereBody);
    }

    if ($showLinkEsterni) {
        jQuery('body').addClass('linkesterni');
    }
    if (valoreCookieAltoContrasto === 'true'){
        cssAltoContrasto = true;
        addAltoContrastoCss();
    }

    if (valoreCookieGrayScale === 'true'){
        cssGrayScale = true;
        jQuery('body').addClass('grayScale');
    }
    jQuery('#mostraBarra').click(function () {
        event.preventDefault();
        if (mostraBarra == false) {
            mostraBarra = true;
            jQuery('#barraAccessibilita .hidden-btn').show();
        } else {
            mostraBarra = false;
            jQuery('#barraAccessibilita .hidden-btn').hide();
        }

    })
    jQuery('#close-fade-button').click(function () {
        jQuery('#menuaccesskey').addClass('hidden').removeClass('show-menu');
        jQuery('#modal-fade').addClass('hidden');
        menuAccessKeyVisibile = false;
    });
    jQuery('#modal-fade').click(function () {
        jQuery('#menuaccesskey').addClass('hidden').removeClass('show-menu');
        jQuery('#modal-fade').addClass('hidden');
        menuAccessKeyVisibile = false;
    });
    jQuery('#mostrapagineConAccessKey').click(function(event){
        event.preventDefault();
        if (menuAccessKeyVisibile){
            jQuery('#menuaccesskey').addClass('hidden').removeClass('show-menu');
            jQuery('#modal-fade').addClass('hidden');
            menuAccessKeyVisibile = false;
        } else {
            jQuery('#menuaccesskey').removeClass('hidden');
            mostraMenuInPopup('menuaccesskey');
            menuAccessKeyVisibile = true;
        }

    });

    jQuery('#aumentaCarattere').click(function(event){
        event.preventDefault();
        var nuovaDimensione = jQuery('body').css('font-size').replace('px', '')*1 + 3;
        settaDimensioneBody( nuovaDimensione);

    });
    jQuery('#mostraLinkEsterni').click(function(event){
        event.preventDefault();var $showLinkEsterni = Cookies.get('showLinkEsterni');
        if( typeof $showLinkEsterni == 'undefined' ){
            $showLinkEsterni = false;
        }
        var $showLinkEsterni = !$showLinkEsterni;

        if ($showLinkEsterni) {
            jQuery('body').addClass('linkesterni');
            Cookies.set('showLinkEsterni', $showLinkEsterni, { expires: 7 });
        } else {
            jQuery('body').removeClass('linkesterni');
            cancellaCookie('showLinkEsterni');
        }

    });

    jQuery('#diminuisciCarattere').click(function(event){
        event.preventDefault();
        var nuovaDimensione = jQuery('body').css('font-size').replace('px', '')*1 - 3;
        settaDimensioneBody( nuovaDimensione);
    });

    jQuery('#resettaCarattere').click(function(event){
        event.preventDefault();
        settaDimensioneBody(dimensioneBaseBody);
        cancellaCookie('dimensioneCarattereBody');
    });

    jQuery('#settaIlCss').click(function(event){
        event.preventDefault();
        if (cssAltoContrasto){
            cssAltoContrasto = false;
            jQuery('#altocontrastocss').remove();
            cancellaCookie('madisoft_alto_contrasto');
        }
        else{
            cssAltoContrasto = true;
            Cookies.set('madisoft_alto_contrasto', true, { expires: 7 });
            addAltoContrastoCss();
        }
    });

    jQuery('#scalaDiGrigi').click(function(event){
        event.preventDefault();
        if (cssGrayScale){
            cssGrayScale = false;
            cancellaCookie('madisoft_gray_scale');
            jQuery('body').removeClass('grayScale');
        }
        else{
            cssGrayScale = true;
            Cookies.set('madisoft_gray_scale', true, { expires: 7 });
            jQuery('body').addClass('grayScale');
        }
    });

    if (jQuery('#menuaccesskey').length) {
        window.onkeydown = function (event) {
            if (event.keyCode == 27) {
                jQuery('#menuaccesskey').addClass('hidden').removeClass('show-menu');
                jQuery('#modal-fade').addClass('hidden');
                menuAccessKeyVisibile = false;
            }
        };
    }
});

function addAltoContrastoCss(){
    jQuery('body').append('<link rel="stylesheet" id="altocontrastocss" href="/wp-content/themes/temaGov/include/plugins/accessibilita/assets/altocontrasto.css" type="text/css" media="all">');
}

function settaDimensioneBody($dimensioneFont){
    jQuery('body').css('font-size', $dimensioneFont + 'px');
    settaCookieDimensioneBody($dimensioneFont);
}

function settaCookieDimensioneBody($dimensione){
    Cookies.set('dimensioneCarattereBody', $dimensione, { expires: 7 });
}


function cancellaCookie($nomeCookie) {
    Cookies.remove($nomeCookie);
}