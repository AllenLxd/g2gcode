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
			
	  });
	  $(window).on('load',function(){
	         Carousel.init($(".pictureSlider"));           
	  });
	  //导航条下拉
	  var slip = 0;
	  $('#showRightPush').click(function(){

		  if(slip == 0){
			  $('body').addClass("cbp-spmenu-push-toleft");
			  $('#cbp-spmenu-s2').addClass("cbp-spmenu-open");
			  slip = 1;
		  }else{
			  $('body').removeClass("cbp-spmenu-push-toleft");
			  $('#cbp-spmenu-s2').removeClass("cbp-spmenu-open");
			  slip = 0;
		  }

	  })
	$('nav a').click(function(){
		$('body').removeClass("cbp-spmenu-push-toleft");
		$('#cbp-spmenu-s2').removeClass("cbp-spmenu-open");
	})
	
});


