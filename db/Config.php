<?php

namespace App;

class Config{

    protected function getCredits(){
        $credits = [
            'host' => 'localhost',
            'db_name' => 'p_5',
            'user' => 'root',
            'pass' => ''
        ];
        return $credits;
    }
}