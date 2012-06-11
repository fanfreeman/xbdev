<?php

/*
 * This file is part of the Geek-Zoo Projects.
 *
 * @copyright (c) 2010 Geek-Zoo Projects More info http://www.geek-zoo.com
 * @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License
 * @author xuanyan <xuanyan@geek-zoo.com>
 *
 */

interface ResourceInterface
{
    public function getTitle($resource_id);
    
    public function getUrl($resource_id);
    
    public function formatFeed($resource_id, $param);
    
    public function formatNotification($resource_id);
    
    public function getContent($resource_id);
}


?>