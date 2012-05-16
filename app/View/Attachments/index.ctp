<div class="attachments index">
	<h2><?php echo __('Attachments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('size');?></th>
			<th><?php echo $this->Paginator->sort('filesize');?></th>
			<th><?php echo $this->Paginator->sort('ext');?></th>
			<th><?php echo $this->Paginator->sort('group');?></th>
			<th><?php echo $this->Paginator->sort('width');?></th>
			<th><?php echo $this->Paginator->sort('height');?></th>
			<th><?php echo $this->Paginator->sort('path');?></th>
			<th><?php echo $this->Paginator->sort('path_small');?></th>
			<th><?php echo $this->Paginator->sort('path_med');?></th>
			<th><?php echo $this->Paginator->sort('source_url');?></th>
			<th><?php echo $this->Paginator->sort('uploaded');?></th>
			<th><?php echo $this->Paginator->sort('votes');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('model');?></th>
			<th><?php echo $this->Paginator->sort('model_id');?></th>
			<th><?php echo $this->Paginator->sort('keycode');?></th>
			<th><?php echo $this->Paginator->sort('active');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($attachments as $attachment): ?>
	<tr>
		<td><?php echo h($attachment['Attachment']['id']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['name']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['title']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['type']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['size']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['filesize']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['ext']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['group']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['width']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['height']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['path']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['path_small']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['path_med']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['source_url']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['uploaded']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['votes']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attachment['User']['fullname'], array('controller' => 'users', 'action' => 'view', $attachment['User']['id'])); ?>
		</td>
		<td><?php echo h($attachment['Attachment']['model']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['model_id']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['keycode']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['active']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['created']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Attachment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
