<div class="cards view">
<h2><?php  echo __('Card');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($card['Card']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Front'); ?></dt>
		<dd>
			<?php echo h($card['Card']['front']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Back'); ?></dt>
		<dd>
			<?php echo h($card['Card']['back']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stack'); ?></dt>
		<dd>
			<?php echo $this->Html->link($card['Stack']['title'], array('controller' => 'stacks', 'action' => 'view', $card['Stack']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo $this->Html->link($card['Color']['name'], array('controller' => 'colors', 'action' => 'view', $card['Color']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($card['User']['fullname'], array('controller' => 'users', 'action' => 'view', $card['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($card['Card']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($card['Card']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Card'), array('action' => 'edit', $card['Card']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Card'), array('action' => 'delete', $card['Card']['id']), null, __('Are you sure you want to delete # %s?', $card['Card']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cards'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Card'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('controller' => 'stacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('controller' => 'stacks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colors'), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color'), array('controller' => 'colors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
