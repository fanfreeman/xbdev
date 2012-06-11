<?php



abstract class Model extends CActiveRecord
{
    function init()
    {
        // 判断db配置里,是否存在 db_模型名 db, 如果存在,db指向该db,否则使用默认db
        $strDb = 'db_'.strtolower(get_class($this));
        if (isset(Yii::app()->$strDb)) {
            self::$db = Yii::app()->$strDb;
        } else {
            self::$db = Yii::app()->db;
        }
    }
    
    public function tableName()
    {
        return '{{'.strtolower(get_class($this)).'}}';
    }
}

?>