<?php

use App\Action\Auth\GetLoginAction;
use App\Action\Auth\LoginAction;
use App\Action\Auth\LogoutAction;
use App\Action\Product\AddProductAction;
use App\Action\Product\AddProductSoldAction;
use App\Action\Product\DeleteProductAction;
use App\Action\Product\GetAddProductAction;
use App\Action\Product\GetDeleteProductAction;
use App\Action\Product\GetProductAction;
use App\Action\Product\GetProductsAction;
use App\Action\Product\GetUpdateProductAction;
use App\Action\Product\UpdateProductAction;
use App\Action\Shopper\AddShopperAction;
use App\Action\Shopper\DeleteShopperAction;
use App\Action\Shopper\GetShoppersAction;
use App\Action\Shopper\UpdateShopperAction;

return [
    'database' => [
        'db' => 'mysql:host=localhost:3306;dbname=projectseminar',//создать бд с таким именем в майскл
        'user' => 'root',
        'password' => '1234',
    ],//массив с бд
    'actions' => [
        'get-product' => [
            'method' => 'GET',//проверит каким методом выполнен запрос
            'action' => GetProductAction::class, //когда к моему адресу пойдут -- этот запрос будет обрабатываться классом getproductaction
        ],
        'get-products' => [
            'method' => 'GET',
            'action' => GetProductsAction::class,
        ],
        'get-add-product' => [
            'method' => 'GET',
            'auth' => true,//для выполнения данного метогда пользователь должен войти
            'action' => GetAddProductAction::class,
        ],
        'add-product' => [
            'method' => 'POST',
            'auth' => true,
            'action' => AddProductAction::class,
        ],
        'get-update-product' => [
            'method' => 'GET',
            'auth' => true,
            'action' => GetUpdateProductAction::class,
        ],
        'update-product' => [
            'method' => 'POST',
            'auth' => true,
            'action' => UpdateProductAction::class,
        ],
        'get-delete-product' => [
            'method' => 'GET',
            'auth' => true,
            'action' => GetDeleteProductAction::class,
        ],
        'delete-product' => [
            'method' => 'POST',
            'auth' => true,
            'action' => DeleteProductAction::class,
        ],
        'add-product-sold' => [
            'method' => 'POST',
            'action' => AddProductSoldAction::class,
        ],
        'get-shoppers' => [
            'method' => 'GET',
            'action' => GetShoppersAction::class,
        ],
        'add-shopper' => [
            'method' => 'POST',
            'action' => AddShopperAction::class,
        ],
        'update-shopper' => [
            'method' => 'POST',
            'action' => UpdateShopperAction::class,
        ],
        'delete-shopper' => [
            'method' => 'DELETE',
            'action' => DeleteShopperAction::class,
        ],
        'get-login' => [
            'method' => 'GET',
            'action' => GetLoginAction::class,
        ],
        'login' => [
            'method' => 'POST',
            'action' => LoginAction::class,
        ],
        'logout' => [
            'method' => 'POST',
            'action' => LogoutAction::class,
        ],
    ],
];
