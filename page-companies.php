<?php
	
	/* Template Name:  Interna - Realização*/

?>

<?php get_header(); ?>

				
				<?php

					global $lgr;
					global $post;
					
				?>
				
				<?php while ( have_posts() ) : the_post(); ?>


				<!-- Conteúdo -->
				<div class="col-md-10 col-xs-12 col-sm-12" id="lgr-content">
					
					
					<div id="lgr-internal">

						<div class="lgr-internal-title visible-xs visible-sm">

							<h1><?php the_title(); ?></h1>
							
						</div>
						
						<div class="lgr-internal-cover">
							<figure style="background:url(<?php echo $lgr->postThumbSrc(get_the_id()); ?>);"></figure>
						</div>

						<div class="lgr-internal-title-secondary visible-md visible-lg">

							<h6><?php the_title(); ?></h6>
							
						</div>

						<div class="lgr-internal-content">

							<?php the_content(); ?>

							<div class="row">
								<div class="col-md-12 col-xs-12 col-sm-12">
									<div class="col-md-3 col-md-offset-2 col-xs-12 col-sm-5 col-sm-offset-1">
										<div class="lgr-company">
											<?php

												$c1 = get_post(291);

											?>

											<h3><?php echo $c1->post_title; ?></h3>
											
											<div class="lgr-company-logo">
												<div class="lgr-company-box-1"><?php echo $c1->post_content;?></div>
											</div>

										</div>
									</div>
									<div class="col-md-6 col-xs-12 col-sm-5 col-sm-offset-1">

										<div class="lgr-company">
											<?php

												$c2 = get_post(289);

											?>

											<h3><?php echo $c2->post_title; ?></h3>
											<<div class="lgr-company-logo">
												<div class="lgr-company-box-2"><?php echo $c2->post_content;?></div>
											</div>

										</div>
										
									</div>
								</div>
							</div>
						
						</div> <!-- fim conteudo interno -->
						



					</div> <!-- fim internal -->


				</div>
			
			</div>


		<?php endwhile; ?>
	
<?php get_footer(); ?>