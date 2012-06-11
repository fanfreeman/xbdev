<?php
foreach ($listchater as $user)
{
?>
<li class="imQuickLi" name="<?php echo CHtml::encode($user['firstname'].'&nbsp;'.$user['lastname']);?>" nameID="<?php echo $user['user_id'];?>">
<img src="<?php echo $user['avatar'];?>" class="userPhoto fl" alt="" />
<p class="userName fl"><?php echo CHtml::encode($user['firstname']).'&nbsp;'.CHtml::encode($user['lastname']);?></p>
</li>
<?php
}
?>