<?php

    namespace Controllers;
    use Controllers\ApiponenteController;

    class PonenteController{

        private ApiponenteController $api;

        public function __construct()
        {
            $this->api=new ApiponenteController();
        }


    }


?>