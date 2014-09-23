<?php
abstract class SourceBase
{
    protected $group_by;
    protected $filter_field;
    protected $filter_type;
    protected $filter_value;
    protected $sort_by;

    function __construct($params)
    {
        $this->group_by = (Helper::get($params, 'group_by') && $params['group_by'] !== 'all') ?$params['group_by'] :null;
        $this->filter_field = Helper::get($params, 'filter_field');
        $this->filter_type = Helper::get($params, 'filter_type');
        $this->filter_value = Helper::get($params, 'filter_value');
        $this->sort_by = Helper::get($params, 'sort_by');
        $this->sort_order = Helper::get($params, 'sort_order', 'asc');
    }
    
    function getData()
    {
        // load data and convert to single format
        $rawData = $this->loadData();
        
        //apply grouping/filters and convert to unified format
        return Helper::sort($this->filterAndConvertData($rawData), $this->sort_by, $this->sort_order);
    }
    
    protected abstract function loadData();
       
    protected abstract function filterAndConvertData($rawData);
       
}
