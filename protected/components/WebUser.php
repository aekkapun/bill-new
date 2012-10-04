<?php
/**
 *
 */
class WebUser extends CWebUser
{
    private $_model = null;

    public function getClient_id()
    {
        return $this->getState('client_id');
    }

    function getRole()
    {
        if ($user = $this->getModel()) {
            return $user->role;
        }
    }

    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}
