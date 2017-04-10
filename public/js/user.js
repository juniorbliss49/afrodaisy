$(document).ready(function() {
	// body...
	$( "#show" ).click(function() {
  $( "#showit" ).toggle();
});
})
$( document ).ready(function() {
  $('select').change(function() {
    var user = $('form').serialize();
    var url = "/users/searchmodel";
    $('#data').empty('slow');
    $('#data').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
    $.get(
      url,
      {user : user
      },
      function(data) {
        $('#data').spin(false);
      	$('#data').html(data);
      });
  });
});
$( document ).ready(function() {
  $('.checkboxval').change(function() {
    var user = $('form').serialize();
    var url = "/users/searchmodel";
    $.get(
      url,
      {user : user
      },
      function(data) {
      	$('#data').html(data);
      });
  });
});
$( document ).ready(function() {
$('input[name="search"]').keyup(function() {
  var val = $('form').serialize();
  var url = "/users/searchmodeltext";
    $.get(
      url,
      {val : val
      },
      function(data) {
      	$('#data').html(data);
      });
});
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


