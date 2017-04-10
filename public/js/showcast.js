 $( document ).ready(function() {
  $('.updatejob').bind('click', function() {
  $('.location').attr('disabled') = 'false'
  });
});

$( document ).ready(function() {
  $('#applicants').bind('click', function() {  
  var url = "/others/getapplicant";
  var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {cast: cast},
      function(data) {
      $('.valindex').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('#confirms').bind('click', function() {  
  var url = "/others/getall";
  var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {cast: cast},
      function(data) {
      $('.valindex').show().html(data);
      });
  });
});

  $( document ).ready(function() {
  $('#discards').bind('click', function() {  
  var url = "/others/getdisc";
  var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {cast: cast},
      function(data) {
      $('.valindex').show().html(data);
      });
  });
});

$(document).ready(function() {
  $('#checkout').bind('click', function() {
    var cast = $('input[name="cast_ids"]').val();
    var url = "/others/checkout";
    $.get(
      url,
      {
        cast : cast
      },
      function(data) {
      $('.modelcheckout').show().html(data);
      });
  })
})

$(document).ready(function() {
  $('#checkoutpost').bind('click', function() {
    var cast = $('input[name="cast_ids"]').val();
    var url = "/others/checkoutpost";
    $.get(
      url,
      {
        cast : cast
      },
      function(data) {
      $('.modelcheckout').show().html(data);
      });
  })
})

 $( document ).ready(function() {
  $('#confirm').bind('click', function() {
    var curVa = $('ul#folder li').hasClass('active');
    curVal = $('ul#folder li.active a').text();

    var users = $('input[name="users"]:checked').serializeArray();
    $('input[name="users"]:checked').parents('.well').remove().slideUp('slower');
    var val = 'users';
    
    var url = "/others/processconfirm";
    var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {user : users,
        cast : cast,
        val : val
      },
      function(data) {
      $('#show_div').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('#sendmsg').bind('click', function() {

    var users = $('input[name="users"]:checked').serializeArray();
    var msg = $('#msg').val();
    var val = 'users';

    var url = "/others/sendmsg";
    if (users == '' || msg == '') {

    }else{
    $.get(
      url,
      {user : users,
        val : val,
        msg : msg
      },
      function(data) {
        $('#exampleModal4').modal('hide');
      $('#show_div').show().html(data);
      });
    }
  });
});

 $( document ).ready(function() {
  $('#confirmex').bind('click', function() {
    var curVa = $('ul#folder li').hasClass('active');
    curVal = $('ul#folder li.active a').text();
    
    var users = $('input[name="users"]:checked').serializeArray();
    $('input[name="users"]:checked').parents('.well').remove().slideUp('slower');
    var val = 'users';
    
    var url = "/others/processextconfirm";
    var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {user : users,
        cast : cast,
        val : val
      },
      function(data) {
      $('#show_div').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('#discard').bind('click', function() {
    curVal = $('ul#folder li.active a').text();

    var users = $('input[name="users"]:checked').serializeArray();
    $('input[name="users"]:checked').parents('.well').remove().slideUp('slower');
    var val = 'users';  
    
    var url = "/others/discardform";
    var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {user : users,
        cast : cast,
        val : val
      },
      function(data) {
      $('#show_div').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('#discardex').bind('click', function() {
    curVal = $('ul#folder li.active a').text();

    var users = $('input[name="users"]:checked').serializeArray();
    $('input[name="users"]:checked').parents('.well').remove().slideUp('slower');
    var val = 'users';
    
    var url = "/others/discardextform";
    var cast = $('input[name="cast_ids"]').val()
    $.get(
      url,
      {user : users,
        cast : cast,
        val : val
      },
      function(data) {
      $('#show_div').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('#like').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/likeuser";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('#like').hide();
      $('#dislike').show();
      });
  });
});

 $( document ).ready(function() {
  $('#like').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/btnlk";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('.btnlk').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('#dislike').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/dislikeuser";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('#dislike').hide();
      $('#like').show();
      });
  });
});

 $( document ).ready(function() {
  $('#dislike').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/btndis";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('.btnlk').show().html(data);
      });
  });
}); 

$( document ).ready(function() {
  $('#btn-fol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/following";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('#btn-fol').hide();
      $('#btn-unfol').show();
      });
  });
});

$( document ).ready(function() {
  $('#btn-fol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/btnfl";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('.btnfl').show().html(data);
      });
  });
});

 $( document ).ready(function() {
  $('#btn-unfol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/unfollow";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('#btn-unfol').hide();
      $('#btn-fol').show();
      });
  });
});

 $( document ).ready(function() {
  $('#btn-unfol').bind('click', function() {
    var users = $('input[name="user_id"]').val();
    var like = 'yes';
    var url = "/models/btnunfl";
    $.get(
      url,
      {user : users
      },
      function(data) {
      $('.btnfl').show().html(data);
      });
  });
});
 

