//STACK RELATED SCRIPTS
$(document).ready(function() {
	//Shrink the titles
	$('td.card a.title').each(function(){
		var maxFontSize = 24;
		var widthToFit = $('td.card').width() - (15*4); //15 = padding around each side
		if($(this).textWidth() > widthToFit){
			$(this).fitText(1.3, { minFontSize: '12px', maxFontSize: '24px' });
		}
	});

	//Make the full card clickable
	$('td.card').each(function(){
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