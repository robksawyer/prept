<div class="users index">
	<h2><?php echo __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('auto_login');?></th>
			<th><?php echo $this->Paginator->sort('role_id');?></th>
			<th><?php echo $this->Paginator->sort('attachment_id');?></th>
			<th><?php echo $this->Paginator->sort('profile_image_url');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('fullname');?></th>
			<th><?php echo $this->Paginator->sort('birthday');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('about');?></th>
			<th><?php echo $this->Paginator->sort('gender');?></th>
			<th><?php echo $this->Paginator->sort('active');?></th>
			<th><?php echo $this->Paginator->sort('banned');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('hide_competitions');?></th>
			<th><?php echo $this->Paginator->sort('hide_welcome');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('signature');?></th>
			<th><?php echo $this->Paginator->sort('locale');?></th>
			<th><?php echo $this->Paginator->sort('timezone');?></th>
			<th><?php echo $this->Paginator->sort('email_on_like');?></th>
			<th><?php echo $this->Paginator->sort('email_on_comment');?></th>
			<th><?php echo $this->Paginator->sort('notify_on_follow');?></th>
			<th><?php echo $this->Paginator->sort('notify_on_like');?></th>
			<th><?php echo $this->Paginator->sort('totalLikes');?></th>
			<th><?php echo $this->Paginator->sort('staff_favorite');?></th>
			<th><?php echo $this->Paginator->sort('facebook_id');?></th>
			<th><?php echo $this->Paginator->sort('twitter_id');?></th>
			<th><?php echo $this->Paginator->sort('public_key');?></th>
			<th><?php echo $this->Paginator->sort('currentLogin');?></th>
			<th><?php echo $this->Paginator->sort('lastLogin');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['auto_login']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $user['Attachment']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['profile_image_url']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['fullname']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['birthday']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['url']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['location']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['about']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['gender']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['active']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['banned']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['passwd']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['slug']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['hide_competitions']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['hide_welcome']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['signature']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['locale']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['timezone']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email_on_like']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email_on_comment']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['notify_on_follow']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['notify_on_like']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['totalLikes']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['staff_favorite']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['facebook_id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['twitter_id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['public_key']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['currentLogin']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['lastLogin']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cards'), array('controller' => 'cards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Card'), array('controller' => 'cards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stacks'), array('controller' => 'stacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stack'), array('controller' => 'stacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