$( document ).ready(function() {
  $('button#send').click(function() {
    var users = $('input[name="user_id"]').val();
    var msg = $('textarea#msg').val();
    var url = "/models/message";
    if (msg != '') {
    $.get(
      url,
      {user : users,
        msg : msg
      },
      function(data) {
        $('#exampleModal').modal('hide');
        $('.sent').html(data);
      });
  }else{
    $('#exampleModal').modal('show');
  }
  });
});

$( document ).ready(function() {
  $('#update').click(function() {
    var user = $('#form').serialize();
    var url = "/other/updatedetails";
    $.get(
      url,
      {user : user
      },
      function(data) {
        $('#proUpdate').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('#updatepassword').click(function() {
    var password = $('input[name="password"]').val();
    var oldpassword = $('input[name="oldpassword"]').val();
    var url = "/users/updatepassword";
    if (password == '' || oldpassword == '') {
      value = "<span class='bg-danger' style = 'padding: 7px'>Empty Password fields</span>";
      $('#passwordchange').html(value);
    }else{
    $.get(
      url,
      {password : password,
        oldpassword : oldpassword
      },
      function(data) {
        $('#passwordchange').html(data);
      });
}
})
})

$( document ).ready(function() {
  $('#updateemail').click(function() {
    var password = $('input[name="confpassword"]').val();
    var newemail = $('input[name="newemail"]').val();
    var url = "/users/updateemail";
    if (password == '' || newemail == '') {
      value = "<span class='bg-danger' style = 'padding: 7px'>Empty Password or Email</span>";
      $('#emailchange').html(value);
    }else{
    $.get(
      url,
      {password : password,
        email : newemail
      },
      function(data) {
        $('#emailchange').html(data);
      });
}
})
})

$( document ).ready(function() {
  $('#updatepassword').click(function() {
    var password = $('input[name="password"]').val();
    var repeat = $('input[name="repeat"]').val();
    var url = "/other/updatepassword";
    $.get(
      url,
      {password : password,
        repeat : repeat
      },
      function(data) {
      });
  });
});

$( document ).ready(function() {
  $('#prefbtn').click(function() {

    var atLeastOneIsChecked = $('input[name="cats"]:checked').val();
    var verCheck = $('input[name="catry"]:checked').val()

    if (verCheck != null) {
      cat = $('input[name="catry"]:checked').serializeArray()
    }else{
      cat = '';
    }
    if (atLeastOneIsChecked != null) {
        // variable is undefined or null
      cats = $('input[name="cats"]:checked').serializeArray();
    }else{
      cats = '';
    }

    var user = $('#cast').serialize();
    var cast = $('input[name="cast_ids"]').val()
    var url = "/other/editcast";
    $.get(
      url,
      {user : user,
        catry : cat,
        cats : cats,
        cast : cast
      },
      function(data) {
        $('#casteditshow').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('.viewcast2').click(function() {
    var val = $(this).attr('id');
    var url = "/models/castview2";
    $('#castapplyview').empty();
    $('#castapplyview').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
    $.get(
      url,
      {val : val
      },
      function(data) {
        $('#castapplyview').spin(false); 
        $('#castapplyview').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('.viewcast').click(function() {
    var val = $(this).attr('id');
    var url = "/models/castview";
    $('#castapplyview').empty();
    $('#castapplyview').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
    $.get(
      url,
      {val : val
      },
      function(data) {
       $('#castapplyview').spin(false); 
        $('#castapplyview').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('.viewcasts').click(function() {
    var val = $(this).attr('id');
    var url = "/models/castviews";
    $('#castapplyview').empty();
    $('#castapplyview').spin({
      length: 7,
width : 12,
radius: 10,
color : '#54d7e3'
    });
    $.get(
      url,
      {val : val
      },
      function(data) {
       $('#castapplyview').spin(false); 
        $('#castapplyview').show().html(data);
      });
  });
});

$( document ).ready(function() {
  $('.castapply').click(function() {
    var val = $(this).attr('id');
    $(this).hide();
    var url = "/models/castapply";
    $.get(
      url,
      {val : val
      },
      function(data) {
    $('#hide'+val).remove().slideUp('slower');
        $('#castview').show().html(data);
      });
  });
});

$(document).on("click", ".applyCast", function(){
   var val = $(this).attr('id');
    var url = "/models/castapplyProcess";
    $.get(
      url,
      {val : val
      },
      function(data) {
    $('#hide'+val).remove().slideUp('slower');
        $('#castview').show().html(data);
      });
});

$(document).ready(function() {
  // body...
  $('.uploadsend').click(function() {
    // body...
    $('input[name="category[]"]').attr('disabled', false);
  });
});

$( document ).ready(function() {
  $('input[name="category[]"]').click(function() {
    var val = $('input[name="category[]"]:checked').length; 
    var plan = $('#plan').val();

    if (plan != 'all') {
    if (val == plan) {
      $('input[name="category[]"]').attr('disabled', true);
      $('.reset').show();
    } 
    val1 = plan - val;
    val2 = val + ' checked remaining '+val1;
        $('.length h4').show().html(val2);
        }
  });
});
$( document ).ready(function() {
  $('.reset').click(function() {
    $('input[name="category[]"]:checkbox').removeAttr('checked');
        $('.length h4').hide();    
      $('input[name="category[]"]').attr('disabled', false);
  });
});

$( document ).ready(function() {
  $('input[name="catry"]').click(function() {
    var val = $('input[name="catry"]:checked').length; 
    var plan = $('#plan').val();

    if (plan != 'all') {
    if (val == plan) {
      $('input[name="catry"]').attr('disabled', true);
      $('.reset').show();
    } 
    val1 = plan - val;
    val2 = val + ' checked remaining '+val1;
        $('.length h4').show().html(val2);
        }
  });
});
$( document ).ready(function() {
  $('.reset').click(function() {
    $('input[name="catry"]:checkbox').removeAttr('checked');
        $('.length h4').hide();    
      $('input[name="catry"]').attr('disabled', false);
  });
});

$( document ).ready(function() {
  $('.updateProfile').click(function() {
    $('input[name="catry"]').attr('disabled', false);
    
    var cateys = $('input[name="cats"]:checked').serializeArray();
    var atLeastOneIsChecked = $('input[name="cats"]:checked').val();
    var val = $('input[name="catry"]:checked').length; 
    var plan = $('#plan').val();
    var verCheck = $('input[name="catry"]:checked').val()

    if (verCheck != null) {
      cat = $('input[name="catry"]:checked').serializeArray()
    }else{
      cat = '';
    }
    if (atLeastOneIsChecked != null) {
        // variable is undefined or null
      cats = $('input[name="cats"]:checked').serializeArray();
    }else{
      cats = '';
    }
    var datas = $('#formmodel').serialize();
    var url = "/models/editprofile";
    $.get(
      url,
      {
        cat : cat,
        cats : cats,
        datas : datas
      },
      function(data) {
        $('#proUpdate').show().html(data);
        if (val < plan) {
      $('input[name="catry"]').attr('disabled', false);
      $('.reset').show();
    }else{
      $('.reset').hide();
      $('input[name="catry"]').attr('disabled', true);
      }
      });
  });
});

$( document ).ready(function() {
  
  var plan = $('#plan').val();
  var val = $('input[name="catry"]:checked').length; 

  if (plan == 'all') {

  }
  else if(plan == val) {
    $('input[name="catry"]').attr('disabled', true);
    $('.buyplan').show();
  }

});

$(document).ready(function() {
  // body...
  $('#invitemodel').click(function() {
    // body...
      cats = $('input[name="cat"]:checked').serializeArray();
    $('input[name="cat"]:checked').parents('.thumbnail-image').remove().slideUp('slower');
      var url = "/others/invitemodels";
      cast_ids = $('input[name="cast_ids"]').val();
      $.get(
      url,
      {cats : cats,
      cast_ids : cast_ids
      },
      function(data) {
        $('#castadded').show().html(data);
      });

  })
})
$( document ).ready(function() {
$('select.state').change(function() {
  val = $(this).val();
  url = '/user/castingdetail';
  $.get(
    url,
    {location : val},
    function(data) {
      // body...
      $('#data').html(data);
    }
    )
});
});


$( document ).ready(function() {
$('.searchval').click(function() {
  val = $('input[name="search"]').val();
  url = '/user/castsearchcode';
  if (val != '') {
          $.get(
    url,
    {val : val},
    function(data) {
      // body...
      $('#data').html(data);
    })
  }else{}
});
});

$(document).ready(function() {
  // body...
  $('.getinvite').change(function() {
    var val = $(this).val();
    url = '/others/getdatainvite';
    $.get(
    url,
    {val : val},
    function(data) {
      // body...
      $('.getdata').html(data);
    })
  })
})

$(document).ready(function() {
  // body...
  $('.sendinvite').click(function() {
    // body...
      invite = $('input[name="invite"]:checked').serializeArray();
      var url = "/others/sendinvitation";
      cast_ids = $('input[name="cast_ids"]').val();
      $.get(
      url,
      {invite : invite,
      cast_ids : cast_ids
      },
      function(data) {
        $('#exampleModal2').modal('hide');
        $('#castadded').show().html(data);
      });

  })
})

$(document).on("click", ".discasts", function(){
    var url = "/models/castdisccheck";
    id = $(this).attr();
    $.get(
      url,
      {id : id
      },
      function(data) {
        $('#myModal2').modal('show');
        $('#view').html(data);
        $('#myModal').modal('hide');
      });
});

$(document).on("click", ".discast", function(){
    var url = "/models/castdisccheck";
        var val = $(this).attr('id');
        $.get(
      url,
      {id : val
      },
      function(data) {
        $('#myModal2').modal('show');
        $('#view').html(data);
        $('#myModal').modal('hide');
        $('#cast'+val).hide('slow');
      });
});

$(document).on("click", ".discastx", function(){
    var url = "/models/castdisc";
        var val = $(this).attr('id');
        $.get(
      url,
      {id : val
      },
      function(data) {
        $('#myModal2').modal('hide');
        $('#cast'+val).hide('slow');
      });
});

$(document).ready(function() {
  // body...
  $('.modelchange').click(function() {
    // body...
      var url = "/others/changemodel";
        var id = $(this).attr('id');
      cast_id = $('#cast_id').val();
      $.get(
      url,
      {id : id,
      cast_id : cast_id
      },
      function(data) {
        $('#mymodal').modal('show');
        $('#modelchange').show().html(data);
      });

  })
})

$(document).ready(function() {
  // body...
  $('.modelchange').click(function() {
    // body...
      var url = "/others/changemodel";
        var id = $(this).attr('id');
      cast_id = $('#cast_id').val();
      $.get(
      url,
      {id : id,
      cast_id : cast_id
      },
      function(data) {
        $('#mymodal').modal('show');
        $('#modelchange').show().html(data);
      });

  })
})

$(document).on("click", ".invitedeclmd", function(){
    var url = "/others/changecastmodel";
        var id = $('input[name="invite"]:checked').serializeArray();
        var cast_id = $('#cast_id').val();
        $.get(
      url,
      {id : id,
      cast_id : cast_id
      },
      function(data) {
        $('#myModal').modal('hide');
        $('.dis'+cast_id).show().html(data);
      });
});

$(document).on('change', '.selcat', function() {
    // body...
    var url = "/models/setcategory";
    var pix_id = $(this).attr('id');
    var val = $(this).val();
    $.get(
      url,
      {pix_id : pix_id,
        val : val
      },
      function(data) {
        $('.showbg'+pix_id).show();
      });

})

$(document).on('click', '.setprofile', function() {
    // body...
      var $lg = $('#lightgallery');
      $lg.lightGallery();
    var url = "/models/setprofile";
    var pix_id = $(this).attr('id');
    $.get(
      url,
      {pix_id : pix_id
      },
      function(data) {
        $('.dpchange').show().html(data);
        $lg.data('lightGallery').destroy();
      });

})

$(document).on('click', '.delpix', function() {
    // body...
    var $lg = $('#captions');
      $lg.lightGallery();
    var url = "/models/delpix";
    var pix_id = $(this).attr('id');
    $.get(
      url,
      {pix_id : pix_id
      },
      function(data) {
        $('#pix'+pix_id).remove();
        $lg.data('lightGallery').destroy();
      });

})

$(document).ready(function() {
  // body...
  $('.bankdtls').click(function() {
    // body...
      var url = "/models/bankdetails";
    var acctname = $('input[name="acctname"]').val();
    var acctno = $('input[name="acctno"]').val();
    var bank = $('input[name="bank"]').val();
    $.get(
      url,
      {acctname : acctname,
        acctno : acctno,
        bank : bank
      },
      function(data) {
        $('#bankmsg').html(data);
      });

  })
})

$(document).on("click", ".proceedpay", function(){
   $(this).hide('slow');
   $('.Offlinebtn').show('slow');
});

$(document).ready(function() {
  // body...
  $('.proceedpay').click(function() {
    $(this).hide('slow');
      });

  })

$( document ).ready(function() {
  $('.castdecline').bind('click', function() {  
  var url = "/models/castdecline";
  var castid = $(this).attr('id');
    $.get(
      url,
      {castid : castid},
      function(data) {
        $('#myModal2').modal('show');
      $('#castapplyview2').show().html(data);
      });
  });
});

$( document ).on('click','.declinecast', function() { 
    var val = $(this).attr('id');
  var url = "/models/declinecast";
  $.get(
      url,
      { val : val},
      function(data) {
        $('#hide'+val).hide('slow');
      });
});

$(document).ready(function() {
  $('#socialview').click(function() {
    url = '/models/editpix';
    $.get(
  url,
  {},
  function(data) {
  $('.show_div').show().html(data);
  $('.grid').masonry({
          // options...

        })
  $('#captions').lightGallery();
  });
  })
})