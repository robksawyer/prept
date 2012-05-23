<div id="backpack">
	<div class="stacks index">
		<!--<h2><?php 
			/*if(!empty($this->request->params['named']['by'])){
				echo __('Your Stacks tagged <i>'.$this->request->params['named']['by']."</i>");
			}else{
				echo __('Your Stacks');
			}*/
		?></h2>-->
		<table cellpadding="0" cellspacing="0">
		<tr class="sort-bar">
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('title');?></th>
				<th><?php echo $this->Paginator->sort('description');?></th>
				<th><?php echo $this->Paginator->sort('color_id');?></th>
				<th><?php echo $this->Paginator->sort('user_id');?></th>
				<th><?php echo $this->Paginator->sort('created');?></th>
				<th><?php echo $this->Paginator->sort('modified');?></th>
		</tr>
		<tr class="the-cards">
			<!-- MAKE A NEW STACK CARD -->
			<td>
				<div class="card shadow" id="card-0" style="background: #ffffff">
					<span class="card-overlay">&nbsp;</span>
					<div class="card-data">
						<?php
							echo $this->Html->link(__('+ Make new stack'), array('controller'=>'stacks','action' => 'make'),array('class'=>'title','id'=>'title-0'));
						?>
						<!--<p class="description"><?php //echo $stack['Stack']['description']; ?></p>-->
						<div class="tags">
							<ul id="tagcloud">
								<li class="tag">Double Integrals, Iterated Integrals, Limits, Continuity, Stoke’s Theorem</li>
							</ul>
						</div>
					</div>
				</div>
			</td>
		<?php
		$counter = 1;
		foreach ($user_stacks as $stack): 
			echo $this->element('stack-card',array('cache'=>false,'counter'=>$counter,'data'=>$stack));
		$counter += 1; //Increment the counter
		endforeach; 
	?>
		</tr>
		</table>
		<div class="clear"></div>
		<p class="paging-details">
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
</div>
<?php
	echo $this->Html->script('card-utils');
?>