<?php


class Gd
{
    public $im     = null;
    public $width  = null;
    public $height = null;
    public $type = null;

    function __construct($data = null)
    {
        if (empty($data))
        {
            return true;
        }

        if (file_exists($data) && is_readable($data))
        {
            return $this->loadFile($data);
        }
        elseif (is_resource($data) && get_resource_type($data) == "gd")
        {
            return $this->loadResource($data);
        }
        else
        {
            return $this->loadData($data);
        }
    }

    public static function creat($width, $height, $color = '#FFFFFF')
    {
        $thumb = imagecreatetruecolor($width, $height);
        $color = ltrim($color, '#');
        if (strlen($color) == 3)
        {
            $color .= $color;
        }
        sscanf($color, "%2x%2x%2x", $red, $green, $blue);
        imagefilledrectangle($thumb, 0, 0, $width, $height, imagecolorallocate($thumb, $red, $green, $blue));

        return new self($thumb);
    }

    public function loadResource($im)
    {
        if (!is_resource($im) || !get_resource_type($im) == "gd")
        {
            return false;
        }

        $this->im     = $im;
        $this->width  = imagesx($im);
        $this->height = imagesy($im);

        return true;
    }

    public function loadData($filedata)
    {
        $im = imagecreatefromstring($filedata);

        return $this->loadResource($im);
    }

    public function loadFile($filename)
    {
        if (!file_exists($filename) || !is_readable($filename))
        {
            return false;
        }

        $info = getimagesize($filename);
        $type = image_type_to_extension($info[2], false);
        $this->type = $type;
        if ($type == "jpeg" && (imagetypes() & IMG_JPG))
        {
            $im = imagecreatefromjpeg($filename);
        }
        elseif ($type == "png" && (imagetypes() & IMG_PNG))
        {
            $im = imagecreatefrompng($filename);
            //imageSaveAlpha($im, true);
            //imagealphablending($im, false);
        }
        elseif ($type == "gif" && (imagetypes() & IMG_GIF))
        {
            $im = imagecreatefromgif($filename);
        }
        else
        {
            return false;
        }

        return $this->loadResource($im);
    }

