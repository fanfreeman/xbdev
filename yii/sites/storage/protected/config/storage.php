<?php

return  array(
      'servers' => array(
	      '/test1',
	      '/test2',
	      '/test3',
	      '/test4',
	      '/test5',
	  ),
	  'readDatebases' => array(
	      Yii::app()->db, Yii::app()->db, Yii::app()->db
	  ),
	  'writeDatebases' => array(
	      Yii::app()->db
	  )
);

?>