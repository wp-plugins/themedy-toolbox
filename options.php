<?php

add_action( 'admin_menu', 'themedy_add_admin_menu' );
add_action( 'admin_init', 'themedy_settings_init' );


function themedy_add_admin_menu(  ) { 

	add_submenu_page( 'tools.php', 'themedy-toolbox', 'Themedy ToolBox', 'manage_options', 'themedy-toolbox', 'themedy_toolbox_options_page' );

}


function themedy_settings_exist(  ) { 

	if( false == get_option( 'themedy-toolbox_settings' ) ) { 

		add_option( 'themedy-toolbox_settings' );

	}

}


function themedy_settings_init(  ) { 

	register_setting( 'pluginPage', 'themedy_settings' );

	add_settings_section(
		'themedy_pluginPage_section_custom_css', 
		__( 'Custom CSS', 'themedy' ), 
		'themedy_settings_section_callback_custom_css', 
		'pluginPage'
	);

	add_settings_section(
		'themedy_pluginPage_section', 
		__( 'Visual Designer Shortcode Compatibility', 'themedy' ), 
		'themedy_settings_section_callback', 
		'pluginPage'
	);



	add_settings_field( 
		'themedy_checkbox_field_0', 
		__( 'Enable Old Shortcodes', 'themedy' ), 
		'themedy_checkbox_field_0_render', 
		'pluginPage', 
		'themedy_pluginPage_section' 
	);

	add_settings_field( 
		'themedy_checkbox_field_1', 
		__( 'Enable Custom CSS  Module', 'themedy' ), 
		'themedy_checkbox_field_1_render', 
		'pluginPage', 
		'themedy_pluginPage_section_custom_css' 
	);
}


function themedy_checkbox_field_0_render(  ) { 

	$options = get_option( 'themedy_settings' );
	?>
	<input type='checkbox' name='themedy_settings[themedy_checkbox_field_0]' <?php if(isset($options['themedy_checkbox_field_0'])) {checked( $options['themedy_checkbox_field_0'], 1 );} ?> value='1'>

	<?php 

}

function themedy_checkbox_field_1_render(  ) { 
	$options = get_option( 'themedy_settings' );

	?>
	<input type='checkbox' name='themedy_settings[themedy_checkbox_field_1]' <?php if(isset($options['themedy_checkbox_field_1'])) {checked( $options['themedy_checkbox_field_1'], 1 );} ?> value='1'>

	<?php 

}

function themedy_settings_section_callback(  ) { 

	echo __( 'If you <strong>did not</strong> use our previous plugin "Themedy Visual Designer" you can ignore this. <br /><br />By checking the box below you can continue to use the shortcodes from our old Themedy Visual Designer Plugin. <br /><br />Please note that you will have to insert the old shortcodes <a href="http://help.themedy.com/General/Adding_Shortcodes">manually only.</a> <br /><br />These old shortcodes will not be supported or receive anymore updates so they may break in a later version of WordPress. <br />We highly recommend you use this time to migrate to our new Themedy ToolBox shortcodes on your sites. <br /><br />Once you have changed your old shortcodes you should disable this option again.', 'themedy' );

}

function themedy_settings_section_callback_custom_css(  ) { 

	echo __( 'If you have the JetPack or Slim JetPack plugins active our Custom CSS module will not activate. <br />Instead activate the Custom CSS modules included with those plugins.', 'themedy' );

}

function themedy_toolbox_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Themedy ToolBox Options</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}
