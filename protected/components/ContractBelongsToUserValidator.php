<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 08.11.12
 * Time: 18:55
 */
class ContractBelongsToUserValidator extends CValidator
{
    public $message = 'Выбранный договор не соответствует клиенту';


    protected function validateAttribute( $object, $attribute )
    {
        if( empty($object->client) )
        {
            return;
        }

        $contracts = CHtml::listData( $object->client->contracts, 'id', 'number' );
        $contractIDs = array_keys( $contracts );

        if( !in_array($object->$attribute, $contractIDs) )
        {
            $this->addError( $object, $attribute, $this->message);
        }
    }
}

