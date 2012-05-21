<div class="quickflip-wrapper">
	<div class="card shadow panel1" id="card-<?php echo $counter; ?>" style="<?php echo "background: #".$data['Color']['hex']; ?>">
		<span class="card-overlay">&nbsp;</span>
		<div class="card-data" id="card-data-front-<?php echo $counter; ?>">
			<?php
				echo $this->Html->link(__($data['front']), array('controller'=>'cards','action' => 'view', $data['id']),array('class'=>'front','id'=>'front-'.$counter))
			?>
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
	<div class="card shadow panel2" id="card-<?php echo $counter; ?>" style="<?php echo "background: #".$data['Color']['hex']; ?>">
		<span class="card-overlay">&nbsp;</span>
		<div class="card-data" id="card-data-back-<?php echo $counter; ?>">
			<?php
				echo $this->Html->link(__($data['back']), array('controller'=>'cards','action' => 'view', $data['id']),array('class'=>'back','id'=>'back-'.$counter))
			?>
			<div class="tags" style="display: none">
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
</div>