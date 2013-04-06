<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 8536 2011-03-01 04:43:10Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Custom_Widget_SponsorPopularController extends Engine_Content_Widget_Abstract
{
    public function indexAction()
    {
        // Get paginator
        $table = Engine_Api::_()->getDbtable('users', 'user')->getAdapter();
        $sql = 'SELECT A.sponsor_id, count(A.student_id) scholar, B.username, B.displayname,B.user_id
                FROM engine4_bgood_finance AS A, engine4_users AS B, engine4_bgood_sponsor AS C
                WHERE A.sponsor_id = C.sponsor_id AND B.user_id = C.user_id AND C.active=1
                GROUP BY sponsor_id ';
        $select = $table->query($sql)->fetchAll();
        foreach($select as $i=>$s)
        {
            $tmp =$table->query('SELECT storage_path FROM engine4_storage_files WHERE parent_id='.$s['user_id'].' AND parent_type="user" AND type="thumb.icon" ORDER BY creation_date DESC')->fetch();
            if($tmp['storage_path']!='')
            {
                $select[$i]['avatar'] = $tmp['storage_path'];
            }else{
                $select[$i]['avatar'] = 'application/modules/User/externals/images/nophoto_user_thumb_icon.png';
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