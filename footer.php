	
    <?php
    	
		global $lgr;
		global $themePath;
	
	?> 		


            <div class="row">
                
                <!-- Rodapé -->
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="lgr-footer">
                    
                    <div class="row">
                        <div class="col-md-10 col-md-offset-2">
                            <div class="col-md-9 col-lg-10  lgr-address">
                            <p>
                                
                                <?php 

                                    $a = get_post(167); 
                                    echo $a->post_content;

                                ?>

                            </p>
                            </div>
                            <div class="col-md-3 col-xs-12 col-lg-2 lgr-social">
                                <nav>
                                    <a href="https://www.facebook.com/celebrationville" target="_black"><i class="fa fa-facebook-square"></i></a>
                                    <!-- <a href="#"><i class="fa fa-twitter-square" target="_black"></i></a> -->
                                    <a href="http://instagram.com/celebrationville" target="_black"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.youtube.com/channel/UCx7JH9eQfwB2SajYwGTYqJg" target="_black"><i class="fa fa-youtube-play"></i></a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="lgr-copyright">
                    <p>
                        
                        <?php 

                            $m = get_post(169); 
                            echo $m->post_content;

                        ?>
                    </p>
                </div>
            </div>

        </div>
    </section>

        
        
        <!-- jQuery -->
		<script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_jquery.js"></script>
		
        <!-- Modernizr -->
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_modernizr.js"></script>

        <!-- Preloader -->
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_preloader.js"></script>
        
       	<!-- Menu Responsivo -->
		<script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_nav_resp.js"></script>
        
        <!-- jQuery Plugins -->
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_blockui.js"></script>
        <script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_validation_engine.js"></script>
		<script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_validation_engine_pt_br.js"></script>
        
        <!-- Bootstrap -->
		<script type="text/javascript" src="<?php echo $themePath; ?>/js/bootstrap.min.js"></script>
		
		<!-- Funções -->
		<script type="text/javascript" src="<?php echo $themePath; ?>/js/lgr_theme.js"></script>


        <!-- Google Analytics -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-56593085-1', 'auto');
          ga('send', 'pageview');
        </script>


   		<?php wp_footer(); ?>
   
   		


    </body>

</html>