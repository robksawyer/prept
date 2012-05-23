<?php
if(!empty($data['Card'])){
	$cardCount = count($data['Card']);
	if(empty($hideCardCount)){
		if($cardCount > 1){
			echo "<span class='card-count'>".$cardCount." cards</span>";
		}else{
			echo "<span class='card-count'>".$cardCount." card</span>";
		}
	}
}else{
	echo "<span class='card-count'>0 cards</span>";
}
echo $this->Html->link($this->Html->image('../img/common/twitter-icon-22x23.png',array('border'=>0,'width'=>'22','height'=>'23')),'#',array('escape'=>false));
echo $this->Html->link($this->Html->image('../img/common/settings-icon-23x23.png',array('border'=>0,'width'=>'23','height'=>'23')),'#',array('escape'=>false));
echo $this->Html->link($this->Html->image('../img/common/customers-icon-23x22.png',array('border'=>0,'width'=>'23','height'=>'22')),'#',array('escape'=>false));
echo $this->Html->link($this->Html->image('../img/common/heart-icon-23x21.png',array('border'=>0,'width'=>'23','height'=>'21')),'#',array('escape'=>false));
echo $this->Html->link($this->Html->image('../img/common/test-icon-22x23.png',array('border'=>0,'width'=>'22','height'=>'23')),array('controller'=>'stacks','action'=>'test',$data['Stack']['id']),array('escape'=>false));
?>