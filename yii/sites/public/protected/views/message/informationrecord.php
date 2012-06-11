		<section id="senderFrame" class="senderFrame fl" item_id="<?php echo $message_group_id;?>">
        	<div class="sendToTitle fl">To:</div>
            <ul class="senderShow fl">
            <?php
			            	foreach($data_other_members as $other_member)
				{
			?>
                <li class="nameShow">
                	<p class="fl"><a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$other_member['user_id']));?>"><?php echo CHtml::encode($other_member['firstname']).'&nbsp;'.CHtml::encode($other_member['lastname']);?></a></p>
                </li>
            <?php
           		}
			?>
            </ul>
            <!--  S=messageOperation [delete] [addPeople] -->
            <div id="messageOperation" class="fr">
                <!--<input type="button" class="deleteBtn fr" value="" />-->
               <!-- <input type="button" class="addBtn fr" value="" />-->
            </div><!--  E=messageOperation [delete] [addPeople]  -->
        </section>
		<ul class="messageList">
        <?php
		$this->renderPartial('messages',array('data' =>$dataMessages));
		?>
<!--        	<li class="others">
            	<a href="#" target="_blank" title="userName"><img src="images/peoplePic01.png" class="userPhoto fl" alt="" /></a>
                <aside class="message fl">
                	<p>So sorry! I haven't added a search function yet,So sorry! I haven't added a search function yet,So sorry! I haven't added a search function yet,<span class="datetime">18 Nov at 21:12</span></p>
                </aside>
            </li>-->
            
        </ul>
       	<section id="sendMessageFrame">
        	<input id="input_messagegroupid" type="hidden" value="<?php echo $message_group_id;?>"/>
            <input id="input_all_members" type="hidden" value="<?php echo $all_members;?>"/>
            <textarea class="sendText"></textarea>
        	<input type="button" class="sendBtn" value="" />
        </section>   
<script>
$(".sendBtn").click(function(){
	message_group_id = $('#input_messagegroupid').val();
	sendtext = $('.sendText').val();
	if (sendtext.length>0)
	{ 
		messageAjax('SendMessage','post',"<?php echo Yii::app()->createUrl('Message/SendMessage');?>",{message_sended : sendtext,message_group_id : message_group_id});
	}
});
$('.sendText').bind('keyup', function(event){
	if (event.keyCode=="13"){
		$('.sendBtn').click();
		$('.sendText').val('');
		}
	});	
</script>        
 