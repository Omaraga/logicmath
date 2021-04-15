<?php

return array(

    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/recovery' => 'user/recovery',
//    /cabinet/getTasks
    'cabinet/razdel/checkAns' => 'razdel/checkAns',

    'cabinet/razdel/([0-9]+)/([0-9]+)' => 'razdel/index/$1/$2',


    //Рейтинг
    'cabinet/rating/([0-9]+)/page-([0-9]+)' => 'cabinet/rating/$1/$2',
    'cabinet/rating/page-([0-9]+)' => 'cabinet/rating/0/$1',
    'cabinet/rating' => 'cabinet/rating',
    'cabinet/getTasks' => 'cabinet/GetTasks',
    'cabinet/edit' => 'cabinet/edit',

    'cabinet' => 'cabinet/index',
    'progress' =>'progress/index',
    'profile' => 'profile/index',


    // Управление задачами
    'admin/task/create' => 'adminTask/create',
    'admin/task/update/([0-9]+)' => 'adminTask/update/$1',
    'admin/task/delete/([0-9]+)' => 'adminTask/delete/$1',
    'admin/task/getRazdel' => 'adminTask/getRazdel',
    'admin/task/getLevel' => 'adminTask/getLevel',
    'admin/task' => 'adminTask/index',

    // Управление задачами
    'admin/request/create' => 'adminRequest/create',
    'admin/request/delete/([0-9]+)' => 'adminRequest/delete/$1',
    'admin/request' => 'adminRequest/index',
    // Управление сертифкатами
    'admin/cert/create' => 'adminCertificate/create',
    'admin/cert/update/([0-9]+)' => 'adminCertificate/update/$1',
    'admin/cert/delete/([0-9]+)' => 'adminCertificate/delete/$1',
    'admin/cert' => 'adminCertificate/index',
    // Управление категориями:
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление классами:
    'admin/klass/create' => 'adminKlass/create',
    'admin/klass/update/([0-9]+)' => 'adminKlass/update/$1',
    'admin/klass/delete/([0-9]+)' => 'adminKlass/delete/$1',
    'admin/klass' => 'adminKlass/index',
    //Управление разделами
    'admin/razdel/create' => 'adminRazdel/create',
    'admin/razdel/update/([0-9]+)' => 'adminRazdel/update/$1',
    'admin/razdel/delete/([0-9]+)' => 'adminRazdel/delete/$1',
    'admin/razdel/parentrazdel' => 'adminRazdel/parentrazdel',
    'admin/razdel/subrazdel' => 'adminRazdel/subrazdel',
    'admin/razdel' => 'adminRazdel/index',
    //Управление уровнями
    'admin/level/create' => 'adminLevel/create',
    'admin/level/update/([0-9]+)' => 'adminLevel/update/$1',
    'admin/level/delete/([0-9]+)' => 'adminLevel/delete/$1',
    'admin/level' => 'adminLevel/index',
    //Управление пользователями
    // Управление задачами
    'admin/users/create' => 'adminUser/create',
    'admin/users/update/([0-9]+)' => 'adminUser/update/$1',
    'admin/users/delete/([0-9]+)' => 'adminUser/delete/$1',
    'admin/users' => 'adminUser/index',
    // Управление заказами:
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Админпанель:
    'admin' => 'admin/index',
    // О магазине
    'contacts' => 'site/contact',
    'about' => 'site/about',
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
