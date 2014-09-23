<?php
class SourcePhp extends SourceBase
{
    function loadData()
    {
        return require dirname(__FILE__) . '/../resources/data.php';
    }
    
    function filterAndConvertData($rawData)
    {
        $rawData = new ArrayIterator($rawData);
        $result = array();
        
        foreach($rawData as $group => $items)
        {
            //apply grouping filter
            if($this->group_by && $this->group_by !== $group) continue;
            
            foreach($items as $currency => $details)
            {  
                switch($this->filter_field)
                {
                    case 'price':
                        $value_to_check = $details['value'];
                        break;
                    case 'code':
                        $value_to_check = $currency;
                        break;
                    case 'name':
                        $value_to_check = $details['name'];
                        break;
                    default:
                        $value_to_check = null;
                }
               //apply compoud filter          
               if(Helper::match($this->filter_type, $value_to_check, $this->filter_value))
               {
                    // convert to unified format
                    $result[] = array('group' => $group,
                                      'code' => $currency,
                                      'name' => $details['name'],
                                      'price' => $details['value']); 
               }
            }
        }
        return $result;
    }
}
