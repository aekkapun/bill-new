<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/8/12
 * Time: 12:48 PM
 * To change this template use File | Settings | File Templates.
 */
class TransitionForm extends CFormModel
{
    public $sumMax;

    public function rules()
    {
        return array(
            array('sumMax', 'required'),
            array('sumMax', 'numerical'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'sumMax' => 'Верхнее ограничение',
        );
    }
}
