/* 
	Custom Radio Button Magic Sauce 
	Thanks: http://stackoverflow.com/questions/5112995/is-there-an-easy-way-to-replace-radio-button-with-images-and-a-colored-border-f
*/
$('.color-panel label').each(function(){
	var hexVal = "#"+$(this).text();
	var radioBtnID = $(this).attr('for');
	var radioBtnVal = $('.color-panel input[type=radio]#'+radioBtnID).val();
	$(this).hide(); //Hide the label
	var radioButton = $('.color-panel input[type=radio]#'+radioBtnID);
	$(radioButton).hide();
	$('<a class="radio-fx" href="#" name="'+$(radioButton).attr('name')+'" value="'+$(radioButton).attr('value')+'" id="'+$(radioButton).attr('id')+'"><div class="radio" style="background-color:'+hexVal.toString()+';"></div></a>').insertAfter(radioButton);
});
$('.radio-fx').live('click',function(e) {
	e.preventDefault();
	var $check = $(this).prev('input');
	$('.radio-fx div').attr('class','radio');
	$(this).find('div').attr('class','radio-checked');
	$check.attr('checked', true);
});