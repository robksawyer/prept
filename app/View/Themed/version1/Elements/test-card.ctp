<?php
	if(empty($data['Color']['hex'])){
		$data['Color']['hex'] = "ffffff";
	}
?>
<div class="test-card shadow <?php if($next) echo "next"; ?>" id="test-card-<?php echo $counter; ?>" style="<?php echo "background-color: #".$data['Color']['hex']; ?>">
	<div class="stack-name"><?php echo $stack['Stack']['title']; ?></div>
	<span class="card-overlay">&nbsp;</span>
	<div class="card-data">
		<?php
			if($test_type == 'terms'){
				echo __($data['front']);
			}else{
				echo __($data['back']);
			}
			//echo $this->Html->link(__($data['Card']['front']), array('controller'=>'stacks','action' => 'view', $data['Card']['id']),array('class'=>'title','id'=>'title-'.$counter))
		?>
		<!--<p class="description"><?php //echo $stack['Stack']['description']; ?></p>-->
	</div>
</div>
