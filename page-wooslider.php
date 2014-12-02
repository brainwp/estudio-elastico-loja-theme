<?php
/*
Template Name: WooCommerce com slider
*/
?>

<?php get_header(); ?>

<div class="page_with_slider">
<div class="main-slider-fullscreen fixed-height">

    <div class="main-slider">
        <div class="swiper-container" data-settings="">
            
            <div class="swiper-wrapper">
                <?php
                // WP_Query arguments
                $args = array (
                	'post_type'              => 'product',
                	'pagination'             => false,
	                'posts_per_page'         => '5',
	                'orderby'                => 'rand',
                );

                // The Query
                $query_slider = new WP_Query($args);
                ?>
                <?php
				while($query_slider->have_posts())
				{ 
					$query_slider->the_post();
				?>
                    <?php 
                    $bg = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full', false );
                    $bg = 'background-image:url('.$bg[0].');';
                    ?>
                    <div class="swiper-slide" style="<?php echo $bg; ?>">
                        
                        <div class="main-slider-content">
                            <div class="row">
                                <div class="large-8 large-centered medium-10 medium-centered columns">
                                    <div class="main-slider-elements">
                                        <?php if (get_the_title()) { ?>
                                            <h1><?php echo get_the_title() . "<br />"; ?></h1>
                                        <?php } ?>
                                        <?php if (get_the_content()) { ?>
                                            <h2><?php echo the_excerpt() . "<br />"; ?></h2>
                                        <?php } ?>
                                        <?php if (get_the_permalink()) { ?>
                                            <a class="slider_button" href="<?php the_permalink(); ?>">Leia mais</a> 
                                        <?php } ?>
                                    </div><!-- .main-slider-elements -->
                                </div><!-- .columns -->
                            </div><!-- .row --> 
                        </div>
                        
                        <a class="arrow-left" href="#"></a>
            			<a class="arrow-right" href="#"></a>		              
                    
                    </div>
                    
                <?php    
                }
                wp_reset_postdata();	
                ?>
                
            </div>
            
            <div class="pagination"></div>
            
        </div>
    </div>

</div>

<script>
jQuery(document).ready(function($) {
	
	var slider_2 = $('.main-slider .swiper-container').swiper({
		pagination: '.pagination',
    	paginationClickable: true,
		calculateHeight: true,
		resizeReInit: true,
		resistance: '100%',
		<?php if ($slider_metabox->get_the_value('slider_autoplay') == 1) { ?>
		autoplay: <?php echo $slider_metabox->get_the_value('slider_autoplay_delay') == "" ? 5000 : $slider_metabox->get_the_value('slider_autoplay_delay'); ?>,
		<?php } ?>
		onSwiperCreated : function() {
			$('.main-slider .swiper-container').css('visibility', 'visible');
			$('.swiper-slide-active .main-slider-elements').addClass('animated');
		},
		onSlideChangeStart : function() {			
			$('.main-slider .arrow-left, .main-slider .arrow-right').addClass('hidden');
			$('.main-slider-elements').removeClass('animated');
		},
		onSlideChangeEnd : function() {			
			$('.main-slider .arrow-left, .main-slider .arrow-right').removeClass('hidden');	
			$('.swiper-slide-active .main-slider-elements').addClass('animated');
		}
	});
	
	$('.arrow-left').on('click', function(e){
		e.preventDefault()
		slider_2.swipePrev()
	});
	
	$('.arrow-right').on('click', function(e){
		e.preventDefault()
		slider_2.swipeNext()
	});
	
});
</script>

    <?php if ($post->post_content != "") : ?>
    
    <div id="primary" class="content-area">
       
        <div id="content" class="site-content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

            	<?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
    <?php endif; ?>
    
</div>
    
<?php get_footer(); ?>
