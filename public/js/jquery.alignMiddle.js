(function($){

	$.fn.alignMiddle = function(){

		this.each(function(){

			var element = $(this);
			var elementHeight = element.height();
			var parentHeight = element.parent().height();

			var calcParent =  parentHeight / 2;
			var calcElement = elementHeight / 2;

			var calcTotal = calcParent - calcElement;

			element.css({'margin-top': calcTotal});

		});

	}

})(jQuery);