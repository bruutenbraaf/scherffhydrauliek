$(document).ready(function() {
  $("#carouselcontrols").swiperight(function() {
    $(this).carousel('prev');
  });
  $("#carouselcontrols").swipeleft(function() {
    $(this).carousel('next');
  });
});