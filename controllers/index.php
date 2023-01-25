<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends Controller{

    function __construct() {
        parent::__construct();
        $this->view->css = array(
            'public/css/style.css'
            );
        $this->view->js = array(
            ''
            );
    }
    
    function index(){
        $this->view->title = 'Home | ALG Transport Logistics';
        $this->view->url = URL.'index';
        $this->view->image = '';
        $this->view->author = '';
        $this->view->description = '';
        $this->view->keywords = '';    
        $this->view->render('index/index');
    }

}