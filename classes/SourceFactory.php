<?php
abstract class SourceFactory
{
    public static function create($params)
    {
        $extension = $params['datasource'];
        switch ($extension)
        {
            case 'php':
                return new SourcePhp($params);
                break;
            case 'json':
                return new SourceJson($params);
                break;                
            case 'xml':
                return new SourceXml($params);
                break;
        }

        throw new InvalidArgumentException('Appropriate datasource not found.');
    }
}
