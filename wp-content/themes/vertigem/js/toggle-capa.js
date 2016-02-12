/* 
 * toggle capa
 */


jQuery(document).ready(function ($) {

    $('.post-with-thumb').mouseover(function (){
        $(this).find('.item-hover').show();
    });
    
    $('.post-with-thumb').mouseleave(function (){
        $(this).find('.item-hover').hide();
    });

    
  
    
});



