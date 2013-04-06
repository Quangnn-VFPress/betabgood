<?php
class Custom_Widget_MywidgetController extends Engine_Content_Widget_Abstract
{
    public function indexAction()
    {
        $users_table = Engine_Api::_()->getDbtable('users', 'user');
        $users_select = $users_table->select()->where('user_id = ?', 10);
        $super_admin = $users_table->fetchRow($users_select);
        $this->view->top_victim = $super_admin->username;
        $this->view->navigation = $navigation = 'Xin tài trợ trường hợp đặc biệt khó khăn';
    }
}
