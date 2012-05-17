<div class="colors view">
<h2><?php  echo __('Color');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($color['Color']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($color['Color']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hex'); ?></dt>
		<dd>
			<?php echo h($color['Color']['hex']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($color['Color']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($color['Color']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Color'), array('action' => 'edit', $color['Color']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Color'), array('action' => 'delete', $color['Color']['id']), null, __('Are you sure you want to delete # %s?', $color['Color']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Colors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('admin'=>false,'controller' => 'stacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('admin'=>false,'controller' => 'stacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cards');?></h3>
	<?php if (!empty($color['Card'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Front'); ?></th>
		<th><?php echo __('Back'); ?></th>
		<th><?php echo __('Stack Id'); ?></th>
		<th><?php echo __('Color Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($color['Card'] as $card): ?>
		<tr>
			<td><?php echo $card['id'];?></td>
			<td><?php echo $card['front'];?></td>
			<td><?php echo $card['back'];?></td>
			<td><?php echo $card['stack_id'];?></td>
			<td><?php echo $card['color_id'];?></td>
			<td><?php echo $card['user_id'];?></td>
			<td><?php echo $card['created'];?></td>
			<td><?php echo $card['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cards', 'action' => 'view', $card['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cards', 'action' => 'edit', $card['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cards', 'action' => 'delete', $card['id']), null, __('Are you sure you want to delete # %s?', $card['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Stacks');?></h3>
	<?php if (!empty($color['Stack'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Color Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($color['Stack'] as $stack): ?>
		<tr>
			<td><?php echo $stack['id'];?></td>
			<td><?php echo $stack['title'];?></td>
			<td><?php echo $stack['description'];?></td>
			<td><?php echo $stack['color_id'];?></td>
			<td><?php echo $stack['user_id'];?></td>
			<td><?php echo $stack['created'];?></td>
			<td><?php echo $stack['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'stacks', 'action' => 'view', $stack['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'stacks', 'action' => 'edit', $stack['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'stacks', 'action' => 'delete', $stack['id']), null, __('Are you sure you want to delete # %s?', $stack['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Stack'), array('controller' => 'stacks', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
