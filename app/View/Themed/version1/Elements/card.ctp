<td class="card shadow" id="card-<?php echo $counter; ?>" style="<?php echo "background: #".$data['Color']['hex']; ?>">
	<div class="card-links" id="card-links-<?php echo $counter; ?>">
		<?php
		if(!empty($data['Card'])){
			$cardCount = count($data['Card']);
			if($cardCount > 1){
				echo "<span class='card-count'>".$cardCount." cards</span>";
			}else{
				echo "<span class='card-count'>".$cardCount." card</span>";
			}
		}else{
			echo "<span class='card-count'>0 cards</span>";
		}
		echo $this->Html->link($this->Html->image('../img/common/twitter-icon-22x23.png',array('border'=>0,'width'=>'22','height'=>'23')),'#',array('escape'=>false));
		echo $this->Html->link($this->Html->image('../img/common/settings-icon-23x23.png',array('border'=>0,'width'=>'23','height'=>'23')),'#',array('escape'=>false));
		echo $this->Html->link($this->Html->image('../img/common/customers-icon-23x22.png',array('border'=>0,'width'=>'23','height'=>'22')),'#',array('escape'=>false));
		echo $this->Html->link($this->Html->image('../img/common/heart-icon-23x21.png',array('border'=>0,'width'=>'23','height'=>'21')),'#',array('escape'=>false));
		echo $this->Html->link($this->Html->image('../img/common/finished-icon-22x23.png',array('border'=>0,'width'=>'22','height'=>'23')),'#',array('escape'=>false));
		?>
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
</td>