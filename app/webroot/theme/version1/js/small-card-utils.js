//STACK RELATED SCRIPTS
$(document).ready(function() {
	//Shrink the titles
	$('div.card').each(function(ev){
		/*var widthToFit = $('div.card').width() - (23*4); //15 = padding around each side
		var textWidth = 0;
		//http://stackoverflow.com/questions/9404536/finding-text-width-in-jquery
		$(this).clone().addClass("checkWidth")
		.appendTo("body").css({"float": "left"});
		textWidth = $(".checkWidth").width();
		$('.checkWidth').remove();*/
		//if(textWidth > widthToFit){
		$(this + 'div.card-data > #title-'+ev).fitText(.5, { minFontSize: '9px', maxFontSize: '18px' });
		//}
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