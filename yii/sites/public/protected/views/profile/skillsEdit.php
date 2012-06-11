<?php
foreach($user_skills as $user_skill)
	{
	?>
		<li id="skillsList_li_<?php echo $user_skill['user_skill_id'];?>">
		<p><a href="<?php echo Yii::app()->createUrl('directory/SearchDirectory',array('skill_id'=>$user_skill['skill_id']));?>"><?php echo CHtml::encode($user_skill['skill']);?></a></p>
        <a href="#" class="deleteName" title="delete Photography" item_id="<?php echo $user_skill['user_skill_id'];?>"></a>
		</li>
	<?php
	}
?>