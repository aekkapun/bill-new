<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/10/12
 * Time: 1:35 PM
 * To change this template use File | Settings | File Templates.
 */
class SubscriptionForm extends CFormModel
{

    public $sum;

    public function rules()
    {
        return array(
            array('sum', 'required'),
            array('sum', 'numerical'),
        );
    }

}
