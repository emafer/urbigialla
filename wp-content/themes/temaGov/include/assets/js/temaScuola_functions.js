jQuery().ready(function(){
    var $menu_mostrato;
    jQuery('#show-top-sidebar').click(function () {
        $menu_mostrato = 'testatasidebar';
        mostraMenuInPopup($menu_mostrato);
    });
    jQuery('#show-left-sidebar').click(function () {
        $menu_mostrato = 'leftsidebar';
        mostraMenuInPopup($menu_mostrato);
    });
    jQuery('#show-right-sidebar').click(function () {
        $menu_mostrato = 'rightsidebar';
        mostraMenuInPopup($menu_mostrato);
    });
    jQuery('#close-fade-button').click(function () {
        ripristina($menu_mostrato);
    })
    jQuery('#modal-fade').click(function () {
        ripristina($menu_mostrato);
    })
//amministrazioneTrasparente
    jQuery('.hide2').click(function(){
        event.preventDefault();
        jQuery(this).hide();
        jQuery(this).parent().find('div').removeClass('list2');
        jQuery(this).parent().find('.show2').show();
    });
    jQuery('.show2').click(function(){
        event.preventDefault();
        jQuery(this).hide();
        jQuery(this).parent().find('div').addClass('list2');
        jQuery(this).parent().find('.hide2').show();
    });
});
function ripristina($menu_mostrato) {
    jQuery('#modal-fade').addClass('hidden');
    jQuery('#' + $menu_mostrato).removeClass('show-menu');
    jQuery('#' + $menu_mostrato).addClass('hidden-xs');
}

function mostraMenuInPopup($menu_mostrato) {
    jQuery('#' + $menu_mostrato).addClass('show-menu');
    jQuery('#' + $menu_mostrato).removeClass('hidden-xs');
    jQuery('#modal-fade').removeClass('hidden');
}