	//重定图片大小
    public function resize($new_width, $new_height)
    {

		
		$dest = imagecreatetruecolor( $new_width, $new_height ); 
		
		//如果是支持透明颜色的GIF, PNG图片, 就在此做特殊处理
		if ( ($this->type == "png") || ($this->type == "gif") ) 
		{ 
			//将打开的原图像$this->im中的透明色设置为color
			$trnprt_indx = imagecolortransparent($this->im);
			
			//根据$trnprt_indx的值判断是否有透明色, 如果有
			if ($trnprt_indx >= 0) 
			{
				//返回透明图片的RED, GREEN, BLUE 和 alpha 值
				$trnprt_color = imagecolorsforindex($this->im, $trnprt_indx);
				
				//为新图像分配与上面同样的颜色资源, RGB颜色
				$trnprt_indx = imagecolorallocate($dest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				
				//透明颜色填充新图像
				imagefill($dest, 0, 0, $trnprt_indx);
				
				//设置新图像背景色为原透明色
				imagecolortransparent($dest, $trnprt_indx);		
			} elseif ($this->type == "png") {
				//关闭透明色混合模式(临时的)
				imagealphablending($dest, false);
				
				//(为新图像创建一个新的完全透明颜色), 最后一个值范围 0 - 127, 代表:不透明 - 完全透明
				$color = imagecolorallocatealpha($dest, 0, 0, 0, 127); 
				
				//用刚刚创建的新透明颜色作为背景
				imagefill($dest, 0, 0, $color); 
				
				//恢复混合的透明色	 
				imagesavealpha($dest, true); 
			}
		}
		
        if (imagecopyresampled($dest, $this->im, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height))
        {

            return $this->loadResource($dest);
        }

        return false;
    }

	//裁剪图片
    public function crop($x, $y, $w, $h)
    {
        $dest = imagecreatetruecolor($w, $h);
		
		if ( ($this->type == "png") || ($this->type == "gif") ) 
		{
			//将打开的原图像$this->im中的透明色设置为color
			$trnprt_indx = imagecolortransparent($this->im);
			
			//根据$trnprt_indx的值判断是否有透明色, 如果有
			if ($trnprt_indx >= 0) 
			{
				//返回透明图片的RED, GREEN, BLUE 和 alpha 值
				$trnprt_color = imagecolorsforindex($this->im, $trnprt_indx);
				
				//为新图像分配与上面同样的颜色资源, RGB颜色
				$trnprt_indx = imagecolorallocate($dest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
				
				//透明颜色填充新图像
				imagefill($dest, 0, 0, $trnprt_indx);
				
				//设置新图像背景色为原透明色
				imagecolortransparent($dest, $trnprt_indx);	
				
			} elseif ($this->type == "png") {
				//关闭透明色混合模式(临时的)
				imagealphablending($dest, false);
				
				//(为新图像创建一个新的完全透明颜色), 最后一个值范围 0 - 127, 代表:不透明 - 完全透明
				$color = imagecolorallocatealpha($dest, 0, 0, 0, 127); 
				
				//用刚刚创建的新透明颜色作为背景
				imagefill($dest, 0, 0, $color); 
				
				//恢复混合的透明色	 
				imagesavealpha($dest, true); 
			}
		}
		
        if (imagecopyresampled($dest, $this->im, 0, 0, $x, $y, $w, $h, $w, $h))
        {
            return $this->loadResource($dest);
        }

        return false;
    }

    public function merge(Gd $thumb, $left, $top)
    {
        imagealphablending($this->im, true);
        imageCopy($this->im, $thumb->im, $left, $top, 0, 0, $thumb->width, $thumb->height);

        return true;
    }

    public function merge_auto(Gd $thumb, $pct = 100)
    {
        $left = round(($this->width - $thumb->width) / 2);
        $top = round(($this->height - $thumb->height) / 2);
        imagealphablending($thumb->im, true);
        imagecopymerge($this->im, $thumb->im, $left, $top, 0, 0, $thumb->width, $thumb->height, $pct);
    }

    public function output($type = "jpeg", $quality = 80)
    {
        if ($type == "jpeg" && (imagetypes() & IMG_JPG))
        {
            //header("Content-Type: image/jpeg");
            imagejpeg($this->im, '', $quality);

            return true;
        }
        elseif ($type == "png" && (imagetypes() & IMG_PNG))
        {
            //header("Content-Type: image/png");
            imagepng($this->im);
            return true;
        }
        elseif ($type == "gif" && (imagetypes() & IMG_GIF))
        {
            //header("Content-Type: image/gif");
            imagegif($this->im);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function saveAs($filename, $type = "jpg", $quality = 90)
    {
        $dir = dirname($filename);
        if (!file_exists($dir))
        {
            @mkdir($dir, 0777, true);
        }
        if ($type == "jpg" && (imagetypes() & IMG_JPG))
        {
            return imagejpeg($this->im, $filename, $quality);
        }
        elseif ($type == "png" && (imagetypes() & IMG_PNG))
        {
            return imagepng($this->im, $filename, $quality);
        }
        elseif ($type == "gif" && (imagetypes() & IMG_GIF))
        {
            return imagegif($this->im, $filename);
        }
        else
        {
            return false;
        }
    }

    public function scale($new_width = null, $new_height = null)
    {
        if (!is_null($new_width) && is_null($new_height))
        {
            $new_height = round($new_width * $this->height / $this->width);
        }
        elseif (is_null($new_width) && !is_null($new_height))
        {
            $new_width = $this->width / $this->height * $new_height;
        }
        elseif(!is_null($new_width) && !is_null($new_height))
        {
            $width = round($new_height * $this->width / $this->height);
            if ($width > $new_width)
            {
                $new_height = round($new_width * $this->height / $this->width);
            }
            else
            {
                $new_width = $width;
            }
        }
        else
        {
            return false;
        }

        return $this->resize($new_width, $new_height);
    }

    public function scale_fill($new_width = null, $new_height = null)
    {
        if (!is_null($new_width) && is_null($new_height))
        {
            $new_height = $new_width;
        }
        elseif (is_null($new_width) && !is_null($new_height))
        {
            $new_width = $new_height;
        }

        $sw = $new_width;
        $sh = $new_height;

        $width = round($new_height * $this->width / $this->height);
        if ($width < $new_width)
        {
            $new_height = round($new_width * $this->height / $this->width);
        }
        else
        {
            $new_width = $width;
        }

        $this->resize($new_width, $new_height);
        $x = ($this->width - $sw) / 2;
        $y = ($this->height - $sh) / 2;

        $this->crop($x, $y, $sw, $sh);

        return true;
    }
}


/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
	private $temp;
	private $path;

	function __construct() {
		$input = fopen("php://input", "r");
		$this->temp = tmpfile();
		$realSize = stream_copy_to_stream($input, $this->temp);

		fclose($input);

		if ($realSize != $this->getSize()){
			//return false;
			throw new Exception('Uploaded file size error.');
		}

		$pathinfo = pathinfo($this->getName());
		$filename = md5($pathinfo['filename']);
		$ext = strtolower($pathinfo['extension']);
		$dir = Yii::app()->getRuntimePath() . '/avatar_upload/'.substr($filename, -4, 2).'/'.substr($filename, -2);
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		$this->path = $dir .'/'. $filename . $realSize . '.' . $ext;
	}
	
	function clean() {
		unlink($this->path);
	}

	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	function save() {
		touch($this->path);
		$target = fopen($this->path, "w");
		fseek($this->temp, 0, SEEK_SET);
		stream_copy_to_stream($this->temp, $target);
		fclose($target);
		$gd = new Gd($this->path);
		if (!$gd->scale_fill(100)) {
			return false;
		}
		$gd->saveAs($this->path);
		return substr($this->path, strlen(Yii::app()->getRuntimePath())-18);
	}

	function getName() {
		return $_GET['qqfile'];
	}

	function getSize() {
		if (isset($_SERVER["CONTENT_LENGTH"])){
			return (int)$_SERVER["CONTENT_LENGTH"];
		} else {
			throw new Exception('Getting content length is not supported.');
		}
	}
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {
	function getHash() {
		return md5_file($_FILES['qqfile']['tmp_name']).$this->getSize();
	}

	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	function save($path) {
		if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
			return false;
		}
		return true;
	}

	function getName() {
		return $_FILES['qqfile']['name'];
	}

	function getSize() {
		return $_FILES['qqfile']['size'];
	}
}

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/atom';
	public $mobileDevice= false;
	
	  function init()
		{
		   $array_admin = array(2,3,7,10,11);//2韩磊，3徐晨，7鹏飞，10李东，11邓威
		   $id_user = Yii::app()->user->id;
		   if(in_array($id_user,$array_admin))
		   {
			   if(isset($_SERVER['HTTP_USER_AGENT']))
				{
					$clientkeywords = array('nokia','sony','ericsson','mot','samsung',
					'htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel',
					'lenovo','iphone','ipod','blackberry','meizu','android','netfront',
					'symbian','ucweb','windowsce','palm','operamini','operamobi',
					'openwave','nexusone','cldc','midp','wap','mobile');
					// 从HTTP_USER_AGENT中查找手机浏览器的关键字
					if (preg_match("/(".implode('|',$clientkeywords).")/i",strtolower($_SERVER['HTTP_USER_AGENT'])))
					{
						$this->mobileDevice = true;
						$this->layout = '/layouts/mobile/atom';
					}
				}
		   }
		}
		
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	 /*
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','tinge'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{		$uid=$_GET["uid"];
			$objDirectory = new AtomUsers;
			$objData = $objDirectory->findByPk($uid);
			$user_info = $objData->getAttributes();
			$id_user = Yii::app()->user->id;
			$objFollows = new Follows;
			$user_info['follow_status'] = $objFollows->checkFollower($id_user,$user_info['user_id']);
			//$newsfeeds = bizUser::getUserFeed($uid,1);
			if ($user_info['user_id']==$id_user)
			{$user_info['edit'] = true;}
			else
			{$user_info['edit'] = false;}
			$user_skills = array();
			$skills = $objData->user_skills;
			foreach ($skills as $skills)
			{
				$temp_skill['user_skill_id']=  $skills->user_skill_id;
				$temp_skill['skill_id']=  $skills->skill_id;
				$temp_skill['skill']=  $skills->skill->skill;
				$user_skills[] = $temp_skill ;
			}
			if($user_info['position'])
			{
				$objGroups = new Groups;
				$objDataGroup = $objGroups->findByPk($user_info['position']);
				$user_info['father_id'] = $objDataGroup->group_id;
				$user_info['tree_level']=$objDataGroup->tree_level;
				$user_info['tree_id']=$objDataGroup->tree_id;
			}
			else
			{
				$user_info['father_id']='0';
				$user_info['tree_level']='0';
				$user_info['tree_id']='0';
			}
			$user_positions = Groups::getListPosition($user_info['position']);
			/*
			if ($objData->company)
			{
				$objCompany = new Groups;
				$datajCompany = $objCompany->findByPk($objData->company)->getAttributes();
				$user_info['companyName'] =$datajCompany['name'];
			}
			else
			{
				$user_info['companyName'] = "";
			}
			if ($objData->department)
			{
				$objCompany = new Groups;
				$datajCompany = $objCompany->findByPk($objData->department)->getAttributes();
				$user_info['departmentName'] =$datajCompany['name'];
			}
			else
			{
				$user_info['departmentName'] = "";
			}
			
			if ($objData->position)
			{
				$objCompany = new Groups;
				$datajCompany = $objCompany->findByPk($objData->position)->getAttributes();
				$user_info['positionName'] =$datajCompany['name'];
			}
			else
			{
				$user_info['positionName'] = "";
			}
			*/
			if(!$this->mobileDevice)
			{
				$this->render('index',array('user_info'=>$user_info,'user_skills'=>$user_skills,'user_positions'=>$user_positions));
			}
			else
			{
				$this->render('/profile/mobile/index', array('user_info'=>$user_info,'user_skills'=>$user_skills,'user_positions'=>$user_positions));
			}
			
    }
	/**
	 *这个方法用来修改用户个人信息
	 */		
	public function actionupdateUserInfo()	
	{   
		$Type = $_POST['columType'];
		$Val  = trim($_POST['columVal']);
		if ($Type != '' && $Val != '')
		{
            $user_id  = Yii::app()->user->id;
            $userInfo = new AtomUsers;
			if('user_name'==$Type){
				if(count(explode(" ",$Val))>1){
					$temp = explode(" ",$Val,2);
			        $firstname = $temp[0];
				    $lastname  = $temp[1];
				}elseif(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$Val))
				{
					$temp = bizCname::CfamilyName($Val);
				    $firstname  = $temp['firstname'];
			        $lastname   = $temp['lastname'];			         
				}else{
					$firstname = $Val;
					$lastname  = " ";
				}
				if($userInfo->updateByPk($user_id, array('firstname'=>$firstname,'lastname'=>$lastname)))
				{
					$users = $userInfo->findByPk($user_id);
                    $callback['success'] = true;
				    $callback['html']    = $this->renderPartial('userName',array('user_info'=>$users),true);
				}else{
					$callback['success'] = false;	
			        $callback['error'] = 'cant save '.$Type;	
				}
			}
			/*
			else if ($Type=='company'||$Type=='department'||$Type=='position')
			{
				$callback['success'] = true;
				$columVal = strtolower($_POST['columVal']);
				$objGroup = new Groups();
				$objGroup->name = $columVal;
				$objGroup->father_id = $_POST['father_id'];
				$group_id = $objGroup->getIdByGroupName();
		
				$userInfo->updateByPk($user_id, array($Type=>$group_id));
				
			}
			*/
			else{
				$userInfo->updateByPk($user_id, array($Type=>$Val));
				$callback['success'] = true;
			}           
		}else{
			$callback['success'] = false;	
			$callback['error'] = 'type or value is empty';
		}
		echo json_encode($callback);
	}
	public function actionupdateUserPosition()
	{
		$position = trim(strtolower($_POST['position']));
		$objGroup = new Groups();
		$objGroup->name = $position;
		$objGroup->father_id = $_POST['father_id'];
		$objGroup->tree_id = $_POST['tree_id'];
		$objGroup->tree_level = $_POST['tree_level'];
		$array_group = $objGroup->getIdByGroupName();
		$user_id  = Yii::app()->user->id;
        $userInfo = new AtomUsers;
		$userInfo->updateByPk($user_id, array('position'=>$array_group['group_id']));
		$callback['success'] = true;
		
		$callback['group_id'] = $array_group['group_id'];	
		$callback['tree_id'] = $array_group['tree_id'];	
		$callback['tree_level'] = $array_group['tree_level'];	
					
		$user_positions[]  = array('group_id'=>$array_group['group_id'],'name'=>$position,'father_id'=>$objGroup->father_id);
		$callback['html'] = $this->renderPartial('positionEdit',array('user_positions'=>$user_positions),true);
		echo json_encode($callback);
	}
	
