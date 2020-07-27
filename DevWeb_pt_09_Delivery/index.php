<?php
    session_start();
    require('deliveryController.php');
    require('deliveryModel.php');

    define('INCLUDE_PATH','http://localhost/Projetos-Back-end/DevWeb_pt_09_Delivery/');

    $deliveryController = new deliveryController();

    $deliveryController->index();
?>