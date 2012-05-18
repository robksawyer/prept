<div class="stacks form">
<?php echo $this->Form->create('Stack');?>
	<fieldset>
		<legend><?php echo __('Add Stack'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		$attributes = array('legend' => 'Select a color');
		echo "<div class='color-panel'>";
		echo $this->Form->radio('color_id',$colors,$attributes);
		echo "</div>";
		echo $this->Form->input('tags',array('after'=>'Enter optional subjects (separated by a comma), <i>i.e.,</i> history, math, science.'));
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
<?php echo $this->Html->script('colorBtnSelector'); ?>