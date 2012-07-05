<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/10/12
 * Time: 1:52 PM
 * To change this template use File | Settings | File Templates.
 */
class PositionForm extends CFormModel
{

    public $created_at;

    public function rules()
    {
        return array(
            array('created_at', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'created_at' => 'Время создания'
        );
    }

}
