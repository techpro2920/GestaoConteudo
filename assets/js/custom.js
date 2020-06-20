$(document).ready(function() {
    // executes when HTML-Document is loaded and DOM is ready
   console.log("document is ready");
     
   
     $(".card").hover(
     function() {
       $(this).addClass('shadow-lg')/*.css('cursor', 'pointer')*/;
     }, function() {
       $(this).removeClass('shadow-lg');
     }
   );
     
   // document ready  
   });
/*var card = document.getElementsByClassName('card');

document.addEventListener("DOMContentLoaded", function() {
    console.log(card);
    
})
*/
