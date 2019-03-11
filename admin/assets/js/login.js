$(document).ready(function() {
  var error = false;
  $(document).on('submit', '#loginForm', function(e) {
    var inputField = $('.inputField');
    $.each(inputField, function( k, v ) {
      if(v.value == '') {
        let id = v.id;
        $('#'+id).addClass('err-submit');
        error = true;
      }
    });
    if(error == true) {
      e.preventDefault();
      return false;
    }
  });

  $(document).on('focus', '.inputField', function(e) {
    e.preventDefault();
    if($(this).hasClass('err-submit')) {
      $(this).removeClass('err-submit');
      error = false;
    }
  });

  $(document).on('blur', '.inputField', function(e) {
    e.preventDefault();
    if($(this).val() == '') {
      $(this).addClass('err-submit');
      error = true;
    }
  });

  function checkEmail(email) {

  }
});
