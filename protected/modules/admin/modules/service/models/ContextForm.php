<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/8/12
 * Time: 2:48 PM
 * To change this template use File | Settings | File Templates.
 */
class ContextForm extends CFormModel
{

    public $budget;

    public $workPercent;

    public function rules()
    {
        return array(
            array('budget, workPercent', 'required'),
            array('budget', 'numerical'),
            array('workPercent', 'numerical', 'max' => 1, 'min' => 0),
        );
    }

    public function attributeLabels()
    {
        return array(
            'budget' => 'Бюджет',
            'workPercent' => 'Стоимость работ',
        );
    }

}
