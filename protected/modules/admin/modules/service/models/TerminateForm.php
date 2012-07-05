<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 7/3/12
 * Time: 10:09 AM
 * To change this template use File | Settings | File Templates.
 */
class TerminateForm extends CFormModel
{
    public $terminated_at;

    public $enabled = 0;

    public function rules()
    {
        return array(
            array('terminated_at, enabled', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'terminated_at' => 'Дата отключения',
            'enabled' => 'Активность',
        );
    }
}
