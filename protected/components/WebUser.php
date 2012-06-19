<?php
/**
 *
 */
class WebUser extends CWebUser
{
    public function getClient_id()
    {
        return $this->getState('client_id');
    }
}
