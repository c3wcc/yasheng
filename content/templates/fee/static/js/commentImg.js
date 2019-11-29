(function($){
	$.fn.commentImg = function(options){
		var defaults = {
			activeClass: 'current',
			imgNavBox:'.photos-thumb',
			imgViewBox:'.photo-viewer'
		};
		var opts = $.extend({},defaults, options);

		this.each(function(){
			var _this =$(this),
				imgNav =_this.find(opts.imgNavBox).children(),
				imgViewBox =_this.find(opts.imgViewBox),
				src = '',
				img = new Image();
				
			function setViewImg(viewSrc){
				img.src = viewSrc;
	            img.onload = function () {
	                               
	                imgViewBox.show(0,function(){
	                	$(this).css({ "width": "100%", "height": "auto" }).find("img").attr('src', src);
	                });					
	            }	            
			}
			imgViewBox.hide();
			imgNav.on("click",function(){
				$(this).toggleClass(opts.activeClass).siblings().removeClass(opts.activeClass);			
				if($(this).hasClass(opts.activeClass)){
					src = $(this).attr('data-src');	
		            setViewImg(src);
				}else{
					imgViewBox.css({ "width": 0, "height": 0 }).hide();
				}
			});
			
			imgViewBox.on("click",function(){
				imgNav.removeClass(opts.activeClass);			
				$(this).css({ "width": 0, "height": 0 }).hide();
			});
			
	        
				
		})
	
	}

})(jQuery);


