<script type="text/template" id="happyforms-form-steps-template">
	<nav class="nav-tab-wrapper">
		<a href="#" class="nav-tab<%= ( 'build' === happyForms.currentRoute ) ? ' nav-tab-active' : '' %>" data-step="build"><?php _e( 'Build', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		<a href="#" class="nav-tab<%= ( 'setup' === happyForms.currentRoute ) ? ' nav-tab-active' : '' %>" data-step="setup"><?php _e( 'Setup', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		<a href="#" class="nav-tab<%= ( 'email' === happyForms.currentRoute ) ? ' nav-tab-active' : '' %>" data-step="email"><?php _e( 'Email', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
		<a href="#" class="nav-tab<%= ( 'style' === happyForms.currentRoute ) ? ' nav-tab-active' : '' %>" data-step="style"><?php _e( 'Style', HAPPYFORMS_TEXT_DOMAIN ); ?></a>
	</nav>
</script>
