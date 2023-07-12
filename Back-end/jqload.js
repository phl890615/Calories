$(document).ready(function() {

  $(document).on('click', '.load', function() {
    $('#content').load($(this).attr('href'));
    return false;
  });

});
