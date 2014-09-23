<?php
class SourceXml extends SourceBase
{
    function loadData()
    {
        return simplexml_load_file(dirname(__FILE__) . '/../resources/data.xml');
    }
    
    function filterAndConvertData($rawData)
    {
        $result = array();
        foreach($rawData->children() as $item)
        {
            if($this->group_by && $this->group_by !== (string)$item->attributes()->Type) continue;
            
            $item = array('group' => (string)$item->attributes()->Type,
                          'code' => (string)$item->Code,
                          'name' => (string)$item->Description,
                          'price' => (string)$item->Value);
            
            if(Helper::match($this->filter_type, Helper::get($item, $this->filter_field), $this->filter_value))
            {
               $result[] = $item; 
            }
        }
    
        return $result;
    }
}
