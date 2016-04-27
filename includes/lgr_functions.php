<?php 
		
		
		//Ações
		
		add_action('admin_head','adminHeader');
		add_action('admin_head','customAdmin');
		add_action('wp_head','customAdminBar');
		add_action('login_head','customLogin');
		add_action('admin_menu', 'removeDashboardMenu');
		add_action('wp_dashboard_setup', 'removeDefaultDashboard');
		add_action('wp_before_admin_bar_render','removeWpLogoAdminBar');
		add_action( 'admin_enqueue_scripts', 'adminJS');
						
		//Suportes do tema
		
		add_theme_support("menus");
		add_theme_support("nav-menus");
		add_theme_support("post-thumbnails");					
		add_theme_support("automatic-feed-links");
		
		//Tipos de posts
		
		//include("pt_sample.php");
				
		//Shortcodes
		
		include("lgr_shortcodes.php");
		
		//Widgets
		
		include("lgr_widgets.php");

		//Internacionalização

		load_theme_textdomain( 'cmx', TEMPLATEPATH.'/lang' );
		$locale = get_locale();
		$locale_file = TEMPLATEPATH."/lang/$locale.php";
		if ( is_readable($locale_file) )
		require_once($locale_file);
		
		//Estilizar login
		
		function customLogin(){
			
			$themePath = get_bloginfo("template_directory");
			echo "<link rel='stylesheet' id='lgr-login'  href='". $themePath ."/css/lgr_admin.css' type='text/css' media='all'/>";	
			
		}
		
		//Estilizar admin css
		
		function customAdmin(){
			
			$themePath = get_bloginfo("template_directory");
			echo "<link rel='stylesheet' id='lgr-admin-css'  href='". $themePath ."/css/lgr_admin.css' type='text/css' media='all'/>";
			echo "<link rel='stylesheet' id='lgr-admin-css-font-awesome'  href='". $themePath ."/css/font-awesome.min.css' type='text/css' media='all'/>";
			
			
		}
		
		//Estilizar barra do admin
		
		function customAdminBar(){
			
			global $wp_admin_bar;
			
			if(is_user_logged_in()) {
			
				$style  = "background:url('".get_bloginfo('template_directory')."/img/admin/logo_admin_bar.png') no-repeat center center; ";
				$style .= "width:22px;  height:28px;";
							
				$wp_admin_bar->add_menu(array(
					
					'id'=>'wp-logo-gks',
					'href'=>get_bloginfo('url'),
					'title'=>'<div style="'. $style .'"></div>'
				
				));
			}
				
		}
		
		function removeWpLogoAdminBar(){
			
			global $wp_admin_bar;
    		$wp_admin_bar->remove_menu('wp-logo');
				
		}

		//Inserir Javascript

		function adminJS(){

			$themePath = get_bloginfo("template_directory");
			
			//Scripts do Wordpress
			wp_enqueue_script('jquery-ui-tooltip');
			wp_enqueue_script('jquery-ui-dialog');

			//Javascript do Ligre
			wp_enqueue_script('lgr_admin_js', $themePath . '/js/lgr_admin.js');

		}
		
		
		//Adicionar cabeçalho no admin
		
		function adminHeader(){
			
			echo '<div id="adminHeader"></div>';
			
		}
		
		//Remover dashboard padrão do Wordpress 
		
		function removeDefaultDashboard(){
			
			global $wp_meta_boxes;
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);	

		}
		
		//Remover menus laterais do dashboard padrão
		
		function removeDashboardMenu(){
			
			global $menu;
			
			$restrict = array();
			//__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'),
			// __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins')
			
			end($menu);
		
			while (prev($menu)){
				
				$value = explode(' ',$menu[key($menu)][0]);
				if(in_array($value[0] != NULL?$value[0]:"" , $restrict)){unset($menu[key($menu)]);}
			
			}
		}



		//Multiplos Thumbnails para páginas e posts.

		if (class_exists('MultiPostThumbnails')) {

			new MultiPostThumbnails(array(
				
				'label' => 'Imagem de apoio',
				'id' => 'img-apoio',
				'post_type' => 'page'
			 
			 ));

		}	
				
				
?>