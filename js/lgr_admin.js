function tooltips(){

	jQuery('.lgr-tooltip').tooltip({ tooltipClass: "lgr-tooltip" });

}



////////////////////////////////////////////////
////////////////////////////////////////////////
//  Variáveis e chamadas das funções
///////////////////////////////////////////////
///////////////////////////////////////////////


jQuery(document).ready(function(){
		
		
		jQuery.lgr = {
			
			body		 :  jQuery('body'),
			header  	 :  jQuery('#lgr-header'),
			content 	 :  jQuery('#lgr-content'),
			footer  	 :  jQuery('#lgr-footer'),
			sidebar 	 :  jQuery('#lgr-sidebar'),
			clientWidth  :  jQuery(window).width(),
			clientHeight : 	jQuery(window).height()
		
		}

		tooltips();


});//fim ready