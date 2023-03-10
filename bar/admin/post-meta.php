<?php
// creating custom meta field for each post page and custom post type
function bar_custom_field()
{
	$screens = ['post', 'page', 'wporg_cpt'];
	foreach ($screens as $screen) {
		add_meta_box(
			'wporg_box_id',                 // Unique ID
			'Custom Meta Box Title',      // Box title
			'bar_field',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
add_action('add_meta_boxes', 'bar_custom_field');

// creating input field for custom meta filed
function bar_field($post)
{
?>
	<label for="bar_field">Enter message for bar</label>
	<input type="text" name="bar_field">
<?php
}


//saving data to datbase of custom meta field
function bar_save_postdata($post_id)
{
	if (array_key_exists('bar_field', $_POST)) {
		update_post_meta(
			$post_id,
			'_wporg_meta_key',
			$_POST['bar_field']
		);
	}
}
add_action('save_post', 'bar_save_postdata');

// reteriving data of custom meta filed
?>
<?php
function wporg_custom_box_html()
{
	wp_reset_postdata(); //this is use for reseting post query; 
	$meta_field_value = get_post_meta(get_the_ID(), '_wporg_meta_key', true); //getting meta_field_value stored by metaField of each posts and pages.
	$get_bar_data = get_option('insert_bar_data');   //getting meta_field_values of bar form from option table

	// checking if there is session meta_field_value exists and if exists the removing it.
	if ($get_bar_data['bShow'] == "1") {
?>
		<script>
			sessionStorage.removeItem("alreadyshown");
		</script>
	<?php
	}
	if ($meta_field_value > 0)  //checking if there is any data on post meta table
	{
		//reteriving specifice data form database
	?>
		<script>
			var storage = sessionStorage.getItem("alreadyshown"); //reteriving sessionStorage meta_field_value
			if (storage != "already shown") {
				document.write(`
		<div class='fixed <?php echo ($get_bar_data['bOption'] == 1) ? "fixed-top" : "fixed-bottom" ?> '>

			
			<div class="container-fluid d-flex  justify-content-center align-items-center p-2 gap-3" style="background-color:<?= $get_bar_data['bColor'] ?>;">

				<p class="bar_heading h4" style="color:<?= $get_bar_data['fColor'] ?>;"><?= $meta_field_value ?></p> 
		
				<?php if ($get_bar_data['bName'] > 0) {
				?>
					<a class="bar_button btn btn-primary" href="<?= $get_bar_data['bUrl'] ?>" target="_blank"> <?= $get_bar_data['bName'] ?><a />
					<?php
				}
					?>

					<?php
					if ($get_bar_data['bShow'] == "1") {
						if (!empty($get_bar_data['bClose'])) {
							if ($get_bar_data['bClose'] == true) {
					?>
							<button type="button" class="btn-close" aria-label="Close" onclick="show_always();"></button>
							<?php
							}
						}
					} else {
						if (!empty($get_bar_data['bClose'])) {
							if ($get_bar_data['bClose'] == true) {
							?>
									<button type="button" class="btn-close" aria-label="Close" onclick="show_once();" ></button>
									
		<?php
							}
						}
					}
		?>
			</div>
		</div>
		`);
			}
		</script>
		<?php
	} else {
		if ($get_bar_data['bMessage'] > 0) //checking for the bar message.
		{
		?>
		<script>
				var storage = sessionStorage.getItem("alreadyshown");
				if (storage != "already shown") {
					document.write(`
			<div class='fixed <?php echo ($get_bar_data['bOption'] == 1) ? "fixed-top" : "fixed-bottom" ?> '>
				<!-- getting background color -->
				<div class="container-fluid d-flex  justify-content-center align-items-center p-2 gap-3" style="background-color:<?= $get_bar_data['bColor'] ?>;">
					<!-- gettting bar message -->
					<p class="bar_heading h4" style="color:<?= $get_bar_data['fColor'] ?>;"><?= $get_bar_data['bMessage'] ?></p>

					<!-- getting link button -->
					<?php if ($get_bar_data['bName'] > 0) {
					?>
						<a class="bar_button btn btn-primary" href="<?= $get_bar_data['bUrl'] ?>" target="_blank"> <?= $get_bar_data['bName'] ?><a />
						<?php
					}
						?>
						<!-- close buttton -->
						<?php
						if ($get_bar_data['bShow'] == "1") {
							if (!empty($get_bar_data['bClose'])) {
								if ($get_bar_data['bClose'] == true) {
						?>
									<button type="button" class="btn-close" aria-label="Close" onclick="show_always();"></button>
								<?php
								}
							}
						} else {
							if (!empty($get_bar_data['bClose'])) {
								if ($get_bar_data['bClose'] == true) {
								?>
									<button type="button" class="btn-close" aria-label="Close" onclick="show_once();"></button>
						<?php
								}
							}
						}
						?>
				</div>
			</div>
			`);
				}
			</script>
<?php
		}
	}
}
?>
<?php
add_action('wp_footer', 'wporg_custom_box_html');

?>