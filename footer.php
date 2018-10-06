<footer>
   <hr width="90%" color="pink">
               <div class="footer">
                     <div class="contactgegevens">
                        <h2>Sara van der Velden</h2>
                        <ul>
                           <li><a href="<?php echo site_url("/contact") ?>">info@saarbakt.nl</li></a>
                        </ul>
                     </div>

                     <div class="footerlinks">
                        <ul>
                           <h2>Links</h2>
                           <?php wp_nav_menu( array( 'container_class' => 'main-nav', 'theme_location' => 'footerMenuLocation' ) ); ?>
                        </ul>
                     </div>

                     <div class="socialmediafooter">
                        <h2>Social Media</h2>
                        <div class="iconflexbox">
                        <div class="instagramicon"><a href="https://instagram.com/saarbakt"><i class="fab fa-instagram"></i></a></div>
                     </div>
                     </div>
                  </div>
               </footer>
			   	<div class="search-overlay no-display">
				    <div class="search-overlay__top">
				      	<div class="search-container-balk">
					      	<i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
					      	<input class="search-term" placeholder="Waar ben je naar op zoek?" id="search-term" name="searchfield" type="text">
				        	<span id="search-close"><i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i></span>
				    	</div>
					<div class="search-container">
			  	<div id="search-overlay__results"></div>
			</div>
		</div>
	</div>
</div> <!-- page wrapper end -->
         <?php wp_footer(); ?>
         </body>
      </html>
