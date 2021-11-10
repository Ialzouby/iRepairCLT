<?php

/**

 * The template for displaying all single posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post

 *

 * @package braintech

 */



get_header(); ?>

</div>

<!-- Main content Start -->



<div class="main-content"> 

  

<!-- Portfolio Detail Start -->

<div class="rs-porfolio-details">

    <div class="container">

    	<div class="row">

    		<div class="col-lg-4">

    			<ul class="information-sidebar">

                    <?php dynamic_sidebar('service-1'); ?>

                </ul>  

    		</div>

    		<div class="col-lg-8 services-des-content">

    			    <?php if(has_post_thumbnail()){ ?>

                      <div class="project-img"><?php the_post_thumbnail(); ?></div>

                    <?php  } 

		            while ( have_posts() ) : the_post(); ?>

		              <?php the_content(); ?>

		            <?php endwhile; ?>

		    </div>

    	</div>

    </div>

  </div>

<!-- Portfolio Detail End -->

<?php

get_footer();