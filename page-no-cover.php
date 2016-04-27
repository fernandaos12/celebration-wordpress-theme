<?php
	
	/* Template Name: Interna - Sem Capa */

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
						
						
						<div class="lgr-internal-title-secondary lgr-internal-title-no-cover visible-md visible-lg">

							<h6><?php the_title(); ?></h6>
							
						</div>

						<div class="lgr-internal-content">

							<?php the_content(); ?>
						
						</div> <!-- fim conteudo interno -->
						



					</div> <!-- fim internal -->


				</div>
			
			</div>


		<?php endwhile; ?>
	
<?php get_footer(); ?>