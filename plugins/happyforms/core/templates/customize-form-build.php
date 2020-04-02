<script type="text/template" id="happyforms-form-build-template">
	<div class="happyforms-stack-view">
		<div class="customize-control">
			<label for="" class="customize-control-title"><?php _e( 'Title', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
			<input type="text" name="post_title" value="<%= post_title %>" id="happyforms-form-name" placeholder="<?php _e( 'Add title', HAPPYFORMS_TEXT_DOMAIN ); ?>">
		</div>

		<div class="customize-control">
			<div class="happyforms-parts-placeholder">
				<p><?php _e( 'Add parts here to appear in your form.', HAPPYFORMS_TEXT_DOMAIN ); ?></p>
			</div>
			<div class="happyforms-form-widgets"></div>
			<button type="button" class="button add-new-widget happyforms-add-new-part"><?php _e( 'Add a Part', HAPPYFORMS_TEXT_DOMAIN ); ?></button>
		</div>
	</div>
</script>
