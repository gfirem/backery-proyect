var bakeryInstance = {
	addFormatter: function(input, prefix) {
		let oldValue = input.value;

		const handleInput = event => {
			input.value = prefix + ' ' + input.value;

			oldValue = input.value;
		};

		handleInput();
		input.change(handleInput);
	},
	regexPrefix: function(regex, prefix) {
		return (newValue, oldValue) => regex.test(newValue) ? newValue : (newValue ? oldValue : prefix);
	},
	init: function() {
		const input = jQuery('.bakery-price');
		if (input && input.length > 0) {
			this.addFormatter(input, '$');
		}
	},
};

jQuery(document).ready(function() {
	// bakeryInstance.init();
});
