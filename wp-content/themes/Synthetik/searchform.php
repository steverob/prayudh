<?php 
/** 
 * The Search Form 
 * 
 * Optional file that allows displaying a custom search form 
 * when the get_search_form() template tag is used.
 */ 
?> 

	<form id="searchform" name="searchform" method="get" action="<?php echo home_url(); ?>"> 
		<div> 
			<!--label for="s"><?php _e( 'Search', 'mav' ); ?></label-->
			<input type="text" tabindex="1" size="32" onblur="if (this.value == '') {this.value = 'To search, type and hit enter';}" onfocus="if (this.value == 'To search, type and hit enter') {this.value = '';}" value="To search, type and hit enter" name="s" id="s">
			<!--input type="submit" tabindex="2" value="<?php esc_attr_e( 'Search', 'mav' ); ?>" name="searchsubmit" id="searchsubmit"-->
		</div> 
	</form>