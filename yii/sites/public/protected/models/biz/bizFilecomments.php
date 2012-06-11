<?php
class bizFilecomments
{		

/**
     * 添加file评论
     * @param integer $intUserId the userid
	 * @param integer intfileId the fileid
	 * @param string strContent the filecomment content
     * @return integer intfileId the fileid or false
     */
    public static function addComment($intUserId, $infileId, $strContent)
    {  
        $objFilecomments = new FileComments;
        $objFilecomments->storage_file_index_id = $infileId;
        $objFilecomments->user_id = $intUserId;
        $objFilecomments->created = time();
        $objFilecomments->content = serialize($strContent);
        if (!$objFilecomments->save())
        {
            return false;
        }
		else
		{
			return  $infileId;
		}
    }

 /**
     * 获取file评论
	 * @param integer intfileId the fileid
     * return array(['data'] , ['num']) or false
     *         
     */        
    public static function getComments($intfileId)
    {
         $criteria = new CDbCriteria(array(
                'condition' => 'storage_file_index_id = '.$intfileId,
                'order' => 'created ASC'
          ));
        
        $Filecomments = new FileComments;
        $commentnum = $Filecomments->count($criteria);
        if($commentdata = $Filecomments->findAll($criteria)){
        $commentall = array();

            foreach($commentdata as $value) {
              $user_id= $value->user_id;
              $users=new AtomUsers;
              $userinfo=$users->findByPk($user_id);
              $temp['firstname'] =$userinfo->firstname;
              $temp['lastname'] = $userinfo->lastname;
              $temp['avatar'] = $userinfo->avatar;
              $temp['userid']= $value->user_id;
            /*  $createtime=$value->created;
              $time = intval(time())-intval($createtime)+1;
              $hour = floor($time/3600);
              $min = floor($time /60);
              if($time<60){
                       $temp['created']=$time.' seconds ago';
              }elseif($min<60){
                       $temp['created']=$min.' minutes ago';             
              }elseif($hour<24){
                       $temp['created']=$hour.' hours ago';
              }else{
                       $temp['created']=date("d/M",$value->created);
              }*/
              $temp['created']=bizTime::getTime($value->created);
              $temp['content']=$value->content;
              if($temp['content']) {
				  $temp['content']= unserialize($temp['content']);
                  }
              $commentall[] = $temp;
              }
              $commentdata=$commentall;


        return array(
            'data' => $commentdata,
            'num' => $commentnum
        );}else{
        return false;
        }
    }

}

