<div id="directoryPage" data-role="page" data-title="Directory">
  <div data-role="header" >
    <h1>Directory</h1>
  </div>
  <div data-role="content">
  	<ul data-role="listview" data-filter="true" data-inset="true">
    <!--  S= 循环体  -->
    <?php
    foreach($data['data'] as $contact)
        {
    ?>
            <li>  
                <a href="<?php echo Yii::app()->createUrl('/profile/index',array('uid'=>$contact['user_id']));?>" data-ajax="false">
                    <img src="<?php echo $contact['avatar'];?>" />
                    <h6><?php echo CHtml::encode($contact['firstname']).' '.CHtml::encode($contact['lastname']); ?></h6>
                    <p><?php if (isset($contact['position'])) {echo CHtml::encode($contact['position']);}?></p>
                    <p><?php if (isset($contact['blurb'])) {echo CHtml::encode($contact['blurb']);} ?></p>
                </a>
            </li>
    <?php
        }
    ?>
    <!--  E= 循环体  -->
    </ul>
  </div>
</div>