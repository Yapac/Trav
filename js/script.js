$(function(){
	
$('[data-toggle="tooltip"]').tooltip();

    
	
	
	
	
	
	$("nav a").click(function(event){
 
        event.preventDefault();
        var hash = this.hash;
        
         $('body,html').animate({scrollTop: $(this.hash).offset().top} , 2000 )
            
    });

})