<td>
	<?php 
	if(count($data['Card']) > 1): 
		if(empty($data['Color']['hex'])) $data['Color']['hex'] = "ffffff";
	?>
	<div class="card-stack rotate" style="<?php echo "background-color: #".$data['Color']['hex']; ?>">
		<span class="card-overlay">&nbsp;</span>
	</div>
	<div class="card-stack rotate-more" style="<?php echo "background-color: #".$data['Color']['hex']; ?>">
		<span class="card-overlay">&nbsp;</span>
	</div>
	<?php endif; ?>
	<div class="card shadow" id="card-<?php echo $counter; ?>" style="<?php echo "background-color: #".$data['Color']['hex']; ?>">
		<div class="card-links" id="card-links-<?php echo $counter; ?>">
			<?php echo $this->element('card-links',array('cache'=>false,'data'=>$data)); ?>
		</div>
		<span class="card-overlay">&nbsp;</span>
		<div class="card-data">
			<?php
				echo $this->Html->link(__($data['Stack']['title']), array('controller'=>'stacks','action' => 'view', $data['Stack']['id']),array('class'=>'title','id'=>'title-'.$counter))
			?>
			<!--<p class="description"><?php //echo $stack['Stack']['description']; ?></p>-->
			<div class="tags">
				<ul id="tagcloud">
					<?php 
						foreach ($data['Tag'] as $tag) {
							//echo '<li class="tag">'.$this->Html->link($tag['name'],array('controller'=>'stacks','action'=>'index','by'=>$tag['keyname'])).'</li>';
							echo '<li class="tag">'.$tag['name'].'</li>';
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</td>
