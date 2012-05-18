<?php
	echo $this->Form->create('Stack', array(
	    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
	));
	echo $this->Form->input('title', array('div' => false));
	echo $this->Form->input('description', array('div' => false));
	echo $this->Form->input('color_id', array('div' => false, 'options' => $blogs));
	$attributes = array('legend' => 'Select a color');
	echo "<div class='color-panel'>";
	echo $this->Form->radio('color_id',$colors,$attributes);
	echo "</div>";
	echo $this->Form->input('user_id', array('div' => false));
	echo $this->Form->input('tags', array('div' => false));
	echo $this->Form->submit(__('Search', true), array('div' => false));
	echo $this->Form->end();
?>