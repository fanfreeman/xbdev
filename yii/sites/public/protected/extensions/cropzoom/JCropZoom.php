<?php
/**
 * Created by JetBrains PhpStorm.
 * User: yiqing
 * Date: 11-11-23
 * Time: 下午1:23
 * To change this template use File | Settings | File Templates.
 */

class JCropZoom extends CWidget
{
    /**
     * @var array
     */
    protected $defaultOptions = array(
        'width' => 400,
        'height' => 300,
        'bgColor' => '#CCC',
        'enableRotation' => true,
        'enableZoom' => true,
        'zoomSteps' => 10,
        'rotationSteps' => 10,
        /*
        'expose' => array(
             'slidersOrientation' => 'vertical',
            // 'zoomElement' => '#zoom',
            // 'rotationElement' => '#rot',
            // 'elementMovement' => '#movement' ,
        ), */
        'selector' => array(
            'centered' => true,
            'borderColor' => 'blue',
            'borderColorHover' => 'yellow',
            'aspectRatio' => false,
        ),
        'image' => array(
            'source' => 'http://www.cropzoom.com.ar/chicas1024.jpg',
            'width' => 1024,
            'height' => 768,
            'minZoom' =>10,
            'maxZoom' =>1000,
            'startZoom' => 100,
           // 'useStartZoomAsMinZoom' => true,
            'snapToContainer' => true,
        ),
    );
    /**
     * @var array
     * will pass to the cropzoom plugin for initialization
     * @see http://www.cropzoom.com.ar/?page_id=5
     */
    public $options = array();

    /**
     * @var string
     */
    public $containerId ;

    /**
     * @var string
     * some id  of  html element which can be a link or button
     */
    public $cropTriggerId = '';

    /**
     * @var string
     * the url address which handle the crop resize or rotate operation
     * example:  Yii::app()->createUrl('');
     */
    public $callbackUrl = '';

