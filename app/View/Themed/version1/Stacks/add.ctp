<div class="stacks form">
<?php echo $this->Form->create('Stack');?>
	<fieldset>
		<legend><?php echo __('Add Stack'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		$attributes = array('legend' => false);
		echo "<div class='color-panel'>";
		echo $this->Form->radio('color_id',$colors,$attributes);
		echo "</div>";
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$current_user['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stacks'), array('action' => 'index'));?></li>
	</ul>
</div>
<script type="text/javascript">
/* Custom Radio Button Magic Sauce */
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
</script>