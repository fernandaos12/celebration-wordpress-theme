<?php
	
	//Classe Ligre Functions
	//Nesta Classe iremos encontrar as principais funções para interação 
	//com os plugins e funções gerais de apoio ao desenvolvimento.

	class ligreFunctions{
		
			
			//Variáveis
			var $idPost;
			var $shortCode;
			var $dateTimeSince;
			var $userID;
			var $includesSrc;
					
			
			//Função construtora
			function _construct($idPost,$shortCode,$dateTimeSince, $userID, $includesSrc){
				
				$this -> idPost;
				$this -> shortCode;
				$this -> dateTimeSince;
				$this -> userID;
				$this -> includesSrc;
				
			}

			// -----------------------------------------------------------------------------------------------------------			
			// ENDEREÇOS GLOBAIS
			// -----------------------------------------------------------------------------------------------------------
			
			function includesSrc($includesSrc=''){
				
				$themeSrc =  get_template_directory();				
				$arrNum	 =  count($includesSrc);
				
				if(!empty($includesSrc)){
					
					while ($arrNum --){
						
						set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc ."/".$includesSrc[$arrNum]);
							
					}
					
				}			
								
				
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/includes");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/includes/classes");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/includes/admin");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/css");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/css/less");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/img");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/js");
				set_include_path(get_include_path().PATH_SEPARATOR.$themeSrc."/lang");
				
				
													
			}
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// COMPILADOR DE ARQUIVOS LESS
			//---------------------------------------------------------------------------------------------------------------------


			// //Less
			
			// $lgr->cleanCacheLess();
			// $lgr->compiLess("lgr_style.less","lgr_style.css");
			// $lgr->compiLess("lgr_ie7.less","lgr_ie7.css");
			// $lgr->compiLess("lgr_ie8.less","lgr_ie8.css");
			// $lgr->compiLess("lgr_ie9.less","lgr_ie9.css");
			
			// //Less Admin
			
			// $lgr->compiLess("lgr_admin.less","lgr_admin.css");			 
			
			
			// --------------------------------------------------------------------------------------------------------------------
			
			function compiLess($lessFile, $cssFile, $localFile='theme') {
    			
				
				global $lgr;
				$themeName = $lgr->themeName();
				
				//echo $themeName;			
				//die();			
				
				$lessFile =  "wp-content/themes/". $themeName ."/css/less/" . $lessFile;
				$cssFile  = 	"wp-content/themes/". $themeName ."/css/" . $cssFile;			
				
				
				// Criando arquivo em cache
				$cacheFile = $lessFile.".cache";
				
				if (file_exists($cacheFile)) {
				
					$cache = unserialize(file_get_contents($cacheFile));
					
				} else {
				
					$cache = $lessFile;
				}
				
				$lss = new lessc;
				$lss->setFormatter("compressed");
				$newCache = $lss->cachedCompile($cache);
				
				if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
				
					file_put_contents($cacheFile, serialize($newCache));
					file_put_contents($cssFile, $newCache['compiled']);
				
				}

			}
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// LIMPAR CACHE DE ARQUIVOS LESS
			// --------------------------------------------------------------------------------------------------------------------
			
			function cleanCacheLess(){
				
				global $lgr;
				
				$lessPath   = "wp-content/themes/". $lgr->themeName() ."/css/less/" ;
   				$directory = dir($lessPath);
								
					
				while($pathFile = $directory -> read()){
					
					if($lgr->strDir($pathFile,6) == ".cache"){
					 	
					 unlink($lessPath . $pathFile);
						
					}										
					
				}
				
				$directory -> close();
		
				
			}
			
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// NOME DO TEMA
			// --------------------------------------------------------------------------------------------------------------------
			
			function themeName(){
				
				$wpDir   = get_bloginfo('stylesheet_directory') . "/"; 
				$themeSrc   = '/themes/';
				$themePos   = strpos($wpDir,$themeSrc);
				$themeName  = substr($wpDir,$themePos,1000);
				$themeName  = split("[//]",$themeName);
				$themeName  = $themeName[2];
				
				return $themeName;
					
				
			}
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// DIRETÓRIO DO TEMA
			// --------------------------------------------------------------------------------------------------------------------
			
			function themePath($folder="",$mode="localhost"){
				
				
				global $lgr;
				
				if(empty($folder)){
					
					$folder = "ligre";
						
				}				
				
				
				switch($mode){
					
					case 'localhost':
						
						$dir = "http://localhost/". $folder ."/wp-content/themes/" . $lgr->themeName();
						
					break;	
					
					case 'theme':
						
						$dir = get_bloginfo("template_directory");
				
					
					break;
					
					case 'wp':
						
						$dir = get_bloginfo("wpurl");
					
					break;	
					
				}
				
				return $dir;
					
				
			}
			



			// --------------------------------------------------------------------------------------------------------------------			
			// VIEWS DO POST
			// --------------------------------------------------------------------------------------------------------------------


			function addPostView($idPost){

				$count_key = 'post_views';
		        $count = get_post_meta($idPost, $count_key, true);
		        
		        if($count==''){
		            $count = 0;
		            delete_post_meta($idPost, $count_key);
		            add_post_meta($idPost, $count_key, '0');
		        }else{
		            $count++;
		            update_post_meta($idPost, $count_key, $count);
		        }

		        return true;
			}


			function getPostView($idPost,$noViewTag="Sem Visualização",$singularTag = "visualização",$pluralTag="visualizações"){

				$count_key = 'post_views';
			    $count = get_post_meta($idPost, $count_key, true);
			    
			    if($count==''){
			        delete_post_meta($idPost, $count_key);
			        add_post_meta($idPost, $count_key, '0');
			        return $noViewTag;
			    }

			    if ($count == 0) {
			    	
			    	return $count ." ". $noViewTag;
			    }

			    if ($count == 1) {
			    	
			    	return $count ." ". $singularTag;
			    }

			    if ($count > 1) {
			    	
			    	return $count ." ". $pluralTag;
			    }
			    

			}


			function queryPostView($nPosts = 5, $order = "DESC"){

				return new WP_Query( array( 'posts_per_page' => $nPosts, 'meta_key' => 'post_views', 'orderby' => 'meta_value_num', 'order' => $order ));
			
			}



			
			// -----------------------------------------------------------------------------------------------------------			
			// SHORTCODES
			// -----------------------------------------------------------------------------------------------------------
			
			function shortCode($shortCode,$mode=''){
		
				$num = rand(0,100);
				
				if($mode == 1){
					
					${"var".$num} = $shortCode;
					
				}else{
					
					${"var".$num} = '['.$shortCode.']';	
					
				}
				${"var".$num} = apply_filters('the_content', ${"var".$num});
				echo ${"var".$num};
		
			}
			
			
			// -----------------------------------------------------------------------------------------------------------			
			// TIMESINCE
			// -----------------------------------------------------------------------------------------------------------

			function timeSince($dateTimeSince){
			
				if (function_exists("time_since")) {
			
					return time_since(abs(strtotime($dateTimeSince . "GMT")), time()) . " atr&aacute;s.";
				
				} else {
			
					return get_the_time("d/m/Y");
				
				} 
						
			} 
			
			function time_since($older_date, $newer_date = false){
				
				// array of time period chunks
				$chunks = array(
				array(60 * 60 * 24 * 365 , 'ano'),
				array(60 * 60 * 24 * 30 , 'm&ecirc;s'),
				array(60 * 60 * 24 * 7, 'semana'),
				array(60 * 60 * 24 , 'dia'),
				array(60 * 60 , 'hora'),
				array(60 , 'minuto'),
				);
			
				// $newer_date will equal false if we want to know the time elapsed between a date and the current time
				// $newer_date will have a value if we want to work out time elapsed between two known dates
				$newer_date = ($newer_date == false) ? (time()+(60*60*get_settings("gmt_offset"))) : $newer_date;
			
				// difference in seconds
				$since = $newer_date - $older_date;
				
				// we only want to output two chunks of time here, eg:
				// x years, xx months
				// x days, xx hours
				// so there's only two bits of calculation below:
			
				// step one: the first chunk
				for ($i = 0, $j = count($chunks); $i < $j; $i++){
				
				$seconds = $chunks[$i][0];
				$name = $chunks[$i][1];
				
				// finding the biggest chunk (if the chunk fits, break)
				if (($count = floor($since / $seconds)) != 0) {
				break;
				}
			} 
			
				// set output var
				$output = ($count == 1) ? '1 '.$name : "$count {$name}s";
			
				// step two: the second chunk
				if ($i + 1 < $j){
					
					$seconds2 = $chunks[$i + 1][0];
					$name2 = $chunks[$i + 1][1];
			
				if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0){
				
					// add to output var
					$output .= ($count2 == 1) ? ', 1 '.$name2 : " e $count2 {$name2}s";
				
				}
			}
			
			return $output;
			
			}
			
			
			
			// -----------------------------------------------------------------------------------------------------------			
			// THUMBNAILS 
			// -----------------------------------------------------------------------------------------------------------
			
			function postThumbSrc($idPost){
			
				
				$thumb = get_the_post_thumbnail($idPost);
				$pattern= "/(?<=src=['|\"])[^'|\"]*?(?=['|\"])/i";
				preg_match($pattern, $thumb, $thePath);
				$theSrc = $thePath[0];
					
				return $theSrc;
				
				
			}
			
			// -----------------------------------------------------------------------------------------------------------			
			// AVATARES 
			// -----------------------------------------------------------------------------------------------------------
			
			function avatarSrc($userID){
			
				$thumb = get_avatar($userID);	
				$pattern= "/(?<=src=['|\"])[^'|\"]*?(?=['|\"])/i";
				preg_match($pattern, $thumb, $thePath);
				$theSrc = $thePath[0];
					
				return $theSrc;
				
				
			}
			
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// REMOÇÃO DE ACENTOS E CARACTERES ESPECIAIS DE UMA STRING
			// --------------------------------------------------------------------------------------------------------------------
			
			function noAccents($string,$charset) {
			
				$accents = array(

					'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
					'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
					'C' => '/&Ccedil;/',
					'c' => '/&ccedil;/',
					'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
					'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
					'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
					'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
					'N' => '/&Ntilde;/',
					'n' => '/&ntilde;/',
					'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
					'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
					'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
					'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
					'Y' => '/&Yacute;/',
					'y' => '/&yacute;|&yuml;/',
					'a.' => '/&ordf;/',
					'o.' => '/&ordm;/'
				
				);

    			
				return preg_replace($accents, array_keys($accents), htmlentities($string,ENT_NOQUOTES, $charset));

			}
			
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// RETORNAR STRING COMO CAMEL CASE
			// --------------------------------------------------------------------------------------------------------------------
			
			function camelCase($string){
				
				 $cc = new ligreFunctions();
				 				 
				 $stringCamel = $cc->noAccents(ucwords($string),get_bloginfo('charset'));
				 $stringCamel = str_replace (" ", "",$stringCamel);
				 $noCan 	  = array('?','!','_');	
				 $stringCamel = str_replace ($noCan,"",$stringCamel);
				 				
				 return $stringCamel;
				
			}
			
			
			
			// --------------------------------------------------------------------------------------------------------------------			
			// MANIPULAÇÃO DE STRINGS - LEFT E RIGHT
			// --------------------------------------------------------------------------------------------------------------------
			
			function strDir($str, $n){
    		
				return substr($str, ($n*-1));
			}

			function strEsc($str, $n){
    			
				return substr($str, 0, $n);
			}
			
			
			
			
			
	
	} // fim class ligreFunctions 
	
	global $lgr;
	$lgr = new ligreFunctions();
	
?>