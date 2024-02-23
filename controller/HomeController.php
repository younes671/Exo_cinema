<?php 
    namespace Controller;
    use Model\Connect;

    class HomeController
    {

        public function home()
        {
            require 'view/home.php';
        }
    }