$(function(){
		  
   //回到顶部	
   $(window).on('scroll',function(){
	               if($(window).scrollTop()>100){
				         $('#goTop').show(); //滚动条超过页面显示高度显示#goTop 
				   }else{
				         $('#goTop').hide();  
				   }
	 });
	 
	  $('#goTop').on('click',function(){
	               $('html,body'). animate({scrollTop:0});//点击图标回到顶部
	  });
	   
	  $('#goTop').hover(function(){
			      $(this).children('.hint').finish().slideToggle(100);
		});
		$('body').on('click','#videoBtn',function(){
			    $(this).hide();
			    $('.bgImg').hide();
			    $('#videoIframe').show();
			
		})
		$(window).on('load',function(){
	         Carousel.init($(".pictureSlider"));           
	  });
	
});


