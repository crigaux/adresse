<?php

    function testInput($input, $regex){
        if(empty($input)){
            return 'Champ obligatoire';
        } else {
            $isOk = filter_var($input, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regex)));
            if(!$isOk){
                return 'Champ invalide';
            } else {
                return 'true';
            }
        }
    }