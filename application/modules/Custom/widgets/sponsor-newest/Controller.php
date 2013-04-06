<?php

/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 9264 2011-09-16 19:18:51Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Custom_Widget_SponsorNewestController extends Engine_Content_Widget_Abstract
{
    public function indexAction()
    {
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $sql = 'SELECT A.user_id, A.promote_date, B.displayname, B.username
            FROM engine4_bgood_sponsor AS A, engine4_users AS B
            WHERE A.user_id = B.user_id AND A.active=1
            ORDER BY promote_date DESC
            LIMIT 4';
        $select = $table->query($sql)->fetchAll();
        foreach ($select as $i => $s)
        {
            $tmp = $table->query('SELECT storage_path FROM engine4_storage_files WHERE parent_id=' .
                $s['user_id'] . ' AND parent_type="user" AND type="thumb.icon" ORDER BY creation_date DESC')->
                fetch();
            if ($tmp['storage_path'] != '')
            {
                $select[$i]['avatar'] = $tmp['storage_path'];
            }
            else
            {
                $select[$i]['avatar'] =
                    'application/modules/User/externals/images/nophoto_user_thumb_icon.png';
            }
        }
        $this->view->sponsor = $select;
        // Do not render if nothing to show
        if (count($select) <= 0)
        {
            return $this->setNoRender();
        }
    }
}
