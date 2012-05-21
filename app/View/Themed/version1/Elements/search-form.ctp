<div class="stacks find">
<?php
	echo $this->Form->create('Stack', array('admin'=>false,'controller'=>'stacks','action'=>'findQuery'));
	echo "<div class='title'>";
	echo $this->Form->input('filter',array('value'=>'Search for titles OR tags','label'=>false,'div'=>false,'maxlength'=>'50'));
	echo "</div>";
	/*echo "<div class='description'>";
	if(!empty($this->request->data['Stack']['description'])){
		echo $this->Form->input('description',array('div'=>false,'label'=>false));
	}else{
		echo $this->Form->input('description',array('div'=>false,'label'=>false,'value'=>'Search the description of the stack.'));
	}
	echo "</div>";*/
	$attributes = array('legend' => false);
	echo "<div class='color-panel'>";
	echo $this->Form->radio('color_id',$colors,$attributes);
	echo "</div>";
	echo $this->Form->submit('common/search-20x20.gif', array('div' => false,'title'=>'Perform the search'));
	echo $this->Form->end();
?>
</div>
<?php echo $this->Html->script('colorBtnSelector'); ?>
<script type="text/javascript">

	$(document).ready(function() {
		//Clear fields on click
		var origColor = "#777777";
		var newColor = "#000000";
		var titleVal = $('.title > input').val();
		$('div.title > input').focus(function(){
			$(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(titleVal);
				$(this).css({'color':origColor});
			}
		});
	});
</script>
