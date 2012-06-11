<?php
foreach ($dataComments as $comment)
{
?>
<li>
    <span class="time"><?php echo date("h:i:s",$comment['created']);?></span>
    <img src="<?php echo $comment['avatar'];?>" class="userPhoto fl" alt="<?php echo CHtml::encode($comment['firstname']).'&nbsp;'.CHtml::encode($comment['lastname']);?>" />
    <aside class="fl">
        <h6 class="Rows"><?php echo CHtml::encode($comment['firstname']).'&nbsp;'.CHtml::encode($comment['lastname']);?></h6>
        <p><?php echo $comment['content'];?></p>
    </aside>
    <div class="ClearBoth"></div>
</li>
<?php
}
?>