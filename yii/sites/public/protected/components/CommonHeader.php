<?php 
/**
  * RecentComments is a Yii widget used to display a list of recent comments
  */ 
class CommonHeader extends CWidget 
{
	public $array_user;
	public $current_page;

    public function init()
    {
       // $this->current_site = "this is a test of CWidget";
	   $user_id = Yii::app()->user->id;
	   $obj_user = new Users;
	   $data_user = $obj_user->findByPk($user_id);
	   $this->array_user = $data_user->getAttributes();
    }
 
    public function getcurrent_page()
    {
        return $this->current_page;
    }
 
    public function run() 
    {
        $this->render('commonHeader',array('current_page'=>$this->current_page,'array_user'=>$this->array_user));
    }
}