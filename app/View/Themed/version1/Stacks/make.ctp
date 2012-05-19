<div class="stacks top">
	<div class="stacks form">
		<div class="information">
			<h1>Make Studycards</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at sapien lorem, eget imperdiet augue. Cras consectetur est at velit placerat at semper dolor rutrum. Aenean non est arcu. Curabitur mollis posuere augue id tincidunt. Curabitur laoreet massa sed augue.
			</p>
		</div>
		<?php echo $this->Form->create('Stack');?>
		<fieldset class="stacks">
		<?php
			echo "<div class='title'>";
			//echo $this->Form->input('title',array('value'=>'Title of Studycard','label'=>false,'div'=>false,'onkeypress'=>'this.style.width = ((this.value.length + 1) * 11) + "px";','maxlength'=>'50'));
			if(!empty($this->request->data['Stack']['title'])){
				echo $this->Form->input('title',array('label'=>false,'div'=>false,'maxlength'=>'50'));
			}else{
				echo $this->Form->input('title',array('value'=>'Title of Studycard','label'=>false,'div'=>false,'maxlength'=>'50'));
			}
			$attributes = array('legend' => 'Choose a stack color');
			echo "<div class='color-panel'>";
			echo $this->Form->radio('color_id',$colors,$attributes);
			echo "</div>";
			echo "</div>";
			echo "<div class='top right'>";
			echo "<div class='description'>";
			if(!empty($this->request->data['Stack']['description'])){
				echo $this->Form->input('description',array('div'=>false,'label'=>false));
			}else{
				echo $this->Form->input('description',array('div'=>false,'label'=>false,'value'=>'Write a short description of your stack. This helps identify the stack for you and your friends.'));
			}
			echo "</div>";
			echo "<div class='tags'>";
			if(!empty($this->request->data['Stack']['tags'])){
				echo $this->Form->input('tags',array('label'=>false,'div'=>false));
			}else{
				echo $this->Form->input('tags',array('label'=>false,'value'=>'Enter optional subjects, i.e., history, math.','div'=>false));
			}
			echo "</div>";
			echo "</div>";
			echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$current_user['id']));
		?>
		</fieldset>
		<div class="clear"></div>
		<fieldset class="cards">
			<?php
				$totalCardsToStart = 5;
				for($i=0;$i<$totalCardsToStart;$i++){
					echo "<div class='card-input-container' id='card-input-container-".$i."'>";
					echo "<div class='num'>".($i+1).".</div>";
					if(!empty($this->request->data['Card'][$i]['front'])){
						echo $this->Form->input('Card.'.$i.'.front',array('label'=>false,'class'=>'card-front','id'=>'card-front-'.$i));
						echo $this->Form->input('Card.'.$i.'.back',array('label'=>false,'class'=>'card-back','id'=>'card-back-'.$i));
					}else{
						echo $this->Form->input('Card.'.$i.'.front',array('label'=>false,'value'=>'Enter the term here. Press tab to go to next input box.','class'=>'card-front','id'=>'card-front-'.$i));
						echo $this->Form->input('Card.'.$i.'.back',array('label'=>false,'value'=>'Enter the definition here.','class'=>'card-back','id'=>'card-back-'.$i));
					}
					echo $this->Form->input('Card.'.$i.'.user_id',array('type'=>'hidden','value'=>$current_user['id']));
					echo "</div>";
					//echo "<div class='clear'></div>";
				}
			?>
		</fieldset>
	<?php echo $this->Form->end(__('SAVE & STUDY'));?>
	</div>
</div>
<div class="clear"></div>
<?php echo $this->Html->script('colorBtnSelector'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		//Shrink the titles
		/*$('div.title > input').keyup(function(){
			var maxFontSize = 24;
			var widthToFit = $(this).width(); //15 = padding around each side
			if($(this).width() > widthToFit){
				$('div.title').fitText(1);
			}
		});*/
		
		//Clear fields on click
		var origColor = "#777777";
		var newColor = "#000000";
		var titleVal = $('.title > input').val();
		var titleWidth = '228px';
		var descriptionVal = $('.description > textarea').val();
		var tagVal = $('.tags > input').val();
		var cardFrontVal = $('textarea#card-front-1').val();
		var cardBackVal = $('textarea#card-back-1').val();
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
		
		//Cards
		$('fieldset.cards .card-input-container').each(function(){
			$(this + '.textarea textarea.card-front').focus(function(){
				$(this).val('');
				$(this).css({'color':newColor});
			}).blur(function(){
				if($(this).val() == '' || $(this).val() == ' '){
					$(this).val(cardFrontVal);
					$(this).css({'color':origColor});
				}
			});
		});
		$('fieldset.cards .card-input-container').each(function(){
			$(this + '.textarea textarea.card-back').focus(function(){
				$(this).val('');
				$(this).css({'color':newColor});
			}).blur(function(){
				if($(this).val() == '' || $(this).val() == ' '){
					$(this).val(cardBackVal);
					$(this).css({'color':origColor});
				}
			});
		});
		
		$('div.stacks.top .stacks.form fieldset.cards div.card-input-container:nth-child(odd)').css('background', '#f2f2f2').addClass('odd');

	});
</script>