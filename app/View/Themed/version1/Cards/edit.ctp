<div class="cards form">
<?php echo $this->Form->create('Card');?>
	<fieldset>
		<legend><?php echo __('Edit Card'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Card.front',array('label'=>'Term','class'=>'card-front'));
		echo $this->Form->input('Card.back',array('label'=>'Definition','class'=>'card-back'));
		echo "<div class='clear'>&nbsp;</div>";
		echo $this->Form->input('stack_id',array('type'=>'hidden'));
		echo $this->Form->input('color_id',array('type'=>'hidden'));
		echo $this->Form->input('user_id',array('type'=>'hidden'));
		//echo $this->Form->input('updated_user_id',array('type'=>'hidden','value'=>$current_user['id']));
		echo "<div class='tags'>";
		echo $this->Form->input('tags',array('label'=>'Add tags separated by a comma <i>i.e</i>, science, history, math .','div'=>false));
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Save'));?>
</div>