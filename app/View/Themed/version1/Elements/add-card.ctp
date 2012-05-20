<?php
if(empty($showRemoveBtn)) $showRemoveBtn = false;
echo "<div class='card-input-container' id='card-input-container-".$num."'>";
echo "<div class='num'>".($num+1).".</div>";
if(!empty($containsUserData)){
	echo $this->Form->input('Card.'.$num.'.front',array('label'=>false,'class'=>'card-front','id'=>'card-front-'.$num));
	echo $this->Form->input('Card.'.$num.'.back',array('label'=>false,'class'=>'card-back','id'=>'card-back-'.$num));
}else{
	echo $this->Form->input('Card.'.$num.'.front',array('label'=>false,'value'=>'Enter the term here. Press tab to go to next input box.','class'=>'card-front','id'=>'card-front-'.$num));
	echo $this->Form->input('Card.'.$num.'.back',array('label'=>false,'value'=>'Enter the definition here.','class'=>'card-back','id'=>'card-back-'.$num));
}
if($num > 0){
	if($showRemoveBtn == true){
		echo "<div class='remove' id='".$num."'>".$this->Ajax->link($this->Html->image('../img/common/x-16x16.png',array('border'=>0,'alt'=>'X','title'=>'Remove card')),array('controller'=>'ajax','action'=>'remove_card',$totalCardsToStart),array('escape'=>false,'complete'=>'removeCardField('.$num.')'))."</div>";
	}else{
		echo "<div class='remove hidden' id='".$num."'>".$this->Ajax->link($this->Html->image('../img/common/x-16x16.png',array('border'=>0,'alt'=>'X','title'=>'Remove card')),array('controller'=>'ajax','action'=>'remove_card',$totalCardsToStart),array('escape'=>false,'complete'=>'removeCardField('.$num.')'))."</div>";
	}
}
	
echo $this->Form->input('Card.'.$num.'.user_id',array('type'=>'hidden','value'=>$user_id));
echo "</div>";
?>