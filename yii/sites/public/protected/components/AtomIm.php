<?php 
/**
  * RecentComments is a Yii widget used to display a list of recent comments
  */ 
class AtomIm extends CWidget 
{

    public function init()
    {
     Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/im.css');
	 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jQuery/im.js');
    }
 
    public function run() 
    {
		$listchater = Im::getListChater();
		$this->render('/im/listchater',$listchater);	
	}
}