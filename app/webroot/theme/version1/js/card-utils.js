//STACK RELATED SCRIPTS
$(document).ready(function() {
	//Shrink the titles
	$('div.card').each(function(ev){
		if(ev > 0){
			var widthToFit = $(this).find('div.card-data').width(); //15 = padding around each side
			var textWidth = 0;
			//http://stackoverflow.com/questions/9404536/finding-text-width-in-jquery
			$(this).find('a#title-'+ev).clone().addClass("checkWidth").appendTo("body").css({"float": "left"});
			textWidth = $(".checkWidth").width() * 24;
			$('.checkWidth').remove();
			if(textWidth < widthToFit){
				//$(this).fitText(.5, { minFontSize: '12px', maxFontSize: '24px' });
				$(this).find('a#title-'+ev).fitText(.5, { minFontSize: '10px', maxFontSize: '32px' });
			}else{
				$(this).find('a#title-'+ev).fitText(1.5, { minFontSize: '10px', maxFontSize: '32px' });
			}
		}
	});

	//Make the full card clickable
	$('div.card').each(function(){
		//Set the initial opacity of the card
		$(this).css({"opacity": .7});

		var stackURL = $(this).find('a.title').attr('href');
		//Bind the click to the card
		$(this).click(function(){
			window.location.href = stackURL.toString();
		});

		//Change opacity of card on hover
		$(this).hover(function(){
			var id = $(this).attr('id').substring($(this).attr('id').length,$(this).attr('id').length-1);
			$(this).find('#card-links-'+id).fadeIn();
			$(this).stop().animate({"opacity": 1});
		},function(){
			var id = $(this).attr('id').substring($(this).attr('id').length,$(this).attr('id').length-1);
			$(this).find('#card-links-'+id).fadeOut();
			$(this).stop().animate({"opacity": .7});
		});
	});

});