<?php
class GroupsController extends CController
{
    public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }
    
	/**
	 * 获取 用户组信息 getInfo()
	 * @param $intGroup_id 用户组ID
	 * @return array(
	 *			'group_id'=>用户组ID,
	 *			'name'=>用户组名,
	 *			'description'=>用户组描述,
	 *			'type'=>用户组类型,
	 *			'created'=>创建时间,
	 *		) or false
	 */
    public static function getInfo($intGroup_id)
    {
    	$intGroup_id = intval($intGroup_id);
    	try {
    		if (empty($intGroup_id)) {
    			throw new Exception("intGroup_id empty", 1);
    		}
    		if ($result = bizGroups::getInfo($intGroup_id)) {
    			throw new Exception("model error", 1);
    		}
    	} catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
    	}
    	return $result;
    }
    
	/**
	 * 创建 用户组 create()
	 * @param array(
	 *			'name'=>用户组名,
	 *			'description'=>用户组描述,
	 *			'type'=>用户组类型
	 *		)
	 * @return intGroup_id or false
	 */
	public static function create($array)
	{
		try {
    		if (!is_array($array)) {
                throw new Exception("param type not array", 1);
    		}
    		if (empty($array['name']) || empty('description') || empty('type')) {
    			throw new Exception("name or description or type empty", 1);
    		}
			if($array = array_intersect_key($array, array_fill_keys(array('name', 'description', 'type'), ''))) {
				throw new Exception("array function error", 1);
			}
    		if ($result = bizGroups::create($array)) {
    			throw new Exception("model error", 1);
    		}
		} catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
		}
		return $result;
	}
	
	/**
	 * 修改 group信息 update()
	 * @param $intGroup_id 用户组ID
	 *			array(
	 *				'name'=>新用户组名,
	 *				'description'=>新用户组描述,
	 *				'type'=>新用户组类型,
	 *			)
	 * @return true or false
	 */
	public static function update($intGroup_id, $array)
	{
		$intGroup_id = intval($intGroup_id);
		try {
    		if (!is_array($array)) {
                throw new Exception("param type not array", 1);
    		}
    		if (empty($array['name']) || empty('description') || empty('type')) {
    			throw new Exception("name or description or type empty", 1);
    		}
			if($array = array_intersect_key($array, array_fill_keys(array('name', 'description', 'type'), ''))) {
				throw new Exception("array function error", 1);
			}
    		if ($result = bizGroups::update($intGroup_id, $array)) {
    			throw new Exception("model error", 1);
    		}
		} catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
		}
		return $result;
	}
}