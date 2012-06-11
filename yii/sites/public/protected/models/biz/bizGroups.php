<?php

class bizGroups
{
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
		if (empty($intGroup_id)) {
			return false;
		}
		$objGroups = Groups::model()->find('group_id = :group_id', array(':group_id' => $intGroup_id));
		if (empty($objGroups)) {
			return false;
		}
		return $objGroups->getAttributes();
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
        if (empty($array)) {
            return false;
        }
        $objGroups = new Groups;
        $objGroups->name = $array['name'];
        $objGroups->description = $array['description'];
        $objGroups->type = $array['type'];
        $objGroups->created = time();
    	if (!$objUser->save()) {
            return false;
        }
        	return $objUser->attributes['group_id'];
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
		if (empty($intGroup_id) || empty($array)) {
			return false;
		}
		if (!$arrayNew = array_intersect_key($array, array_fill_keys(array('name', 'description', 'type'), ''))) {
            return false;
        }
        if (!Groups::model()->updateAll($arrayNew, 'group_id = :group_id', array(':group_id' => $intGroup_id))) {
            return false;
        }
        
        return true;
	}

}