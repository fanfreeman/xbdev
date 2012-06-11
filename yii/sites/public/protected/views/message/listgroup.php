<?php
if (count($datatest)>0)
{
	{
		foreach ($datatest as $ChatGroup)
		{
?>
        <li class="li_chatgroup" onclick="loadAtomMessages('<?php echo $ChatGroup['messageGroup']['all_members'];?>','<?php echo $ChatGroup['other_members'];?>','<?php echo $ChatGroup['message_group_id'];?>','<?php echo $ChatGroup['last_message_id'];?>')" id="li_chatgroup_<?php echo $ChatGroup['message_group_id'];?>">
            <span class="ball"></span>
            <span class="tips">2</span>
            <a 
            <?php
            if ($ChatGroup['avatar']!='/images/peoplegroup.png'){ echo "href=\"".Yii::app()->createUrl('Profile/Index',array('uid'=>$ChatGroup['other_members']))."\"";}
			?> title="<?php echo $ChatGroup['messageGroup']['all_members'];?>"><img src="<?php echo $ChatGroup['avatar'];?>" class="userPhoto fl" alt="" /></a>
            <aside class="fl">
                <h6 class="Rows">
                    <?php
                    $str_names = implode(',',$ChatGroup['array_name_other_members']);
					?>
                    <a title="<?php echo $str_names;?>"><?php echo $str_names;?></a>
                </h6>
                <p class="Rows p_last_message"><?php echo CHtml::encode($ChatGroup['lastMessage']['message']);?></p>
            </aside>
            <div class="ClearBoth"></div>
        </li>
<?php
		}
	}
}
?>

