<?php
//echo $this->Html->script('jquery.ba-hashchange.min',array('inline'=>false)); //http://benalman.com/projects/jquery-hashchange-plugin/
//echo $this->Html->script('jquery.ba-bbq.min',array('inline'=>false)); //https://github.com/cowboy/jquery-bbq/
echo $this->Html->script('jquery.quickflip.min',array('inline'=>false)); //http://dev.jonraasch.com/quickflip/docs
echo $this->Html->script('jquery.shortkeys.js'); //http://rikrikrik.com/jquery/shortkeys/
echo $this->Html->script('test');
?>
<script type="text/javascript">
	//Set the total card count
	maxCards = <?php echo count($stack['Card']); //I would -1 but the extra score card exists ?>;
	<?php if(!empty($existingTest)): ?>
	existingTest = <?php echo $existingTest; ?>;
	<?php endif; ?>
</script>
<div class="stacks test">
	<?php
		if(!empty($this->request->params['pass'][1])){
			$test_type = $this->request->params['pass'][1];
		}
	
		if(!empty($existingTest) && empty($test_type)):
	?>
		<div class="existing-test">
			<?php echo $this->Form->create('Test',array('url'=>array('controller'=>'tests','action'=>'existingTestUserPref'))); ?>
			We've noticed that you have an existing test open for this stack.
			<?php
			$options = array('continue' => 'continue', 'start_over' => 'start over');
			$attributes = array('legend' => "Would you like to...",'value'=>'continue');
			echo $this->Form->input('id',array('type'=>'hidden','value'=>$existingTest['Test']['id']));
			echo $this->Form->radio('user_test_pref', $options, $attributes);
			echo $this->Form->end(__('Let us know',true));
			?>
		</div>
	<?php
		else:
			$existingTest = false;
		endif;
	?>
	
	<?php
	if(count($stack['Card']) < 1 && empty($existingTest)):
	?>
	<div class="no-cards">
		<p>This stack doesn't contain any cards. But, you can add some cards by navigating to the <?php echo $this->Html->link('add card',array('controller'=>'stacks','action'=>'add',$stack['Stack']['id'])); ?> page.</p>
	</div>
	<?php
	else:
		if(empty($test_type) && empty($existingTest)):
			echo $this->Form->create('Test');
	?>
		<div class="test-selection">
			<?php echo $this->Form->input('name',array('label'=>'Do you want to name your test?','after'=>'e.g <i>Study Session Round 1</i>')); ?>
			<p>Do you want to start your test with the terms or the definitions?</p>
			<?php
			$options = array('terms' => 'Terms', 'definitions' => 'Definitions');
			$attributes = array('legend' => false);
			echo $this->Form->radio('test_type', $options, $attributes);
			?>
		</div>
		<?php echo $this->Form->end(__('Start Testing',true)); ?>
<?php elseif(empty($existingTest)): ?>
	<script type="text/javascript">
		//Set the total card count
		maxCards = <?php echo count($stack['Card']); //I would -1 but the extra score card exists ?>;
		start_timer(curCard);
	</script>
	<div class="card-container" id="card-container-0">
		<div class="slides-container">
			<?php echo $this->Form->create('Question',array('url'=>array('controller'=>'questions','action'=>'score'))); ?>
			<?php 
				$counter = 0;
				$next = false;
				foreach($stack['Card'] as $card){
					if($counter > 0) $next = true;
					echo $this->element('test-card',array('cache'=>false,
																		'data'=>$card,
																		'stack'=>$stack,
																		'counter'=>$counter,
																		'test_type'=>$test_type,
																		'test'=>$test,
																		'next'=>$next
																		)
																	);
					$counter++;
				}
			?>
			<div class="test-card <?php if($next) echo "next"; ?>" id="test-card-<?php echo $counter; ?>">
				<div class="card container shadow panel1" id="card-front-<?php echo $counter; ?>" style="background-color: #ffffff;">
					<div class="stack-name"><?php echo $stack['Stack']['title']; ?></div>
					<?php
						echo $this->Form->submit(__('Get your score',true));
					?>
					<span class="card-overlay">&nbsp;</span>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="clear"></div>
		<div class="slide-navigation">
			<div class="left-arrow">
				<?php echo $this->Html->link($this->Html->image('../img/slide-show/arrow_left.gif',array('border'=>false)),'#',array('escape'=>false)); ?>
			</div>
			<div class="right-arrow">
				<?php echo $this->Html->link($this->Html->image('../img/slide-show/arrow_right.gif',array('border'=>false)),'#',array('escape'=>false)); ?>
			</div>
		</div>
	</div>
	<div class="shortcut-guide">
		<legend>Shortcut key guide</legend>
		<ul>
			<li>left arrow = slide cards left</li>
			<li>right arrow = slide cards right</li>
			<li>spacebar = flip card</li>
		</ul>
		<?php //echo $this->Html->image('../img/common/shortcut-key-guide.png',array('border'=>false)); ?>
	</div>
	<?php 
		endif;
	endif; ?>
</div>
<script type="text/javascript">
$(document).shortkeys({
	'left':		function(){ $('.card-container .slide-navigation .left-arrow').click(); },
	'right':		function(){ $('.card-container .slide-navigation .right-arrow').click(); },
	'Space':		function(){ 
									flipBackAround(curCard,true); 
								}
	}
);

function addedScore(responseText){
	//alert(responseText);
}
</script>