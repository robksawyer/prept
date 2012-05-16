<div class="attachments view">
<h2><?php  echo __('Attachment');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filesize'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['filesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ext'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['ext']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path Small'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['path_small']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path Med'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['path_med']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source Url'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['source_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uploaded'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['uploaded']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Votes'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['votes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachment['User']['fullname'], array('controller' => 'users', 'action' => 'view', $attachment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model Id'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['model_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keycode'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attachment'), array('action' => 'edit', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attachment'), array('action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users');?></h3>
	<?php if (!empty($attachment['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Auto Login'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Attachment Id'); ?></th>
		<th><?php echo __('Profile Image Url'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Fullname'); ?></th>
		<th><?php echo __('Birthday'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('About'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Banned'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Hide Competitions'); ?></th>
		<th><?php echo __('Hide Welcome'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Signature'); ?></th>
		<th><?php echo __('Locale'); ?></th>
		<th><?php echo __('Timezone'); ?></th>
		<th><?php echo __('Email On Like'); ?></th>
		<th><?php echo __('Email On Comment'); ?></th>
		<th><?php echo __('Notify On Follow'); ?></th>
		<th><?php echo __('Notify On Like'); ?></th>
		<th><?php echo __('TotalLikes'); ?></th>
		<th><?php echo __('Staff Favorite'); ?></th>
		<th><?php echo __('Facebook Id'); ?></th>
		<th><?php echo __('Twitter Id'); ?></th>
		<th><?php echo __('Public Key'); ?></th>
		<th><?php echo __('CurrentLogin'); ?></th>
		<th><?php echo __('LastLogin'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attachment['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['auto_login'];?></td>
			<td><?php echo $user['role_id'];?></td>
			<td><?php echo $user['attachment_id'];?></td>
			<td><?php echo $user['profile_image_url'];?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['fullname'];?></td>
			<td><?php echo $user['birthday'];?></td>
			<td><?php echo $user['url'];?></td>
			<td><?php echo $user['location'];?></td>
			<td><?php echo $user['about'];?></td>
			<td><?php echo $user['gender'];?></td>
			<td><?php echo $user['active'];?></td>
			<td><?php echo $user['banned'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['slug'];?></td>
			<td><?php echo $user['hide_competitions'];?></td>
			<td><?php echo $user['hide_welcome'];?></td>
			<td><?php echo $user['status'];?></td>
			<td><?php echo $user['signature'];?></td>
			<td><?php echo $user['locale'];?></td>
			<td><?php echo $user['timezone'];?></td>
			<td><?php echo $user['email_on_like'];?></td>
			<td><?php echo $user['email_on_comment'];?></td>
			<td><?php echo $user['notify_on_follow'];?></td>
			<td><?php echo $user['notify_on_like'];?></td>
			<td><?php echo $user['totalLikes'];?></td>
			<td><?php echo $user['staff_favorite'];?></td>
			<td><?php echo $user['facebook_id'];?></td>
			<td><?php echo $user['twitter_id'];?></td>
			<td><?php echo $user['public_key'];?></td>
			<td><?php echo $user['currentLogin'];?></td>
			<td><?php echo $user['lastLogin'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
