<?php

    spl_autoload_register(function ($class) {
        require_once 'classes/' . $class . '.php';
    });
        
    header('Content-Type: application/json; charset=utf-8');
    try {
        $obj = SourceFactory::create($_GET);
        echo json_encode(array('status' => true, 'data' => $obj->getData()));
    } catch (Exception $e) {
        echo json_encode(array('status' => false, 'message' => $e->getMessage()));
    }

