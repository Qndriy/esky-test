<?php
class SourceJson extends SourceBase
{
    function loadData()
    {
        return file_get_contents(dirname(__FILE__) . '/../resources/data.json');
    }
    
    function filterAndConvertData($rawData)
    {
        $iterator = new ArrayIterator(json_decode($rawData));
        $result = array();
        foreach($iterator as $item)
        {
            if($this->group_by && $this->group_by !== $item[3]) continue;
            
                        
            $item = array('group' => $item[3],
                          'code' => $item[0],
                          'name' => $item[1],
                          'price' => $item[2]);
            
            if(Helper::match($this->filter_type, Helper::get($item, $this->filter_field), $this->filter_value))
            {
               $result[] = $item; 
            }
        }
        
        return $result;
    }
}
