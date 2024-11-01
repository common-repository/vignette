<div class="wrap">
	<?php
    print '<h2>'. __('Vignette options', 'vignette') .'</h2>';
    
	if(!empty($_POST['vignette_submit']) && ($_POST['vig_css_ver'] == 'css2' || $_POST['vig_css_ver'] == 'css3') && !empty($_POST['vig_opacity']) && !empty($_POST['vig_size'])) {
		update_option('vignette_css_ver', $_POST['vig_css_ver']);
		update_option('vignette_opacity', $_POST['vig_opacity']);
		update_option('vignette_size', $_POST['vig_size']);
		
		_e('<div class="updated"><p><strong>Options saved.</strong></p></div>');
	}
	
    $css_ver = get_option('vignette_css_ver');
	$opacity = get_option('vignette_opacity');
	$size = get_option('vignette_size');
	
	$css_ver_options = array(
		NULL,
		NULL
	);
	
	$size_options = array(
		NULL,
		NULL,
		NULL
	);
    
    if($css_ver == 'css2') {
    	$css_ver_options[0] = ' selected="selected"';
    } else if($css_ver == 'css3') {
        $css_ver_options[1] = ' selected="selected"';
    }
	
	if($size == 'small') {
		$size_options[0] = ' selected="selected"';
	} else if($size == 'medium') {
		$size_options[1] = ' selected="selected"';
	} else if($size == 'large') {
		$size_options[2] = ' selected="selected"';
	}
    ?>
    
    <p>Please note: the vignette is an overlay over the background. If it would cover any other element, such as buttons, the element would be unusable.</p>
    
    <h3>Settings</h3>
    <form name="vignette_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <table class="form-table">
    	<tr valign="top">
        	<th scope="row"><label for="vig_css_ver"><?php _e('CSS version: '); ?></label></th>
            <td><select name="vig_css_ver">
                <option value="css2"<?php _e($css_ver_options[0]); ?>>CSS2</option>
                <option value="css3"<?php _e($css_ver_options[1]); ?>>CSS3</option>
            </select>
            <span class="description">The CSS version. CSS3 is tidier, but not all browsers support CSS3 yet so naturally I advice the usage of CSS2</span></td>
        </tr><tr valign="top">
        	<th scope="row"><label for="vig_css_ver"><?php _e('Opacity: '); ?></label></th>
            <td><select name="vig_opacity">
				<?php for($i = 1; $i <= 10; $i++): ?>
                <option value="<?php print $i ?>"<?php if($opacity == $i) print ' selected="selected"' ?>><?php print $i.'0' ?></option>
                <?php endfor; ?>
            </select>
            <span class="description">The &quot;darkness&quot;</span></td>
        </tr><tr valign="top">
        	<th scope="row"><label for="vig_size"><?php _e('Size: '); ?></label></th>
            <td><select name="vig_size">
				<option value="small"<?php _e($size_options[0]); ?>>Small</option>
                <option value="medium"<?php _e($size_options[1]); ?>>Medium</option>
                <option value="large"<?php _e($size_options[2]); ?>>Large</option>
            </select>
        </tr>
    </table>
    
    <p class="submit"><input type="submit" name="vignette_submit" class="button-primary" value="Save changes" /></p>
    </form>
    
    <p><i>Written by Tim Severien (<a href="http://www.timseverien.nl" target="_blank">blog</a>)</i></p>
</div>