<div class="stacks find">
<?php
	echo $this->Form->create('Stack', array(
	    'url' => array_merge(array('action' => 'find'), $this->params['pass'])
	));
	echo "<div class='title'>";
		if(!empty($this->request->data['Stack']['title'])){
			echo $this->Form->input('title',array('label'=>false,'div'=>false,'maxlength'=>'50'));
		}else{
			echo $this->Form->input('title',array('value'=>'Search the title','label'=>false,'div'=>false,'maxlength'=>'50'));
		}
	echo "</div>";
	echo "<div class='description'>";
	if(!empty($this->request->data['Stack']['description'])){
		echo $this->Form->input('description',array('div'=>false,'label'=>false));
	}else{
		echo $this->Form->input('description',array('div'=>false,'label'=>false,'value'=>'Search the description of the stack.'));
	}
	echo "</div>";
	$attributes = array('legend' => 'Select a color');
	echo "<div class='color-panel'>";
	echo $this->Form->radio('color_id',$colors,$attributes);
	echo "</div>";
	//echo $this->Form->input('user_id', array('div' => false));
	echo "<div class='tags'>";
	if(!empty($this->request->data['Stack']['tags'])){
		echo $this->Form->input('tags',array('label'=>false,'div'=>false));
	}else{
		echo $this->Form->input('tags',array('label'=>false,'value'=>'Search the tags, i.e., history, math.','div'=>false));
	}
	echo "</div>";
	echo $this->Form->submit(__('Search', true), array('div' => false));
	echo $this->Form->end();
?>
</div>
<div class="stacks results">
<?php
if($searched):	
	if(!empty($stacks)): 
?>
	<h2><?php echo __('Stack results'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
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
	<?php
	$counter = 0;
	foreach ($stacks as $stack): 
	?>
			<td class="card shadow" id="card-<?php echo $counter; ?>" style="<?php echo "background: #".$stack['Color']['hex']; ?>">
				<span class="card-overlay">&nbsp;</span>
				<div class="card-data">
					<?php
						echo $this->Html->link(__($stack['Stack']['title']), array('action' => 'view', $stack['Stack']['id']),array('class'=>'title','id'=>'title-'.$counter))
					?>
					<!--<p class="description"><?php //echo $stack['Stack']['description']; ?></p>-->
					<div class="tags">
						<ul id="tagcloud">
							<?php 
								foreach ($stack['Tag'] as $tag) {
									//echo '<li class="tag">'.$this->Html->link($tag['name'],array('controller'=>'stacks','action'=>'index','by'=>$tag['keyname'])).'</li>';
									echo '<li class="tag">'.$tag['name'].'</li>';
								}
							?>
						</ul>
					</div>
				</div>
			</td>
<?php 
	$counter += 1; //Increment the counter
	endforeach; 
?>
	</tr>
	</table>
	<p>
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
<?php else: ?>
	
	<h2><?php echo __('No results found.'); ?></h2>
<?php 
	endif; 
endif;
?>
<?php echo $this->Html->script('colorBtnSelector'); ?>
<script type="text/javascript">

	$(document).ready(function() {
		//Clear fields on click
		var origColor = "#777777";
		var newColor = "#000000";
		var titleVal = $('.title > input').val();
		var descriptionVal = $('.description > textarea').val();
		var tagVal = $('.tags > input').val();
		$('div.title > input').focus(function(){
			$(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(titleVal);
				$(this).css({'color':origColor,'width':titleWidth});
			}
		});
		//Description
		$('div.description > textarea').focus(function(){
			$(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(descriptionVal);
				$(this).css({'color':origColor});
			}
		});
		//Tags
		$('div.tags > input').focus(function(){
			$(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(tagVal);
				$(this).css({'color':origColor});
			}
		});
		
		//Shrink the titles
		$('.stacks.results td.card a.title').each(function(){
			var maxFontSize = 24;
			var widthToFit = $('td.card').width() - (15*4); //15 = padding around each side
			var textWidth = 0;
			//http://stackoverflow.com/questions/9404536/finding-text-width-in-jquery
			$(this).clone().addClass("checkWidth")
			.appendTo("body").css({"float": "left"});
			textWidth = $(".checkWidth").width();
			$('.checkWidth').remove();
			if(textWidth > widthToFit){
				$(this).fitText(1, { minFontSize: '9px', maxFontSize: '15px' });
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
				$(this).stop().animate({"opacity": 1});
			},function(){
				$(this).stop().animate({"opacity": .7});
			});
		});
	});
</script>
