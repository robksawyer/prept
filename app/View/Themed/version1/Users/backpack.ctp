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
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<tr>
			<!-- MAKE A NEW STACK CARD -->
			<td class="card" id="card-0" style="background: #ffffff">
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
			</td>
		<?php
		$counter = 1;
		foreach ($user_stacks as $stack): 
			echo $this->element('card',array('cache'=>false,'counter'=>$counter,'data'=>$stack));
		$counter += 1; //Increment the counter
		endforeach; 
	?>
		</tr>
		</table>
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
	<script type="text/javascript">
		//STACK RELATED SCRIPTS
		$(document).ready(function() {
			//Shrink the titles
			$('td.card a.title').each(function(){
				var maxFontSize = 24;
				var widthToFit = $('td.card').width() - (15*4); //15 = padding around each side
				if($(this).textWidth() > widthToFit){
					$(this).fitText(1.3, { minFontSize: '12px', maxFontSize: '24px' });
				}
			});

			//Make the full card clickable
			$('td.card').each(function(){
				//Set the initial opacity of the card
				$(this).css({"opacity": .7});

				var stackURL = $(this).find('a').attr('href');
				//Bind the click to the card
				$(this).click(function(){
					window.location.href = stackURL.toString();
				});

				//Change opacity of card on hover
				$(this).hover(function(){
					var id = $(this).attr('id').substring($(this).attr('id').length,$(this).attr('id').length-1);
					$(this).find('#card-detail-'+id).fadeIn();
					$(this).stop().animate({"opacity": 1});
				},function(){
					var id = $(this).attr('id').substring($(this).attr('id').length,$(this).attr('id').length-1);
					$(this).find('#card-detail-'+id).fadeOut();
					$(this).stop().animate({"opacity": .7});
				});
			});

		});
	</script>
	
</div>