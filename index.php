<?php get_header(); ?>



	<?php

		global $lgr;
		global $themePath;

	?>


				
				<!-- Conteúdo -->
				<div class="col-md-10 col-xs-12 col-sm-12" id="lgr-content">
					
					<!-- Slide --> 
					<div class="lgr-home-slide">


						<div id="lgr-home-carousel" class="carousel slide" data-ride="carousel">
						 

						 <?php

						 	// The Query
							$features = new WP_Query(array('category_name' => 'destaques', 'orderby'=> 'date', 'order'=>'DESC', 'posts_per_page' => 4 ));
							$row = 1;

						 ?>


						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    

						    <?php

						    	while($features->have_posts()):$features->the_post();

						    		$bull = 0;
						    		
						    		if($row == 0){
						    			
						    			echo '<li data-target="lgr-home-carousel" data-slide-to="'. $bull .'" class="active"></li>';
						    		
						    		}else{

						    			echo '<li data-target="lgr-home-carousel" data-slide-to="'. $bull .'"></li>';

						    		}

						    		$bull++;

						    	endwhile;

						    ?>
						    
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
						    
						    
							<?php 

					    		while($features->have_posts()):$features->the_post();
									
									if($row == 1){

										echo '<div class="active item">';
									
									}else{

										echo '<div class="item">';
									}
					    			
									if(empty($post->post_excerpt)){
										
										echo '<div style="background: url('. $lgr->postThumbSrc(get_the_id()) .')">';
						      			echo '</div>';										
					    			
									}else{

										echo '<div style="background: url('. $lgr->postThumbSrc(get_the_id()) .')">';
						      			echo '<a href="'. $post->post_excerpt .'" alt="'. get_the_title() .'">'. $post_title .'</a>';
						      			echo '</div>';

									}

					    			echo '</div>';
					    			$row++;

								endwhile;
								wp_reset_query();

					    	?>

						  
						  </div>

						  <!-- Controls -->
						  <a class="left carousel-control" href="#lgr-home-carousel" role="button" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left"></span>
						    <span class="sr-only">Anterior</span>
						  </a>
						  <a class="right carousel-control" href="#lgr-home-carousel" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						    <span class="sr-only">Próximo</span>
						  </a>
						</div>


						
					</div>
					<!-- Fim do Slide -->


					<!-- Video e Newsletter -->
					<div class="lgr-video-news">
						
						<div class="row">
							
							<div class="col-md-9 col-xs-12 col-sm-12">
								<div class="row">
									
									<div class="col-md-7 col-xs-12 col-sm-12">
										<h3>Conheça um novo mundo para chamar de seu.</h3>
									</div>
									<div class="col-md-5 col-xs-12 col-sm-12">
										<div class="lgr-video">
											<iframe src="//www.youtube.com/embed/TzSFiiV341k" frameborder="0" allowfullscreen></iframe>
												
										</div>
									</div>
								
								</div>
							</div>
							<div class="col-md-3 col-xs-12 col-sm-12">
								
								<div class="lgr-newsletter">
									
									<h2>Cadastre-se em nossa newsletter</h2>
									<!-- Inicio do formulario -->
									
									<form role="form">
									  <div class="form-group">
									    <input type="text" class="form-control validate[required]" id="txtName" placeholder="Seu nome">
									  </div>
									  <div class="form-group">
									    <input type="text" class="form-control validate[required,custom[email]]" id="txtMail" placeholder="Seu email">
									  </div>
									  <input type="submit" value="Enviar" id="btnSubscribeSubmit" class="btn btn-primary btn-send">
									</form>

									<!-- Fim do formulario -->
								
								</div>

							</div>

						</div>


					</div>

				</div>
			
			</div>
	
	
<?php get_footer(); ?>