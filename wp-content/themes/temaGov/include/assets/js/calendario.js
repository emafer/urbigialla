function IsInputTypeSupported(typeName) {
	var input = document.createElement("input");
	input.setAttribute("type", typeName);
	var val = (input.type !== "text");
	delete input;
	return val;
}

jQuery(document).ready(function(){
	if ( !jQuery('#data_da').length || !jQuery('#data_a').length){
		return false;
	}
	var mesi = ['Gennaio',
		'Febbraio',
		'Marzo',
		'Aprile',
		'Maggio',
		'Giugno',
		'Luglio',
		'Agosto',
		'Settembre',
		'Ottobre',
		'Novembre',
		'Dicembre'];
	if( ! IsInputTypeSupported('date')){
		jQuery('#data_da, #data_a').datepicker({
			"dateFormat" : "dd/mm/yy",
			"firstDay" : "1",
			"monthNames" : mesi,
			"monthNamesShort" : ['Gen','Feb','Mar','Apr','Mag','Giu',
			'Lug','Ago','Set','Ott','Nov','Dic'],
			"dayNamesMin" : ['Do','Lu','Ma','Me','Gi','Ve','Sa']
		});
	}
})
