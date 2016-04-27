////////////////////////////////////////////////
// Topo
////////////////////////////////////////////////

function header(){

	var brand 	=  jQuery.lgr.sidebar.find('figure');
	
	//brand.delay(1000).fadeTo("fast",1,function(){});
	setTimeout(function(){
		brand.addClass("animated flipInY");
	},800);


}



////////////////////////////////////////////////
// Menu responsivo
////////////////////////////////////////////////

function navResponsive(){

	jQuery('.lgr-nav-responsive').meanmenu({
		meanScreenWidth: "1024"
	});

}


////////////////////////////////////////////////
// Grid responsivo
////////////////////////////////////////////////

function gridResponsive(){


	var wrapper       = jQuery.lgr.wrapper;
	var cover	      = jQuery(".lgr-internal-cover figure");
	var displayWidth  = jQuery.lgr.clientWidth;
	var displayHeight = jQuery.lgr.clientHeight;

	if(displayWidth > 1024){

		wrapper.height((displayHeight - 30));
		cover.height(((displayHeight * 15)/100));

		if(displayWidth > 1400){
			cover.height(((displayHeight * 35)/100));
		}
	}	

}



////////////////////////////////////////////////
// General
////////////////////////////////////////////////


function general(){

	var wrapper       = jQuery.lgr.wrapper;
	var displayWidth  = jQuery.lgr.clientWidth;
	var displayHeight = jQuery.lgr.clientHeight;
	var contentHeight = jQuery.lgr.wrapper.height();
	var galleryWrap	  = jQuery(".gg_gallery_wrap");
	var galleryBox    = jQuery(".gg_container");
	var galleryImg    = jQuery(".gg_img");
	var galleryNav    = jQuery(".gg_paginate");
	
	/* Carousel da home */

	jQuery("#lgr-home-carousel").carousel({

		interval: 3000

	});


	/* Ajuste da galeria  */

	if(galleryWrap.size() >= 1){

		//Somente monitores grandes
		if(displayWidth > 1024 ){

			if(galleryImg.size() <= 3){

				console.log((galleryImg.width() * 3) + 20);

				//galleryImg.width(((wrapper.width() * 35)/100));
				// galleryImg.height(((displayHeight * 18)/100));
				
				setTimeout(function(){

					galleryBox.css({
						
						'width': ((galleryImg.width() * 3) + 20) + 'px',
						'position': 'absolute',
						'left': ((wrapper.width() * 10) / 100) + 'px'
					});


				},1000);

				galleryNav.css({

					'position':'absolute',
					'left':'50%',
					'marginTop':'170px'

				});

				if(displayWidth > 1400){

					galleryNav.css({'left': '45%'});
					galleryBox.css({'left': ((wrapper.width() * 20) / 100) + 'px'});
				}
			}
		}



	}



	console.log(contentHeight +' / display:'+ displayHeight);


}


////////////////////////////////////////////////
// Scrollpane
////////////////////////////////////////////////

function scrollPane(){

	jQuery('.scroll-pane').each(function(){

		jQuery(this).jScrollPane({
				showArrows: jQuery(this).is('.arrow')
		});
		
		var api = jQuery(this).data('jsp');
		var throttleTimeout;
		jQuery(window).bind('resize',function(){

			if (!throttleTimeout){

				throttleTimeout = setTimeout(function(){
					api.reinitialise();
					throttleTimeout = null;
				},50);
			}
		});

	});
}


////////////////////////////////////////////////
// Newsletter
////////////////////////////////////////////////


function newsletter(){


	/* Ajustando Placeholders */
	
	var frm   = $('.lgr-newsletter form');
	var snd	  = frm.find('#btnSubscribeSubmit');
	var name  = frm.find('#txtName');
	var email = frm.find('#txtMail');

	var time  = 300;

	var successMessage	 = "Inscrição realizada com sucesso!";
	var errorMessage = "Inscrição não realizada. Tente novamente mais tarde.";

	//frm.find('input').placeholder();


	snd.on('click',function(e) {
		
		snd.unbind('click');

		frm.validationEngine('attach',{
            
            relative: true,
            focusFirstField : false,
            promptPosition:"bottomRight",
			onValidationComplete: function(form,status){
				
				if(status ==  true){

					var frmName  = name.val();
					var frmEmail = email.val();

					frm.block({ 
			            
			            fadeIn: 500, 
			            message:"<div class='lgr-newsletter-loader'>",
						css: { 
			                border: 'none', 
			                padding: '5px', 
			                backgroundColor: '', 
			                opacity: 1, 
			                color: '#333' 
			            },
			            overlayCSS:  { 
    						backgroundColor: '#2550A3', 
    						opacity: 1 
						}

			        });//block

			        var addSubscribe = jQuery.ajax({
							
						url: $.lgr.url + "/newsletter.php",
						type: "POST",
						data: {n: frmName, e:frmEmail},
						dataType: "html"
						
					});

					addSubscribe.done(function(msg){

						if (parseInt(msg) != 0) {

							frm.fadeOut(time);
							frm.before('<div class="lgr-newsletter-output output-success"> <i class="fa fa-check-circle"></i><p>'+ successMessage +'</p></div>');

						}else{

							frm.fadeOut(time);
							frm.before('<div class="lgr-newsletter-output output-error">  <i class="fa fa-warning"></i><p>'+ errorMessage +'</p></div>');

						}

					});

					
				}//if

				
			}//onComplete
			

    	});

    	e.stopImmediatePropagation();


	});



}



////////////////////////////////////////////////
// Preloader
////////////////////////////////////////////////


function loadWebsite(){

	var  horizontalPos		= "50%";
	var  verticalPos 		= "40%";
	var  overContentName	= "jpreOverlayContent";
	var  overContent 		= jQuery('#' + overContentName);


	// Ativa o preloader

	jQuery.lgr.body.jpreLoader({
		loaderVPos:verticalPos,
		loaderHPos: horizontalPos
	}, function(){
		
		//TweenLite.to(, 1, {alpha:0, ease:Expo.easeOut, onComplete:function(){
			//overContent.remove();
		//}});
	});
}

////////////////////////////////////////////////
////////////////////////////////////////////////
//  Variáveis e chamadas das funções
///////////////////////////////////////////////
///////////////////////////////////////////////


jQuery(document).ready(function(){
		
		
		jQuery.lgr = {
			
			url			 :  jQuery('body').data('lgr-url'),
			body		 :  jQuery('body'),
			header  	 :  jQuery('#lgr-header'),
			wrapper      :  jQuery('#lgr-wrapper'),
			content 	 :  jQuery('#lgr-content'),
			footer  	 :  jQuery('#lgr-footer'),
			sidebar 	 :  jQuery('#lgr-sidebar'),
			clientWidth  :  jQuery(window).width(),
			clientHeight : 	jQuery(window).height()
		
		}


		header();
		general();
		gridResponsive();
		newsletter();
		navResponsive();

});//fim ready