    <!--  S= 循环体  -->
    <?php
    foreach($data as $contact)
        {
    ?>
            <li>  
                <a href="<?php echo Yii::app()->createUrl('profile/index',array('uid'=>$contact['user_id']));?>" title="<?php echo CHtml::encode($contact['firstname']).'&nbsp;'.CHtml::encode($contact['lastname']); ?>"><img src="<?php echo $contact['avatar'];?>" class="userPhoto fl" alt="" /></a>
                <aside class="fr">
                    <h6  class="userName Rows"><a href="<?php echo Yii::app()->createUrl('profile/index',array('uid'=>$contact['user_id']));?>" title="<?php echo CHtml::encode($contact['firstname']).'&nbsp;'.CHtml::encode($contact['lastname']); ?>"><?php echo CHtml::encode($contact['firstname']).'&nbsp;'.CHtml::encode($contact['lastname']); ?></a></h6>
                    <p class="userPosition Rows"><?php if (isset($contact['position'])) {echo CHtml::encode($contact['position']);}?></p>
                    <p class="userRemark Rows"><?php if (isset($contact['blurb'])) {echo CHtml::encode($contact['blurb']);} ?></p>
                </aside>
            </li>
    <?php
        }
    ?>
    <!--  E= 循环体  -->