	public function actiondelUserPosition()
	{
		$objUser = new AtomUsers();
		$id_user = Yii::app()->user->id;
		if($_POST['father_id']!=0)
		{
			$father_id = $_POST['father_id'];
			$objGroup = new Groups();
			$objData = $objGroup->findByPk($_POST['father_id']);
			$callback['group_id'] = $father_id;	
			$callback['tree_id'] = $objData->tree_id;
			$callback['tree_level'] = $objData->tree_level;
		}
		else
		{
			$father_id = NULL;
			$callback['group_id'] = '0';
			$callback['tree_id'] = '0';
			$callback['tree_level'] = '0';
		}
		if ($objUser->updateByPk($id_user, array('position'=>$father_id)))
		{
			$callback['success'] = true;
		}
		else
		{
			$callback['success'] = false;
		}
		echo json_encode($callback);
	}
	public function actionupdateUserSkill()
	{
		$skill = strtolower($_POST['skill']);
		$objSkill = new Skill();
		$objSkill->skill = $skill;
		$skill_id = $objSkill->getIdBySkill();
		
		$objUser_skills = new User_skills();
		$objUser_skills->user_id = Yii::app()->user->id;
		$objUser_skills->skill_id = $skill_id;
		
		if ($user_skill_id = $objUser_skills->save_user_skill())
		{
			$callback['success'] = true;	
			if ($user_skill_id !='already_add')
			{
				$callback['addSkill']=true;
				$user_skill['skill'] = $skill;
				$user_skill['skill_id'] = $skill_id;
				$user_skill['user_skill_id'] = $user_skill_id;
				$user_skills = array($user_skill);
				$callback['html'] = $this->renderPartial('skillsEdit',array('user_skills'=>$user_skills),true);
			}
			else
			{
				$callback['addSkill']=false;
			}
			//$callback['skill']['user_skill_id'] = $user_skill_id;	
		}
		else
		{
			$callback['success'] = false;	
			$callback['error'] = 'cant save your skill'.$skill ;	
		}
		echo json_encode($callback);
	}
	
