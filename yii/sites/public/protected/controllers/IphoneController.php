<?php

class IphoneController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/iphone';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	//��ȡ�������б�
	public function actionIndex()
	{
		$user_id = '1'; //����
		$array_message = bizIm::checkMessage($user_id); 
		$all_members = bizMessage::makeAllMembers($array_message[0]['user_id'],$array_message[0]['other_members']);
		$str_allmembers = implode("_",$all_members);	;
		if($array_message)
		{
			$arrat_json['message_group_id'] = $array_message[0]['message_group_id'];
			$arrat_json['last_message_id'] = $array_message[0]['last_message_id'];
			$arraycondition = array();
			$arraycondition["since_id"] = $arrat_json['last_message_id'] +1;
			$array_messages = bizMessages::getListMessage($arrat_json['message_group_id'],$arraycondition);
			$output_str = "";
			foreach($array_messages['data'] as $message)
			{
				$output_str .=  $message['message'];
			}
			echo $output_str;
			//����Ϣ���Ϊ�Ѷ�
			bizIm::read_last_message_id($array_messages["data"][count($array_messages["data"])-1]["message_id"],$arrat_json['message_group_id'],$user_id);
		}
	}
		

}
