<?php

use core\App;

App::$collector->group(['before' => 'auth'], function ($router) {
    App::$collector->group(['prefix' => 'admin'], function ($router) {
        App::$collector->get('product/download', ['workspace\modules\product\controllers\ProductController', 'actionDownload']);
        App::$collector->gridView('product', ['workspace\modules\product\controllers\ProductController']);
        App::$collector->get('category/download', ['workspace\modules\product\controllers\CategoryController', 'actionDownload']);
        App::$collector->gridView('category', ['workspace\modules\product\controllers\CategoryController']);
        App::$collector->gridView('attribute', ['workspace\modules\product\controllers\AttributeController']);
        App::$collector->gridView('attrvalue', ['workspace\modules\product\controllers\AttrValueController']);
        App::$collector->gridView('virtualproductattr', ['workspace\modules\product\controllers\VirtualProductAttrController']);
        //App::$collector->get('product',['workspace\modules\product\controllers\ProductController','actionIndex']);
    });
});

//App::$collector->get('catalog', ['workspace\modules\product\controllers\TestFrontController', 'actionCatalog']);
App::$collector->get('catalog/{page:i}?', ['workspace\modules\product\controllers\TestFrontController', 'actionCatalog']);
App::$collector->any('testfront/order/{id}', ['workspace\modules\product\controllers\TestFrontController', 'actionOrder']);
App::$collector->any('testfront/cart/{id}', ['workspace\modules\product\controllers\TestFrontController', 'actionCart']);
App::$collector->any('testfront/oneproduct/{id}', ['workspace\modules\product\controllers\TestFrontController', 'actionOneProduct']);