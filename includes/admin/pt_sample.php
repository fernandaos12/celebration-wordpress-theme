<?php
	
	
	add_action('init', 'posttype_sample');
	

	function posttype_sample(){

	  $ptLabelSing = 'exemplo';
	  $ptLabelPlur = 'exemplos';
	  $ptLabelSingUpper = ucfirst($ptLabelSing);
	  $ptLabelPlurUpper = ucfirst($ptLabelPlur);

	  $tags = array(
		
		'name' => _x($ptLabelPlurUpper, 'título do post type'),
		'singular_name' => _x($ptLabelSing, 'nome único do post type'),
		'add_new' => _x('Adicionar ' . $ptLabelSing, 'Tipo'),
		'add_new_item' => __('Adicionar ' . $ptLabelSing),
		'edit_item' => __('Editar'),
		'new_item' => __('Adicionar ' . $ptLabelSing),
		'view_item' => __('Ver'),
		'search_items' => __('Pesquisar por ' . $ptLabelPlur),
		'not_found' =>  __('Nenhum '. $ptLabelSing .' encontrado'),
		'not_found_in_trash' => __('Nenhum '. $ptLabelSing .' encontrado na lixeira'), 
		'parent_item_colon' => '',
		'choose_from_most_used' => __('Escolha entre os mais usados')

	  );
	  
	  $arguments = array(
		
		'labels' => $tags,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug'=> $ptLabelPlur),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_name' => $ptLabelPlurUpper,
		'menu_position' => 2,
		'menu_icon' => 'dashicons-groups',
		'supports' => array('')
		
		/* Tipos de suporte 
		'title' 'editor' 'author' 'thumbnail' 'excerpt' 'trackbacks' 'custom-fields' 'comments' 'revisions' 'page-attributes' 'post-formats' */
			  
	  ); 
	  
	  
	  //Metaboxes
	  
	  include("mb_sample.php");
	  	  
	  
	  //Taxonomias	  
	  
	  $taxConfig = array(
	  	
		'label'=>'Categorias',
		'hierarchical' => true
		
	  ); 
	  
	  
	  register_post_type('exemplo',$arguments);
	  //register_taxonomy('catexemplo','exemplo',$taxConfig);
	  	  
	  	  
	}
	
	

	//Colunas personalizadas
		
	add_filter('manage_edit-sample_columns', 'posttype_sample_edit');
	add_action('manage_posts_custom_column', 'posttype_sample_columns', 10, 2);
	
	function posttype_sample_edit($columns) {
		

		$new_column['cb'] 		= '<input type="checkbox" />'; 
		

		
		return $new_column;	
	
	}
	
		
	function posttype_sample_columns($column_name, $id) {
			
		
		
	
	
	}


?>