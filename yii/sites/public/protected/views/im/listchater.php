<ul>
	<?php
    foreach ($data as $chater)
    {
    ?>
        <li item_id="<?php echo $chater['user_id'];?>">
            <img src="<?php echo $chater['avatar'];?>" class="userPhoto fl" alt="" />
            <p class="userName fl"><?php echo CHtml::encode($chater['firstname']).'&nbsp;'. CHtml::encode($chater['lastname']);?></p>
        </li>
    <?php
    }
    ?>
</ul>
