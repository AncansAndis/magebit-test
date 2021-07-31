<?php

$router = new \Framework\Router();

use Controller\ItemController;

$router->get('index', function(){
    (new ItemController())->index();
});

$router->post('subscribe', function (){
    (new ItemController())->subscribe();
});

$router->get('subscribed', function (){
    (new ItemController())->subscribed();
});

$router->render('admin', function (){
    (new ItemController())->admin();
});

$router->notFound(function(){
    header('Location: /?page=index');
});

$router->dispatch('page');
