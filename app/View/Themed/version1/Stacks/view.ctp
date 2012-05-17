<div class="stacks view">
<h2><?php  echo __('Stack');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stack['Stack']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($stack['Stack']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($stack['Stack']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stack['Color']['name'], array('controller' => 'colors', 'action' => 'view', $stack['Color']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stack['User']['fullname'], array('controller' => 'users', 'action' => 'view', $stack['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($stack['Stack']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($stack['Stack']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stack'), array('action' => 'edit', $stack['Stack']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stack'), array('action' => 'delete', $stack['Stack']['id']), null, __('Are you sure you want to delete # %s?', $stack['Stack']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cards');?></h3>
	<?php if (!empty($stack['Card'])):?>
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
		foreach ($stack['Card'] as $card): ?>
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
			<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add',$stack['Stack']['id']));?> </li>
		</ul>
	</div>
</div>