	public function actiondelUserSkill()
	{
		$objUser_skills = new User_skills();
		if ( $objUser_skills->deleteByPk($_POST['user_skill_id']))
		{
			$callback['success'] = true;	
		}
		else
		{
			$callback['success'] = false;	
		}
		echo json_encode($callback);
	}
		
	/**
	 *这个方法是控制器中用来render()到视图的方法，可以根据个人需求去更改它
	 */
	public function actionCropZoom(){
        if(Yii::app()->request->getIsAjaxRequest()){
            //print_r($_POST);
            //die;
            Yii::import('ext.cropzoom.JCropZoom');
            $saveToFilePath = Yii::getPathOfAlias('webroot.assets').DIRECTORY_SEPARATOR .'cropZoomTest';
            JCropZoom::getHandler()->process($saveToFilePath,true)->process($saveToFilePath.'.jpeg');
            die($saveToFilePath);
        }
        $this->render('cropzoom');
    }

    /**
     * 这个方法是用来处理剪辑图片的方法
     */
     public function actionHandleCropZoom(){
        if(Yii::app()->request->getIsAjaxRequest()){
            //print_r($_POST);
            //die;
            Yii::import('ext.cropzoom.JCropZoom');
            $saveToFilePath = Yii::getPathOfAlias('webroot.assets').DIRECTORY_SEPARATOR .'cropZoomTest';
            JCropZoom::getHandler()->process($saveToFilePath,true)->process($saveToFilePath.'.jpeg');
            die('cropped file path : '.$saveToFilePath);
        }
    }
    
