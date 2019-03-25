<?php
   //add_action('admin_menu', 'testimonial_settings_page');
   function testimonial_settings_page() {
   	add_settings_section("section", "Testimonial Settings", null, "testimonial");
   	add_settings_section("section", "Shortcodes Settings", null, "shortcodes");
   	add_settings_field("title-checkbox", "Enable Title", "showtitle", "testimonial", "section");
   	add_settings_field("desc-checkbox", "Enable Description", "description", "testimonial", "section");
   	add_settings_field("img-checkbox", "Show Image", "featureimg", "testimonial", "section");
   	add_settings_field("posts_per_page", "Post Per Page", "mycustom_testimonial", "testimonial", "section");
   	register_setting("section", "title-checkbox");
   	register_setting("section", "desc-checkbox");
   	register_setting("section", "img-checkbox");
   	register_setting("section", "posts_per_page");

   }
   
   function showtitle() {
   	?>
      <label class="switch">
         <input type="checkbox" name="title-checkbox" value="1" <?php checked(1, get_option('title-checkbox'), true);?> />
         <span class="slider"></span>
      </label>
<?php
   }
   function description() {
   
   	?>
<label class="switch">
<input type="checkbox" name="desc-checkbox" value="1" <?php checked(1, get_option('desc-checkbox'), true);?> />
<span class="slider"></span>
<?php
   }
   function featureimg() {
   
   	?>
<label class="switch">
<input type="checkbox" name="img-checkbox" value="1" <?php checked(1, get_option('img-checkbox'), true);?> />
<span class="slider"></span>
<?php
   }
   
   function mycustom_testimonial() {
   	$view = get_option('posts_per_page');
   
   	?>
<input type="number" name="posts_per_page" style="width:60px;" value="<?php echo $view; ?>">
<?php
   }
   add_action("admin_init", "testimonial_settings_page");
   
   function testimonial_page() {
   
   	?>
<div class="wrap">
   <form method="post" action="options.php">
      <?php
         settings_fields("section");
         	do_settings_sections("testimonial");
         	submit_button();
      ?>
   </form>
</div>
<?php
   }
   function shortcodes_page() {
   
   	?>
<div class="wrap">
   <form method="post" action="options.php">
      <?php
         settings_fields("section");
         	do_settings_sections("shortcodes");
         	// submit_button();
         	?>
      Insert shortcode in your pages,posts,widgets or custom post type posts.<br><br>
      Display form frontend         <strong style="margin-left: 10px">[submit_form]</strong> <br><br>
      Display Testimonials <strong style="margin-left: 20px"> [testimonials]</strong><br><br>
   </form>
</div>
<?php
}
function tp_sub_menu() {
add_submenu_page("edit.php?post_type=testimonial", "Testimonials Setting", "Settings", "manage_options", "testimonial", "testimonial_page");
}
add_action("admin_menu", "tp_sub_menu");

function tp_shortcodes() {
add_submenu_page("edit.php?post_type=testimonial", "Shortcodes Pages/Posts", "Shortcodes", "manage_options", "shortcodes", "shortcodes_page");
}
add_action("admin_menu", "tp_shortcodes");
