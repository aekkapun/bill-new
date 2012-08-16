<?php
/**
 * Created by JetBrains PhpStorm.
 * User: IliyaGoloveshko
 * Date: 8/15/12
 * Time: 22:59 PM
 * To change this template use File | Settings | File Templates.
 */

class OnetimeForm extends CFormModel
{
    public $name;
    public $cost;
    public $delivered_at;

    public function rules()
    {
        return array(
            array('name, cost, delivered_at', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'name' => 'Название',
            'cost' => 'Стоимость',
            'delivered_at' => 'Дата оказания',
        );
    }
}
