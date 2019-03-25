<?php
   add_shortcode('testimonials', 'display_testimonials');
   function display_testimonials() {
   	?>
<?php 
$count = get_option('posts_per_page');
   $args = array(
   	'post_type'      => 'testimonial',
   	'post_status'    => 'publish',
   	'posts_per_page' => $count,
   );
   $data = new WP_Query($args);
   if ($data->have_posts()): 
   	while ($data->have_posts()): $data->the_post();?>
   <div class="col-md-6">
	    <div class="title">
	   	    <a href="<?php the_permalink();?>">
	   		<?php the_title();?>	
	   		</a>
	   	</div>
   <div class="thumbnail">
   	<?php the_post_thumbnail('medium');?>
   </div>
   <div class="content">
   	  <?php the_content();?>
   </div
<?php endwhile;
   wp_reset_postdata();
    endif;?>
<?php
   }
   ?>