    /**
     * Convert file size string to number of bytes
     * @param string $str
     */
    private function toBytes($str){
    	$val = trim($str);
    	$last = strtolower($str[strlen($str)-1]);
    	switch($last) {
    		case 'g': $val *= 1024;
    		case 'm': $val *= 1024;
    		case 'k': $val *= 1024;
    	}
    	return $val;
    }
	
    public function actionUploadAvatar() {
    	error_reporting(E_ALL | E_STRICT);
    	ini_set('display_errors', 1);
    	
    	
    	//$arrResult = $objFileSystem->handleUpload($intUserId, $intDirId, $arrAllowedExtensions, $intSizeLimit);
    	//echo htmlspecialchars(json_encode($arrResult), ENT_NOQUOTES); // to pass data through iframe we need to encode all html tags
    	
    	
    	$allowedExtensions = array_map("strtolower", array("jpeg", "jpg", "gif", "png"));
    	$intSizeLimit = 2000 * 1024 * 1024; // max file size 2000M
    	// check server settings
    	$postSize = $this->toBytes(ini_get('post_max_size'));
    	$uploadSize = $this->toBytes(ini_get('upload_max_filesize'));
    	if ($postSize < $intSizeLimit || $uploadSize < $intSizeLimit){
    		$size = max(1, $intSizeLimit / 1024 / 1024) . 'M';
    		die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
    	}
    	
    	// create object for saving file
    	if (isset($_GET['qqfile'])) {
    		$file = new qqUploadedFileXhr();
    	} elseif (isset($_FILES['qqfile'])) {
    		$file = new qqUploadedFileForm();
    	} else {
    		return array('error' => 'No files were uploaded.');
    	}
    	
    	// check uploaded file size
    	$size = $file->getSize();
    	if ($size == 0) {
    		return array('error' => 'File is empty');
    	}
    	if ($size > $intSizeLimit) {
    		return array('error' => 'File is too large');
    	}
    	
    	// get uploaded file name
    	mb_internal_encoding("UTF-8");
    	$filename = $file->getName();
    	$dirname = mb_substr($filename, 0, strrpos($filename, '/'));
    	$basename = mb_substr($filename, strrpos($filename, '/'));
    	$extension = mb_substr(strrchr($filename, '.'), 1);
    	$filename = mb_substr($basename, 0, strrpos($basename, '.'));
    	
    	if ($allowedExtensions && !in_array(strtolower($extension), $allowedExtensions)){
    		$these = implode(', ', $allowedExtensions);
    		return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
    	}
		$file_path = $file->save();
		$objatomUser = new AtomUsers();
		$id_user = Yii::app()->user->id;
		
		$objatomUser->updateByPk($id_user, array('avatar'=>$file_path));

		echo json_encode(array('filepath'=>$file_path));exit;
    }
}
