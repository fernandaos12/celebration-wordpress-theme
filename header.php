<!DOCTYPE html>
<html class="no-js">
   
   <head>
   		
        <?php
        	
			
			// Ligre Funções
			$lgr =  new ligreFunctions;
			
			
			// Variáveis Globais
			global $themePath;
			global $themePathWp;
						

			
			//Diretorio do tema
			
			$themePath = $lgr->themePath("2014","theme");
           
						
			// Inserindo Classes
			include_once("includes/classes/class.ligre.functions.php");
									
								
		?>
        
        
        <!-- Título da Página -->
        <title><?php bloginfo("name"); ?> | <?php bloginfo("description");?></title>
       
    	
        <!-- Metatags -->
        <meta charset="<?php bloginfo("charset");?>">
        <meta name="author" content="Gueeks Digital - www.gueeks.com">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <!-- Favicon-->
		<link rel="shortcut icon" href="<?php echo $themePath; ?>/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo $themePath; ?>/img/favicon.ico" type="image/x-icon">

        
        <!-- Estilos -->
        <link rel="stylesheet" type="text/css" href="<?php echo $themePath; ?>/style.css">
                                
        <!-- WP Head -->
		<?php wp_head(); ?>        
        
        
        <!--[if gte IE 7]>        
        
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_pie.js"></script>
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_ie_css3.js"></script>
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_ie_html5.js"></script>
		<script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_bg_iframe.js"></script>

        
        <![endif]--> 
       
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo $themePath; ?>/css/lgr_ie7.css">
        <![endif]-->
       
        <!--[if IE 8]>
	    <link rel="stylesheet" type="text/css" href="<?php echo $themePath; ?>/css/lgr_ie8.css"> 
        <![endif]-->
       
        <!--[if IE 9]>
	    <link rel="stylesheet" type="text/css" href="<?php echo $themePath; ?>/css/lgr_ie9.css">
        <![endif]-->
         
         
         

        
	</head>
    
    
    <body data-lgr-url="<?php echo $themePath; ?>">



        <section id="lgr-wrapper">
        <div class="container-fluid">
            <div class="row">
                
                <!-- Navegação -->
                <div class="col-md-2 col-xs-12 col-sm-12" id="lgr-sidebar">
                    
                    <a href="<?php echo get_bloginfo('url'); ?>"><figure></figure></a>                  
                    <?php wp_nav_menu( array('menu' => 'principal','container_class' => 'lgr-nav visible-md visible-lg')); ?>
                    <?php wp_nav_menu( array('menu' => 'principal','container_class' => 'lgr-nav-responsive visible-xs visible-sm')); ?>            

                </div>

    
  