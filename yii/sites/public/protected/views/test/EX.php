<?php

       if(isset($_FILES['batchFile']) && $_FILES['batchFile']['error']==0)  
       {  
          spl_autoload_unregister(array('YiiBase','autoload'));  //注销YII的自动加载，采用手动导入，PHPexcel有自己的加载功dm能  
          include_once('PHPExcel.php');     //按照自己的路径导入类文件  
          include_once('PHPExcel/IOFactory.php');  
  
          $objPHPExcel = PHPExcel_IOFactory::load($_FILES['batchFile']['tmp_name']);           //导入上传的excel文件的数据逻辑  
          $objWorksheet = $objPHPExcel->getActiveSheet(0);                                               //获取excel中sheet(0)的数据  
          spl_autoload_register(array('YiiBase','autoload'));                                                      //重新启用YII的自动载入  
      
          $EXCEL_VALUE = array();  
          foreach ($objWorksheet->getRowIterator() as $row)                                             //遍历数据  
          {  
             $cellIterator = $row->getCellIterator();                      
             $cellIterator->setIterateOnlyExistingCells(true);  
                foreach ($cellIterator as $cell)   
                {  
                   $EXCEL_VALUE[] = $cell->getValue();  
                }  
          }  
		  $data = array();
		  $NumKey  = 0;
            for($i=0;$i<count($EXCEL_VALUE)/2;$i++)
			{
				for($j=0;$j<2;$j++)
				{
					$data[$i][] = $EXCEL_VALUE[$NumKey];
					$NumKey++;
				}
			}
	    $successNum = 0 ;
		for($i=0;$i<count($data);$i++){
	             $intUserId  = Yii::app()->user->id;
                 $intfileId  = intval($data[$i][0]);
                 $strContent = strval($data[$i][1]);
                 if($aa=bizFilecomments::addComment($intUserId, $intfileId, $strContent)){
                 	$successNum++;
                 }
		}
		echo "成功读入",$successNum,"条记录";
     }
?>