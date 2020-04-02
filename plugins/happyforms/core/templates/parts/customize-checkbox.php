<script type="text/template" id="customize-happyforms-checkbox-template">
	<?php include( happyforms_get_core_folder() . '/templates/customize-form-part-header.php' ); ?>
	<p>
		<label for="<%= instance.id %>_title"><?php _e( 'Label', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
		<input type="text" id="<%= instance.id %>_title" class="widefat title" value="<%= instance.label %>" data-bind="label" />
	</p>
	<p>
		<label for="<%= instance.id %>_label_placement"><?php _e( 'Label display', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
		<select id="<%= instance.id %>_label_placement" data-bind="label_placement">
			<option value="above"<%= (instance.label_placement == 'above') ? ' selected' : '' %>><?php _e( 'Above', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="below"<%= (instance.label_placement == 'below') ? ' selected' : '' %>><?php _e( 'Below', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="left"<%= (instance.label_placement == 'left') ? ' selected' : '' %>><?php _e( 'Left', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="hidden"<%= (instance.label_placement == 'hidden') ? ' selected' : '' %>><?php _e( 'Hidden', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
		</select>
	</p>
	<p>
		<label for="<%= instance.id %>_description"><?php _e( 'Description', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
		<textarea id="<%= instance.id %>_description" data-bind="description"><%= instance.description %></textarea>
	</p>
	<p class="happyforms-description-options" style="display: <%= (instance.description != '') ? 'block' : 'none' %>">
		<label for="<%= instance.id %>_description_mode"><?php _e( 'Description appearance', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
		<select id="<%= instance.id %>_description_mode" data-bind="description_mode">
			<option value=""><?php _e( 'Standard', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			<option value="tooltip"<%= (instance.description_mode == 'tooltip' || instance.tooltip_description ) ? ' selected' : '' %>><?php _e( 'Tooltip', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
		</select>
	</p>

	<?php do_action( 'happyforms_part_customize_checkbox_before_options' ); ?>

	<div class="options">
		<ul class="option-list"></ul>
		<h3><?php _e( 'Choices', HAPPYFORMS_TEXT_DOMAIN ); ?></h3>
		<p class="no-options description"><?php _e( 'No choices added yet. Add one by clicking <i>Add Choice</i> below.', HAPPYFORMS_TEXT_DOMAIN ); ?></p>
	</div>
	<div class="options-import">
		<h3><?php _e( 'Choices', HAPPYFORMS_TEXT_DOMAIN ); ?></h3>
		<textarea class="option-import-area" cols="30" rows="10" placeholder="<?php _e( 'Type or paste your choices here, adding each on a new line.' ); ?>"></textarea>
	</div>
	<p class="links mode-manual">
		<a href="#" class="button add-option"><?php _e( 'Add choice', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		<span class="centered">
			<a href="#" class="import-options"><?php _e( 'Or, bulk add choices', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		</span>
	</p>
	<p class="links mode-import">
		<a href="#" class="button import-option"><?php _e( 'Add choices', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		<span class="centered">
			<a href="#" class="add-options"><?php _e( 'Cancel', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		</span>
	</p>
	<p>
		<label>
			<input type="checkbox" class="checkbox" value="1" <% if ( instance.required ) { %>checked="checked"<% } %> data-bind="required" /> <?php _e( 'This is required', HAPPYFORMS_TEXT_DOMAIN ); ?>
		</label>
	</p>

	<?php do_action( 'happyforms_part_customize_checkbox_after_options' ); ?>

	<div class="happyforms-part-advanced-settings-wrap">
		<?php do_action( 'happyforms_part_customize_checkbox_before_advanced_options' ); ?>

		<p>
			<label>
				<input type="checkbox" class="checkbox" value="1" <% if ( instance.show_select_all ) { %>checked="checked"<% } %> data-bind="show_select_all" /> <?php _e( 'Add \'select all\' choice', HAPPYFORMS_TEXT_DOMAIN ); ?>
			</label>
		</p>
		<p>
			<label for="<%= instance.id %>_display_type"><?php _e( 'Choices display', 'happyforms-upgrade' ); ?></label>
			<select id="<%= instance.id %>_display_type" name="display_type" data-bind="display_type" class="widefat">
				<option value="inline"<%= (instance.display_type == 'inline') ? ' selected' : '' %>><?php _e( 'Horizontal', 'happyforms-upgrade' ); ?></option>
				<option value="block"<%= (instance.display_type == 'block') ? ' selected' : '' %>><?php _e( 'Vertical', 'happyforms-upgrade' ); ?></option>
			</select>
		</p>
		<p class="part-options-width-setting">
			<label for="<%= instance.id %>_options_width"><?php _e( 'Choices width', 'happyforms-upgrade' ); ?></label>
			<select id="<%= instance.id %>_options_width" name="options_width" data-bind="options_width" class="widefat">
				<option class="display-type--inline display-type--block" value="full"<%= (instance.options_width == 'full') ? ' selected' : '' %>><?php _e( 'Full', 'happyforms-upgrade' ); ?></option>
				<option class="display-type--inline" value="half" style="display: <%= ( instance.display_type == 'inline' ) ? 'block' : 'none' %>" <%= (instance.options_width == 'half') ? ' selected' : '' %>><?php _e( 'Half', 'happyforms-upgrade' ); ?></option>
				<option class="display-type--inline" value="third" style="display: <%= ( instance.display_type == 'inline' ) ? 'block' : 'none' %>" <%= (instance.options_width == 'third') ? ' selected' : '' %>><?php _e( 'Third', 'happyforms-upgrade' ); ?></option>
				<option class="display-type--inline" value="quarter" style="display: <%= ( instance.display_type == 'inline' ) ? 'block' : 'none' %>" <%= (instance.options_width == 'quarter') ? ' selected' : '' %>><?php _e( 'Quarter', 'happyforms-upgrade' ); ?></option>
				<option class="display-type--inline display-type--block" value="auto"<%= (instance.options_width == 'auto') ? ' selected' : '' %>><?php _e( 'Auto', 'happyforms-upgrade' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<%= instance.id %>_width"><?php _e( 'Width', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
			<select id="<%= instance.id %>_width" name="width" data-bind="width" class="widefat">
				<option value="full"<%= (instance.width == 'full') ? ' selected' : '' %>><?php _e( 'Full', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
				<option value="half"<%= (instance.width == 'half') ? ' selected' : '' %>><?php _e( 'Half', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
				<option value="third"<%= (instance.width == 'third') ? ' selected' : '' %>><?php _e( 'Third', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
				<option value="auto"<%= (instance.width == 'auto') ? ' selected' : '' %>><?php _e( 'Auto', HAPPYFORMS_TEXT_DOMAIN ); ?></option>
			</select>
		</p>
		<p class="width-options" style="display: none">
			<label>
				<input type="checkbox" class="checkbox apply-all-check" value="" /> <?php _e( 'Apply to all parts', HAPPYFORMS_TEXT_DOMAIN ); ?>
			</label>
		</p>

		<?php do_action( 'happyforms_part_customize_checkbox_after_advanced_options' ); ?>

		<p>
			<label for="<%= instance.id %>_css_class"><?php _e( 'CSS classes', HAPPYFORMS_TEXT_DOMAIN ); ?></label>
			<input type="text" id="<%= instance.id %>_css_class" class="widefat title" value="<%= instance.css_class %>" data-bind="css_class" />
		</p>
	</div>

	<div class="happyforms-part-logic-wrap">
		<div class="happyforms-logic-view">
			<?php happyforms_customize_part_logic(); ?>
		</div>
	</div>

	<?php happyforms_customize_part_footer(); ?>
</script>
<script type="text/template" id="customize-happyforms-checkbox-item-template">
	<li data-option-id="<%= id %>">
		<div class="happyforms-part-item-body">
			<div class="happyforms-part-item-handle"></div>
			<label>
				<?php _e( 'Label', HAPPYFORMS_TEXT_DOMAIN ); ?>:
				<input type="text" class="widefat" name="label" value="<%= label %>">
			</label>
			<div class="happyforms-part-item-advanced">
				<label>
					<input type="checkbox" name="is_default" value="1" <% if (is_default == 1) { %> checked="checked"<% } %>> <?php _e( 'Make this choice default', HAPPYFORMS_TEXT_DOMAIN ); ?>
				</label>
			</div>
			<div class="option-actions">
				<a href="#" class="delete-option"><?php _e( 'Delete', HAPPYFORMS_TEXT_DOMAIN ); ?></a> |
				<a href="#" class="advanced-option"><?php _e( 'More', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
			</div>
		</div>
	</li>
</script>
