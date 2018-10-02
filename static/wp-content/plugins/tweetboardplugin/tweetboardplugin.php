<?php
/*
Plugin Name: Tweetboard Plugin
Plugin URI: http://tweetboard.com
Description: Official Tweetboard Plugin.
Version: 0.1
Author: Cezz - @140WARE
Author URI: http://140WARE.COM
*/
?>
<?php
/*  Copyright 2009  CERI MAY  (email : cezz@140ware.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php

// tb_options_page() displays the page content for the Tweetboard Options submenu
function tb_options_page() {

    // Current Plug-in Version
    $tb_plugin_ver = 0.1;

    // variables for the field and option names 
    $opt_name = 'tb_active_username';
    $hidden_field_name = 'tb_submit_hidden';
    $data_field_name = 'tb_new_username';
    $opt2_name = 'tb_active';
    $data2_field_name = 'tb_status';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    $opt2_val = get_option( $opt2_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
        $opt2_val = $_POST[ $data2_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
        update_option( $opt2_name, $opt2_val );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'tb_insert_plugin' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Tweetboard Insert Plugin Options', 'tb_insert_plugin' ) . "</h2>";

    // options form
    
    ?>
<iframe src ="http://cezz.co.uk/tb/wpPlugin/?ver=<?php echo $tb_plugin_ver; ?>" width="100%" height="30px" frameborder="0"></iframe>

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Tweetboard Active?:", 'tb_insert_plugin' ); ?> 
<input type="checkbox" name="<?php echo $data2_field_name; ?>" <?php if ($opt2_val){ echo 'checked'; } ?> >
</p>
<p><?php _e("Twitter Username:", 'tb_insert_plugin' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr/>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'tb_insert_plugin' ) ?>" />
</p>

</form>

</div>

<?php
 
}


// Insert Option Menu

function tb_add_options() {

//add_menu_page('Tweetboard', 'Tweetboard', 8, 'tweetboardoptions', 'tb_options_page');
add_submenu_page('plugins.php','Tweetboard', 'Tweetboard', 8, 'tweetboardoptions', 'tb_options_page');
}

add_action('admin_menu', 'tb_add_options');


// Actual script

if (get_option('tb_active') && get_option('tb_active_username') != '') {

add_action('wp_footer', 'insert_tweetboard');

function insert_tweetboard() {
  $tb_username = get_option(tb_active_username);
  $content = '<script src="http://tweetboard.com/tb.js?v=1.0&user=' . $tb_username . '" type="text/javascript"></script>';
  echo $content;
}

}

?>