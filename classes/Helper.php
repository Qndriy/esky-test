<?php
class Helper
{
    static function match($filter, $str, $pattern_str)
    {
        switch ($filter)
        {
            case 'more':
                return $str > $pattern_str;
                break;
            case 'less':
                return $str < $pattern_str;
                break;
            case 'like':
                return preg_match('/' . $pattern_str . '/i', $str);
                break;
        }
        return false;
    }
    
    static function get($array, $key, $default = null)
    {
        if(array_key_exists($key, $array))
        {
            return $array[$key];
        } else {
            return $default;
        }
    }


    static $key;    
    static function sort($array, $key, $order)
    {
        Helper::$key = $key;
        if($key == 'unsorted' || !in_array($order, array('asc', 'desc'))) return $array;
        
        if(in_array($key, array('code', 'price', 'name')))
        {
            if($order === 'asc')
            {
                usort($array, function($a, $b) {
                    return $a[Helper::$key] > $b[Helper::$key];
                });
            } else {
                usort($array, function($a, $b) {
                    return $a[Helper::$key] < $b[Helper::$key];
                });
            }
        }
        return $array;
    }
}
