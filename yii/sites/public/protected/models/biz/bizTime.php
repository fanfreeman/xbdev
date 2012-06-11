<?php
class bizTime
{              
   /**
     * 获取历史时间
	 * @param integer $created the  Timestamp
     * return historical time
     *         
     */              
	public static function getTime($created)
	{
		$createtime=$created;
	    $time = intval(time())-intval($createtime)+1;
		$hour = floor($time/3600);
        $min  = floor($time /60);
        if($time<60){
              $temp=$time.' seconds ago';
        }elseif($min<60){
              $temp=$min.' minutes ago';             
        }elseif($hour<24){
              $temp=$hour.' hours ago';
        }else{
              $temp=date("d/M",$createtime);
              }
		$updateCreated=$temp;
		
		return $updateCreated;
	}	
}