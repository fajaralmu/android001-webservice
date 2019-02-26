<?php
class ExpiredException extends \UnexpectedValueException
{
    public function __construct(){
        echo json_encode(array('status'=>false));
        exit();
    }
}