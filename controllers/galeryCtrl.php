<?php

    $isOnGalery = true;

    function galeryDisplay(){
        $dir_path = "public/assets/galery/";
    
        if(is_dir($dir_path)) {
            $files = scandir($dir_path);
    
            for ($i=0; $i < count($files); $i++) { 
                if($files[$i] != '.' && $files[$i] != '..') {
                    echo "<div><img src=\"$dir_path$files[$i]\" alt=\"Photo de plat du restaurant l'Annexe\"></div>";
                }
            }
        }
    }
    
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/galery.php');
    include(__DIR__ . '/../views/templates/footer.php');