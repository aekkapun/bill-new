<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 07.11.12
 * Time: 15:30
 */
class LiveServiceAction extends CAction
{
    public function _getModelName()
    {
        $controllerName = get_class( $this->getController() );

        return substr( $controllerName, 0, strpos( $controllerName, 'Controller') ) . 'Input';
    }
}
