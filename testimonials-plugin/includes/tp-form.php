<?php
   add_shortcode('submit_form', 'submit_form');
   function submit_form() {
      save_testimonial();
      ?>
<div class="content-area">
   <h2><?php echo esc_html__("Add Testimonial", "testimonial-plugin"); ?></h2>
   <form method="post" enctype="multipart/form-data">
      <?php
         $title = get_option('title-checkbox');
            if ($title == true):
            ?>
      <div class="form-group">
         <label for="title"><?php echo esc_html__("Title:", "testimonial-plugin"); ?></label>
         <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <?php else:
         echo '';
         endif;
         $desc = get_option('desc-checkbox');
         if ($desc == true): ?>
      <div class="form-group">
         <label for="pwd"><?php echo esc_html__("Description:", "testimonial-plugin"); ?></label>
         <textarea class="form-control"  name="testimonialcontent" required></textarea>
      </div>
      <?php else:
         echo '';
         endif;
         
         $img = get_option('img-checkbox');
         if ($img == true): ?>
      <div class="form-group">
         <label for="title"><?php echo esc_html__("Image:", "testimonial-plugin"); ?></label>
         <input type="file" class="form-control" id="thumbnail" name="thumbnail">
      </div>
      <?php else:
         echo '';
         
         endif;?>
      <BR>
      <button type="submit" class="btn btn-default"><?php echo esc_html__("Submit", "testimonial-plugin"); ?></button>
   </form>
   <br>
</div>
<?php
   }
   ?>