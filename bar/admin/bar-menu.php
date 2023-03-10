<?php
add_action('admin_menu', 'bar_menu');
function bar_menu()
{
    add_menu_page('Bar Menu', 'Bar Menu', 10, __FILE__, 'bar_menu_list');
}
add_action('admin_enqueue_scripts', 'mw_enqueue_color_picker');
function mw_enqueue_color_picker($hook_suffix)
{
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('my-script-handle', plugins_url('my-script.js', __FILE__), array('wp-color-picker'), false, true);
}
function popup_script()
{
    //wp_enqueue_script('scripts', plugins_url('/assets/js/myscript.js', __FILE__));
    wp_enqueue_style('bars_style', plugins_url('/css/style.css', __FILE__));
    wp_enqueue_script('script', plugins_url('/js/script.js', __FILE__));
}
add_action('wp_enqueue_scripts', 'popup_script');


function bar_menu_list()
{
?>
    <form method="post">
        <div class="card">
            <div class="card-header">
                Bar Menu
            </div>
            <div class="card-body">

                <!-------------Header and footer bar option ------>
                </br>
                <div class="bar_option">Select where you want to show bar</div>
                <select class="form-select" aria-label="Default select example" name="bOption">
                    <option selected value="1">Header</option>
                    <option value="2">Footer</option>
                </select>
                </br> </br>
                <!--------------- bar message---------------------------->
                <br />
                <div class="bar_message">
                    <label for="bar_message">Bar Message</label><br />
                    <input type="text" class="bar_message_heading" name="bMessage" placeholder="Enter bar message here">
                </div>
                <br />
                <!-- ------------------ bar font color-------------->
                <div class="bar__font_color ">
                    <label for="bar_color">Choose font color of bar</label>
                    </br>
                    <input type="text" value="#bada55" class="font_color_field" data-default-color="#effeff" name="fColor" />

                </div>
                <script>
                    jQuery(document).ready(function($) {
                        $('.font_color_field').wpColorPicker();
                    });
                </script>
                </br>

                <!-- ------------------ bar background color-------------->
                <div class="bar__back_color ">
                    <label for="bar_back-color">Choose background color of bar</label>
                    </br>
                    <input type="text" value="#50ccce" class="back_color_field" data-default-color="#effeff" name="bColor" />

                </div>
                <script>
                    jQuery(document).ready(function($) {
                        $('.back_color_field').wpColorPicker();
                    });
                </script>

                <!------------------------- Bar button ---------->
                <div class="bar_button">
                    <br />
                    <label for="bar_button_name">Enter button name</label>
                    <br />
                    <input type="text" class="bar_button_name" name="bName">

                    <br />
                    <label for="bar_button_url" class="bar_button_url">Enter button url</label>
                    <br />
                    <input type="url" class="bar_button_url" name="bUrl">
                </div>
                <br/>
                <!-- bar showing time -->
                <div class="bar_show">
                    <select class="bar_show_time" name="bShow">
                        <option selected value="1">Show always</option>
                        <option value="2">Show Once</option>
                    </select>
                </div>
                <br />

                <!-- close button -->
                <div class="bar_close">
                <input type="checkbox" name="bClose" checked>
                    <label for="bar_close">
                        UnCheck if you want to hide close button
                    </label>
                </div>
                <br/>
                <!-- saving button -->
                <input type="submit" value="submit" name="submit">
            </div>
        </div>
    </form>



    <!-- reteriving form data and generating bar -->
<?php
}

if (isset($_POST['submit'])) {
   
    $bOption = $_POST['bOption']; //getting form data
    $bMessage = $_POST['bMessage'];
    $fColor = $_POST['fColor'];
    $bColor = $_POST['bColor'];
    $bName = $_POST['bName'];
    $bUrl = $_POST['bUrl'];
    $bShow = $_POST['bShow'];
    if(!empty($_POST['bClose'])) { 
    $bClose=$_POST['bClose'];
    }

    //storing form data as an array to store in wp_options table.
    $bar_data = array(
        'bOption' => $bOption,
        'bMessage' => $bMessage,
        'fColor' => $fColor,
        'bColor' => $bColor,
        'bName' => $bName,
        'bUrl' => $bUrl,
        'bShow' => $bShow,
    );
    if(!empty($_POST['bClose'])) {
        $bar_data['bClose'] = $bClose;
     }
    update_option('insert_bar_data', $bar_data);
}




?>