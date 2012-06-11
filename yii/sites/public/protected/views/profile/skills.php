<ul id="skillsList">
<?php
foreach($user_skills as $user_skill)
{
?>
<li>
<p><a href="<?php echo Yii::app()->createUrl('directory/SearchDirectory',array('skill_id'=>$user_skill['skill_id']));?>"><?php echo CHtml::encode($user_skill['skill']);?></a></p>
</li>
<?php
}
?>
<div class="ClearBoth"></div>
</ul>