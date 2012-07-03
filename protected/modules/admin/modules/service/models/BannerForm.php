<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 7/3/12
 * Time: 9:35 AM
 * To change this template use File | Settings | File Templates.
 */
class BannerForm extends CFormModel
{

    public $budget;

    public function rules()
    {
        return array(
            array('budget', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'budget' => 'Бюджет',
        );
    }

}
