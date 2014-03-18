<?php
namespace Craft;

class LoathModel extends BaseModel
{
    public function defineAttributes()
    {
        return array(
            'word'          => array(AttributeType::String, 'maxLength' => 100, 'required' => true),
            'definition'    => array(AttributeType::String, 'column' => ColumnType::Text, 'required' => true),
        );
    }
}