<div class="cards form">
<?php echo $this->Form->create('Card');?>
	<fieldset>
		<legend><?php echo __('Add a card to stack <i>'.$stack['Stack']['title']).'</i>'; ?></legend>
	<?php
		echo $this->Form->input('Card.front',array('label'=>false,'value'=>'Enter the term here. Press tab to go to next input box.','class'=>'card-front'));
		echo $this->Form->input('Card.back',array('label'=>false,'value'=>'Enter the definition here.','class'=>'card-back'));
		echo "<div class='clear'>&nbsp;</div>";
		echo $this->Form->input('stack_id',array('type'=>'hidden','value'=>$stack['Stack']['id']));
		echo $this->Form->input('color_id',array('type'=>'hidden','value'=>7));
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$current_user['id']));
		echo "<div class='tags'>";
		echo $this->Form->input('tags',array('label'=>false,'value'=>'Enter optional subjects, i.e., history, math.','div'=>false));
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Add it'));?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		//Clear fields on click
		var origColor = "#777777";
		var newColor = "#000000";
		var frontVal = $('textarea.card-front').val();
		var backVal = $('textarea.card-back').val();
		var tagVal = $('.tags > input').val();
		//Front
		$('textarea.card-front').focus(function(){
			if($(this).val() == frontVal) $(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(frontVal);
				$(this).css({'color':origColor});
			}
		});
		
		//Back
		$('textarea.card-back').focus(function(){
			if($(this).val() == backVal) $(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(backVal);
				$(this).css({'color':origColor});
			}
		});
		//Tags
		$('div.tags > input').focus(function(){
			$(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(tagVal);
				$(this).css({'color':origColor});
			}
		});
		
	});
</script>