    /**
     * @var string
     * the js function which used to handle the server response after the server
     * end had settled the cropped image , normally the response is the cropped image url
     * you can display it in dialog or some html div element .
     */
    public $onServerHandled = 'js:function(response){
      alert("response from server end ,you should give you own  js function here! the response is ==> "+response);
    }';

    /**
     * @var bool
     * if  use the external css js source file
     */
    public $useExternalScripts = false;
    /**
     * @var string
     */
    protected $baseUrl = '';

    /**
     * @param $h
     * @param $n
     * @return bool
     * if $h  stars with $n
     *
     */
    protected function startsWith($h, $n)
    {
        return (false !== ($i = strrpos($h, $n)) &&
                $i === strlen($h) - strlen($n));
    }

    /**
     * @param bool $autoGenerate
     * @return string
     */
    public function getId($autoGenerate = true)
    {
        $id = parent::getId($autoGenerate);
        if ($this->startsWith($id, 'yw')) {
            return __CLASS__ . substr($id, 2);
        }
        return $id;
    }


    /**
     * @return void
     */
    public function init()
    {

        parent::init();
        $this->options = CMap::mergeArray($this->defaultOptions, $this->options);
        /*
        //the  image should be in proper Aspect ratio now i  do this in browser client with javascript 
         $newDim = $this->getNewDimension($this->options['image']['source'], $this->options['width'], $this->options['height']);
         $this->options['image']['width'] = $newDim['width'];
         $this->options['image']['height'] = $newDim['height'];
        $this->options['image']['x'] = $newDim['left'];
         $this->options['image']['y'] = $newDim['top'];
        echo __FILE__, print_r($newDim);
        */
    }

    /**
     * @param string $imageSource
     * @param int $targetWidth
     * @param int $targetHeight
     * @return array
     * calculate  the new dimension for the image
     */
    protected function getNewDimension($imageSource, $targetWidth = null, $targetHeight = null)
    {
        /*
        list($sourceWidth, $sourceHeight) = getimagesize($imageSource);

        $sourceRatio = $sourceWidth / $sourceHeight;
        $targetRatio = $targetWidth / $targetHeight;

        if ($sourceRatio < $targetRatio) {
            $scale = $sourceWidth / $targetWidth;
        } else {
            $scale = $sourceHeight / $targetHeight;
        }
        $resizeWidth = (int)($sourceWidth / $scale);
        $resizeHeight = (int)($sourceHeight / $scale);

        $cropLeft = (int)(($resizeWidth - $targetWidth) / 2);
        $cropTop = (int)(($resizeHeight - $targetHeight) / 2);
        */
        list($sourceWidth, $sourceHeight) = getimagesize($imageSource);

        if ($sourceWidth / $targetWidth < $sourceHeight / $targetHeight) {
            $newWidth = $targetWidth;
            $newHeight = $newWidth / $sourceWidth * $sourceHeight;
        } else {
            $newHeight = $targetHeight;
            $newWidth = $newHeight / $sourceHeight * $sourceWidth;
        }
        $marginTop = ($targetHeight - $newHeight) / 2;
        $marginLeft = ($targetWidth - $newWidth) / 2;
        // var_dump($resizeWidth, $resizeHeight, $cropLeft, $cropTop);
        return array(
            'left' => (int)$marginLeft,
            'top' => (int)$marginTop,
            'width' => (int)$newWidth,
            'height' => (int)$newHeight,
        );
    }

    /**
     * @return void
     * you can use the id passed to this widget
     * access the cropzoom api , please view the
     * generated javascript code .
     */
    public function  run()
    {
        if ($this->useExternalScripts == true) {
            $this->registerExternalClientScripts();
        } else {
            $this->publishAssets();
            $this->registerClientScripts();
        }

        if(empty($this->containerId)){
          /* throw new CException('you must give an image container id for using this widget,
            which just is a placeholder where this widget will be display');*/
           $this->containerId = __CLASS__.'_container_'.$this->id;
            echo "<div id='{$this->containerId}'></div>";
        }

        $options = CJavaScript::encode($this->options);
        $jsCode = <<<SETUP
        var cropZoomOptions4_{$this->id} = {$options};
        $("<img/>").attr("src","{$this->options['image']['source']}").load(function(){
        /*
        pic_real_width = this.width;   // Note: $(this).width() will not
        pic_real_height = this.height; // work for in memory images.
          */
             cropZoomOptions4_{$this->id}.image.width = this.width;
             cropZoomOptions4_{$this->id}.image.height =  this.height;
             // alert(cropZoomOptions4_{$this->id}.image.width+'|'+cropZoomOptions4_{$this->id}.image.height);
             //init the corpzoom
            {$this->id} = $('#{$this->containerId}').cropzoom(cropZoomOptions4_{$this->id});
         });

SETUP;
        $cs = Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->id, $jsCode, CClientScript::POS_READY);

        /**
         * if you didn't give an cropTriggerId , i  will use a Button to do that.
         */
        if (empty($this->cropTriggerId)) {
            $this->cropTriggerId = $this->id . '_crop_trigger';
            //here  generate the default trigger element:
            $defaultTriggerElement = CHtml::Button('crop it', array('id' => $this->cropTriggerId));
            echo $defaultTriggerElement;
            /*
            $defaultTriggerEleJs = <<<DTE
       $(#{$this->containerId}).parent().before('<p>{$defaultTriggerElement}</p>');
DTE;
         $cs->registerScript($this->cropTriggerId,$defaultTriggerEleJs,CClientScript::POS_READY);
            */
        }

        $this->listenCrop();
    }


    /**
     * @return JCropZoom
     * publish the plugin dir to the assets dir under the webRoot
     * then the css , js or image can be accessed from browser
     */
    public function publishAssets()
    {
        $assetsDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
        $this->baseUrl = Yii::app()->getAssetManager()->publish($assetsDir, false, -1, YII_DEBUG);
        return $this;
    }

    /**
     * @return \JCropZoom
     * register core jquery and cropzoom js file...
     * -------------------------------
     * -------------------------------
     */
    public function registerClientScripts()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($this->baseUrl . '/css/jquery-ui-1.7.2.custom.css')
                ->registerCssFile($this->baseUrl . '/css/jquery.cropzoom.css')
                ->registerCoreScript('jquery')
        //  ->registerScriptFile($this->baseUrl . '/js/jquery-1.6.2.min.js')
                ->registerScriptFile($this->baseUrl . '/js/jquery-ui-1.8.14.custom.min.js')
                ->registerScriptFile($this->baseUrl . '/js/jquery.cropzoom.js')
                ->registerScript('cropZoom_api_' . $this->id, 'var ' . $this->id . ';', CClientScript::POS_HEAD); //used to access the cropzoom api
        return $this;
    }

    /**
     * @return JCropZoom
     * just for test don't use this config in production
     */
    public function registerExternalClientScripts()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile('http://www.cropzoom.com.ar/wp-includes/cropzoom/jquery.cropzoom.css');
        $cs->registerCssFile('http://www.cropzoom.com.ar/wp-includes/cropzoom/jquery-ui-1.7.2.custom.css')
        // ->registerCoreScript('jquery')
                ->registerScriptFile('http://cropzoom.googlecode.com/svn/trunk/plugin/jquery-1.6.2.min.js')
                ->registerScriptFile('http://cropzoom.googlecode.com/svn/trunk/plugin/jquery-ui-1.8.14.custom.min.js')
                ->registerScriptFile('http://cropzoom.googlecode.com/svn/trunk/plugin/jquery.cropzoom.js')
                ->registerScript('cropZoom_api_' . $this->id, 'var ' . $this->id . ';', CClientScript::POS_HEAD); //used to access the cropzoom api
        return $this;
    }

    /**
     * @return void
     * register the js handler for the crop action
     */
    public function listenCrop()
    {
        $onServerCropped = CJavaScript::encode($this->onServerHandled);

        $jsListenCrop = <<<CROP_HANDLE
        $(function(){
        $("#{$this->cropTriggerId}").click(function(){
            {$this->getId()}.send('{$this->callbackUrl}','POST',{},{$onServerCropped});
           });
        });
CROP_HANDLE;

        Yii::app()->getClientScript()
                ->registerScript(__METHOD__ . '#' . $this->id, $jsListenCrop, CClientScript::POS_HEAD);
    }

    /**
     * @param $name
     * @param $value
     * @return void
     * magic method this assume that the not declared variable will
     * default pass to the cropZoom options variable.
     */
    public function __set($name, $value)
    {
        try{
            //shouldn't swallow the parent ' __set operation
            parent::__set($name,$value);
        }catch(Exception $e){
            $this->options[$name] = $value;
        }
    }

    /**
     * @static
     * @return CropZoomHandler
     * use this instance to handle the crop ,rotate or resize at php server end
     */
    public static function getHandler(){
        require_once(dirname(__FILE__).DIRECTORY_SEPARATOR .'CropZoomHandler.php');
        return new CropZoomHandler();
    }
}

