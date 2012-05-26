<?php
	if(empty($data['Color']['hex'])){
		$data['Color']['hex'] = "ffffff";
	}
?>
<div class="test-card <?php if($next) echo "next"; ?>" id="test-card-<?php echo $counter; ?>">
	<div class="quickflip-wrapper">
		<div class="card container shadow panel1" id="card-front-<?php echo $counter; ?>" style="<?php echo "background-color: #".$data['Color']['hex']; ?>">
			<div class="stack-name"><?php echo $stack['Stack']['title']; ?></div>
			<span id="timer-<?php echo $counter; ?>"></span>
			<span class="card-overlay">&nbsp;</span>
			<div class="card-data">
				<?php
					if($test_type == 'terms'){
						echo __($data['front']);
					}else{
						echo __($data['back']);
					}
				?>
			</div>
		</div>
		<div class="card container shadow panel2" id="card-back-<?php echo $counter; ?>" style="<?php echo "background-color: #".$data['Color']['hex']; ?>">
			<div class="stack-name"><?php echo $stack['Stack']['title']; ?></div>
			<span class="card-overlay">&nbsp;</span>
			<div class="flipped-icon" onclick="javascript:flipBackAround(<?php echo $counter; ?>);" title="flip around">&#x21BA;</div>
			<div class="card-data">
				<?php
					if($test_type != 'terms'){
						echo __($data['front']);
					}else{
						echo __($data['back']);
					}
				?>
			</div>
			<div class="grade-panel" id="grade-panel-<?php echo $counter; ?>">
				<div class="loading" id="#loading-<?php echo $counter; ?>">&nbsp;</div>
				<div class="grade" id="grade-<?php echo $counter; ?>">
				<!-- There's a bug and it's only adding one ajax link. For some reason when I click, the alert pops up three times.  -->
				Did you get it <?php echo $this->Ajax->link('right',
															array('controller'=>'questions','action'=>'answer',
																	'test_id'=>$test['Test']['id'],
																	'score'=>'right',
																	'id'=>'right-link-'.$counter,
																	'time_elapsed'=>'00:00:34',
																	'card_id'=>$data['id']
																	),
															array(
																'title'=>'Congratulations!',
																'indicator'=>'loading-'.$counter,
																'update'=>'grade-'.$counter,
																'complete'=>'addedScore(request.responseText)'
															)); ?> or <?php echo $this->Ajax->link('wrong',
																array('controller'=>'questions','action'=>'answer',
																	'test_id'=>$test['Test']['id'],
																	'score'=>'wrong',
																	'id'=>'wrong-link-'.$counter,
																	'time_elapsed'=>'00:00:34',
																	'card_id'=>$data['id']
																),
																array(
																	'title'=>'Keep studying, you\'ll get it right soon enough.',
																	'indicator'=>'loading-'.$counter,
																	'update'=>'grade-'.$counter,
																	'complete'=>'addedScore(request.responseText)'
																)
																); ?>?
				</div>
			</div>
		</div>
	</div>
	<ul class='test-card-actions' id='test-card-actions-<?php echo $counter; ?>'>
		<li>
		<?php
			echo $this->Html->link($this->Html->image('../img/slide-show/icons/question-icon-52x52_off.png',array('border'=>false)),
																'#',array('escape'=>false,'title'=>'Question?')
																);
		?>
		</li>
		<li>
		<?php
			echo $this->Html->link($this->Html->image('../img/slide-show/icons/add-card-icon-52x52_off.png',array('border'=>false)),
																array('controller'=>'cards','action'=>'add',$stack['Stack']['id']),
																array('escape'=>false,'title'=>'Add a Card')
															);
		?>
		</li>
		<li>
		<?php
			echo $this->Html->link($this->Html->image('../img/slide-show/icons/delete-card-icon-52x52_off.png',array('border'=>false)),
																array('controller'=>'cards','action'=>'add',
																	$stack['Stack']['id'],null,__('Are you sure you want to delete # %s?', $data['id'])
																),
																array('escape'=>false,'title'=>'Delete a Card')
															);
		?>
		</li> 
		<!--<li>
		<?php 
			/*echo $this->Html->link($this->Html->image('../img/slide-show/icons/shuffle-icon-52x52_off.png',array('border'=>false)),
																'javascript:shuffleCards();',array('escape'=>false,'title'=>'Shuffle Cards')
															);*/
		?>
		</li> -->
		<li>
		<?php 
			echo $this->Html->link($this->Html->image('../img/slide-show/icons/share-icon-52x52_off.png',array('border'=>false)),
										'#',array('escape'=>false,'title'=>'Share')
									); 
		?>
		</li>
		<li>
		<?php 
			echo $this->Html->link($this->Html->image('../img/slide-show/icons/take-test-icon-52x52_off.png',array('border'=>false)),
																'javascript:doTest('.$counter.');',array('escape'=>false,'title'=>'Take Test')
															);
		?>
		</li>
	</ul>
</div>