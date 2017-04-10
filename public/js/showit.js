 $( document ).ready(function() {
  $('.fol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var url = "/models/displayfol";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('.showit').html(data);
      });
  });
});

 $( document ).ready(function() {
  $('.flwer').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var url = "/models/displayflwer";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('.showit2').html(data);
      });
  });
});

 $(document).on("click", ".userunfollow", function(){
   var val = $(this).attr('id');
   var valid = $(this).attr('id');
    var url = "/models/userunfollow";
    $.get(
      url,
      {user : val
      },
      function(data) {
        $('button#'+valid).replaceWith(data);
      });
});

 $(document).on("click", ".userfollow", function(){
   var val = $(this).attr('id');
   var valid = $(this).attr('id');
    var url = "/models/userfollow";
    $.get(
      url,
      {user : val
      },
      function(data) {
        $('button#'+valid).replaceWith(data);
      });
});

