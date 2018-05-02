 $( document ).ready(function() {	
$(".menu-item-has-children").append("<div class='open-menu-link'><i class='fa fa-chevron-down' aria-hidden='true'></i></div>");
 
 
     $('.open-menu-link').click(function(e){
	     $(".open-menu-link").toggleClass("rotate");
         var childMenu =  e.currentTarget.parentNode.children[1];
         if($(childMenu).hasClass('visible')){
             $(childMenu).slideToggle(200);
 
             $(e.currentTarget.parentNode.children[3]).removeClass("visible");
             $(e.currentTarget.parentNode.children[2]).addClass("visible");
         } else {
             $(childMenu).slideToggle(200);
 
             $(e.currentTarget.parentNode.children[2]).removeClass("visible");
             $(e.currentTarget.parentNode.children[3]).addClass("visible");
         }
     });

});