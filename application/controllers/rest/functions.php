<?php
    spl_autoload_register(function($namaKelas){
        $path = APPPATH.'/controllers/rest/'.strtolower($namaKelas).'.php';
        
        if(file_exists($path)){
            require_once($path);
        }else{
            echo 'File '.$path.' tidak ada';
        }
    })
?>