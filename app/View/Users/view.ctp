<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Auto Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['auto_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['role_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attachment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $user['Attachment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile Image Url'); ?></dt>
		<dd>
			<?php echo h($user['User']['profile_image_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fullname'); ?></dt>
		<dd>
			<?php echo h($user['User']['fullname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthday'); ?></dt>
		<dd>
			<?php echo h($user['User']['birthday']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($user['User']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($user['User']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('About'); ?></dt>
		<dd>
			<?php echo h($user['User']['about']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Banned'); ?></dt>
		<dd>
			<?php echo h($user['User']['banned']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($user['User']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hide Competitions'); ?></dt>
		<dd>
			<?php echo h($user['User']['hide_competitions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hide Welcome'); ?></dt>
		<dd>
			<?php echo h($user['User']['hide_welcome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Signature'); ?></dt>
		<dd>
			<?php echo h($user['User']['signature']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locale'); ?></dt>
		<dd>
			<?php echo h($user['User']['locale']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timezone'); ?></dt>
		<dd>
			<?php echo h($user['User']['timezone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email On Like'); ?></dt>
		<dd>
			<?php echo h($user['User']['email_on_like']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email On Comment'); ?></dt>
		<dd>
			<?php echo h($user['User']['email_on_comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notify On Follow'); ?></dt>
		<dd>
			<?php echo h($user['User']['notify_on_follow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notify On Like'); ?></dt>
		<dd>
			<?php echo h($user['User']['notify_on_like']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TotalLikes'); ?></dt>
		<dd>
			<?php echo h($user['User']['totalLikes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Staff Favorite'); ?></dt>
		<dd>
			<?php echo h($user['User']['staff_favorite']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['facebook_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['twitter_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Public Key'); ?></dt>
		<dd>
			<?php echo h($user['User']['public_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CurrentLogin'); ?></dt>
		<dd>
			<?php echo h($user['User']['currentLogin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LastLogin'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastLogin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Cards');?></h3>
	<?php if (!empty($user['Card'])):?>
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
		foreach ($user['Card'] as $card): ?>
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
	<h3><?php echo __('Related Comments');?></h3>
	<?php if (!empty($user['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Foreign Key'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Model'); ?></th>
		<th><?php echo __('Approved'); ?></th>
		<th><?php echo __('Is Spam'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Author Name'); ?></th>
		<th><?php echo __('Author Url'); ?></th>
		<th><?php echo __('Author Email'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Comment Type'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id'];?></td>
			<td><?php echo $comment['parent_id'];?></td>
			<td><?php echo $comment['foreign_key'];?></td>
			<td><?php echo $comment['user_id'];?></td>
			<td><?php echo $comment['lft'];?></td>
			<td><?php echo $comment['rght'];?></td>
			<td><?php echo $comment['model'];?></td>
			<td><?php echo $comment['approved'];?></td>
			<td><?php echo $comment['is_spam'];?></td>
			<td><?php echo $comment['title'];?></td>
			<td><?php echo $comment['slug'];?></td>
			<td><?php echo $comment['body'];?></td>
			<td><?php echo $comment['author_name'];?></td>
			<td><?php echo $comment['author_url'];?></td>
			<td><?php echo $comment['author_email'];?></td>
			<td><?php echo $comment['language'];?></td>
			<td><?php echo $comment['comment_type'];?></td>
			<td><?php echo $comment['created'];?></td>
			<td><?php echo $comment['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Stacks');?></h3>
	<?php if (!empty($user['Stack'])):?>
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
		foreach ($user['Stack'] as $stack): ?>
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
