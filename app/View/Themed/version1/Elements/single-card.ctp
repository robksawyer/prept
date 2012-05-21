<div class="card shadow" id="card-<?php echo $stack['Stack']['id']; ?>" style="background-color: #<?php echo $stack['Color']['hex']; ?>">
	<div class="card-links" id="card-links-<?php echo $stack['Stack']['id']; ?>">
		<?php echo $this->element('card-links',array('cache'=>false)); ?>
	</div>
	<span class="card-overlay">&nbsp;</span>
	<div class="card-data">
		<div class="title" id="title-<?php echo $stack['Stack']['id']; ?>"><?php echo $stack['Stack']['title']; ?></div>
		<div class="description"><?php echo $stack['Stack']['description']; ?>&nbsp;</div>
		<div class="user" style="display:none"><?php echo $this->Html->link($stack['User']['fullname'], array('controller' => 'users', 'action' => 'view', $stack['User']['id'])); ?>&nbsp;</div>
		<div class="tags">
			<ul id="tagcloud">
				<?php 
					echo $this->TagCloud->display($tags, array(
						'before' => '<li class="tag">',
						'after' => '</li>',
						'url' => array('controller'=>'stacks','action'=>'index')
						)
					);
				?>
			</ul>
		</div>
	</div>
</div>