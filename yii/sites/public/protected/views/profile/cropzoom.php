<p style="clear: both;"> just another example
 <h4>( some bug happens when you click the restore link , but take it easy just use one widget ,
                 you seldom use two instance in same view page !) ,may be the cropzoom original bug  </h4>
</p>
    <div>
        <p>
              <a href="javascript:;" id='cropTrigger'>crop image</a>
             <a href="javascript:;" onclick="cropZoom2.restore();">restore image</a>
 
        </p>
        <div id="crop_container2">
            the image will display here ...
        </div>
        <?php
 
$this->widget('ext.cropzoom.JCropZoom', 
                 array(
                    'id' => 'cropZoom2',
                    'callbackUrl'=>$this->createUrl('profile/handleCropZoom'),
                    'containerId'=>'crop_container2',
                    'cropTriggerId'=>'cropTrigger',
                    'image'=>array(
               'source'=>'http://a1.att.hudong.com/11/11/01300000334334123287112954864.jpg'
                                                                   )
                                                              ));
?>
  </div>