$(document).ready(function() {
	// body...
	$('.firstName').keyup(function() {
		// body...
	var firstName = $(this).val();
	var lastName = $('.lastName').val();
	var displayName = firstName +' '+lastName;
	$('.displayName').val(displayName);
	})

})

$(document).ready(function() {
	// body...
	$('.lastName').keyup(function() {
		// body...
	var lastName = $(this).val();
	var firstName = $('.firstName').val();
	var displayName = firstName +' '+lastName;
	$('.displayName').val(displayName);
	})

})