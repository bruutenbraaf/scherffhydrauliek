$( document ).ready(function() {	
	$( "li.menu-item-has-children" ).hover(function() {
		$(".sub-menu").toggleClass("grid");
	});
});
