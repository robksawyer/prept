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
				echo "<div class='title-holder' style='display:none'>&nbsp;</div>";
				if(!empty($this->request->data['Stack']['title'])){
					echo $this->Form->input('title',array('label'=>false,'div'=>false,'maxlength'=>'35'));
				}else{
					echo $this->Form->input('title',array('value'=>'Title of Studycard','label'=>false,'div'=>false,'maxlength'=>'35'));
				}
				echo "<div class='color-panel'>";
				$attributes = array('legend'=>'Choose a stack color','value'=>7);
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
		<fieldset class="cards" id="cards">
			<?php
				for($i=0;$i<$totalCardsToStart;$i++){
					if(empty($this->request->data['Card'][$i]['front'])){
						$containsUserData = false;
					}else{
						$containsUserData = true;
					}
					if($i == ($totalCardsToStart-1)){
						echo $this->element('add-card',array('totalCardsToStart'=>$totalCardsToStart,'containsUserData'=>$containsUserData,'num'=>$i,'user_id'=>$current_user['id'],'showRemoveBtn'=>true));
					}else{
						echo $this->element('add-card',array('totalCardsToStart'=>$totalCardsToStart,'containsUserData'=>$containsUserData,'num'=>$i,'user_id'=>$current_user['id']));
					}
				}
			?>
		</fieldset>
		<?php
			$newCardNum = $totalCardsToStart;
			echo $this->Ajax->link('Add another card',array('controller'=>'ajax','action'=>'add_card','totalCardsToStart'=>$totalCardsToStart,'containsUserData'=>$containsUserData,'num'=>$newCardNum,'user_id'=>$current_user['id'],'showRemoveBtn'=>true),array('update'=>'cards','position' => 'append','complete'=>'updateCardFields()','class'=>'add-card'));
		?>
	<?php echo $this->Form->end(__('SAVE & STUDY'));?>
	</div>
</div>
<div class="clear"></div>
<?php echo $this->Html->script('colorBtnSelector'); ?>
<script type="text/javascript">
	var currentCardCount = <?php echo $totalCardsToStart; ?>;
	var maxCards = 15; //The total number of cards that a user can add at one time.
	//Clear fields on click
	var origColor = "#777777";
	var newColor = "#000000";
	var titleVal = $('.title > input').val();
	var titleWidth = '228px';
	var descriptionVal = $('.description > textarea').val();
	var tagVal = $('.tags > input').val();
	
	$(document).ready(function() {
		//Shrink the titles
		$('div.title div.title-holder').click(function(){
			$(this).hide();
			$('div.title > input').show();
		});
	
		$('div.title > input').focus(function(){
			if($(this).val() == titleVal) $(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == ''){
				$(this).val(titleVal);
				$(this).css({'color':origColor,'width':titleWidth});
			}else{
				$('div.title div.title-holder').text($(this).val());
				$('div.title div.title-holder').fitText(1);
				$(this).hide();
				$('div.title div.title-holder').show();
			}
		});
		//Description
		$('div.description > textarea').focus(function(){
			if($(this).val() == descriptionVal) $(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(descriptionVal);
				$(this).css({'color':origColor});
			}
		});
		//Tags
		$('div.tags > input').focus(function(){
			if($(this).val() == tagVal) $(this).val('');
			$(this).css({'color':newColor});
		}).blur(function(){
			if($(this).val() == '' || $(this).val() == ' '){
				$(this).val(tagVal);
				$(this).css({'color':origColor});
			}
		});
		
		applyCardMethods();
		
		$('div.stacks.top .stacks.form fieldset.cards div.card-input-container:nth-child(odd)').css('background', '#f2f2f2').addClass('odd');
		
	});
	
	function applyCardMethods(){
		var cardFrontVal = $('textarea#card-front-1').val();
		var cardBackVal = $('textarea#card-back-1').val();
		
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
	}
	
	/**
	* Remove one of the card fields. 
	*/
	function removeCardField(id){
		$('div.stacks.top .stacks.form fieldset.cards div#card-input-container-'+id).fadeOut(300,function(){
			$(this).remove();
		});
		//Show the x for the card that was above the card removed.
		$('div.stacks.top .stacks.form fieldset.cards div#card-input-container-'+(id-1)+' .remove').hide().css({'display':'inline'}).fadeIn(300,function(){
			$(this).removeClass('hidden');
		});
		
		currentCardCount -= 1;
	}
	
	/**
	* Apply js methods to the card input fields
	*/
	function updateCardFields(){
		if((currentCardCount+1) == maxCards){
			$('.stacks.form form .add-card').fadeOut();
		}
		//Show the x on the card that was added and hide the one above.
		$('div.stacks.top .stacks.form fieldset.cards div#card-input-container-'+(currentCardCount-1)+' .remove').fadeOut(300,function(){
			$(this).addClass('hidden');
		});
		
		applyCardMethods();
		//Update the alternating colors
		$('div.stacks.top .stacks.form fieldset.cards div.card-input-container:nth-child(odd)').css('background', '#f2f2f2').addClass('odd');
		
		currentCardCount += 1;
		
		return currentCardCount;
	}
</script>