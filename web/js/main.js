function editor(textarea){
	// console.log(textarea.name);
	if(textarea){
		CKEDITOR.replace(textarea[0]);
	}
}

$(document).ready(function(){

	$(".datepicker"	).datepicker();

	if($(".accordion").length>0){
		$(".accordion").accordion();
	}

	if($(".tabs").length>0){
		   $( ".tabs" ).tabs();
	}

	if($("#address-postcode").length>0){
		   $( "#address-postcode" ).cep();
	}
	if($("#clients-fiscal_number").length>0){
		   $( "#clients-fiscal_number" ).mask("99.999.999/9999-99");
	}

	if($(".phone").length>0){
		$(".phone").mask("(99) 9999-9999");

	}
	// editor($('.editor'));
	if($('.editor')){
		$('.editor').each(function(){
			CKEDITOR.replace(
			this, 
			{
				// language: 'pt',
				// uiColor: '#aed0ea',
			}
			// config.extraPlugins = 'font';	
			);
			
		});
	}
	
});
	

