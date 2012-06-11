<?php
foreach($user_positions as $user_position)
{
?>
    <li id="li_user_position_father_id_<?php echo $user_position['father_id'];?>">
        <p><a href="<?php echo Yii::app()->createUrl('directory/SearchDirectory',array('group_id'=>$user_position['group_id']));?>"><?php echo $user_position['name'];?></a></p>
    </li>
<?php
}
?>