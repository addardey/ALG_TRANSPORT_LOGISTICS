<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class View {

    function __construct() {
        //echo 'This is the view';
    }
    
    public function render($name, $noInclude = false){
        if ($noInclude == true) {
            require 'views/' . $name . '.php';    
        }
        else {
            require 'views/partials/header.php';
            require 'views/partials/navigation.php';
            require 'views/' . $name . '.php';
            require 'views/partials/footer.php';    
        }
    }

}
