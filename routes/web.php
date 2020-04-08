<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // *** API ROLES ***
    $router->post('users/login', 'AuthController@login');
    $router->get('users/profile', 'UserController@profile');
    $router->get('users', 'UserController@allUsers');
    $router->get('users/{id}', 'UserController@singleUser');
    $router->post('users', 'UserController@register');
    $router->put('users', 'UserController@update');
    $router->patch('users/{id}', 'UserController@destroy');

    // *** API ROLES ***
    $router->get('roles', 'RoleController@index');
    $router->post('roles', 'RoleController@store');
    $router->get('roles/{id}', 'RoleController@show');
    $router->put('roles', 'RoleController@update');
    $router->delete('roles/{id}', 'RoleController@destroy');

    // *** API JOB ***
    $router->get('jobs', 'JobController@index');
    $router->post('jobs', 'JobController@store');
    $router->get('jobs/{id}', 'JobController@show');
    $router->put('jobs', 'JobController@update');
    $router->delete('jobs/{id}', 'JobController@destroy');

    // *** API EMPLOYEE ***
    $router->get('employees/waiters', 'EmployeeController@get_waiters');
    $router->put('employees/waiters', 'EmployeeController@update_waiters');

    $router->get('employees', 'EmployeeController@index');
    $router->post('employees', 'EmployeeController@store');
    $router->get('employees/{id}', 'EmployeeController@show');
    $router->put('employees', 'EmployeeController@update');
    $router->delete('employees/{id}', 'EmployeeController@destroy');


    // *** API TABLES ***
    $router->get('tables/sale-orders', 'TableController@get_tablesBySalesOrders');
    $router->get('tables', 'TableController@index');
    $router->post('tables', 'TableController@store');
    $router->get('tables/{id}', 'TableController@show');
    $router->put('tables', 'TableController@update');
    $router->delete('tables/{id}', 'TableController@destroy');

    // *** API SEAT ***
    $router->get('seats', 'SeatController@index');
    $router->post('seats', 'SeatController@store');
    $router->get('seats/{id}', 'SeatController@show');
    $router->put('seats', 'SeatController@update');
    $router->delete('seats/{id}', 'SeatController@destroy');

    // *** API RestMenu ***
    $router->get('rest-menus', 'RestMenuController@index');
    $router->post('rest-menus', 'RestMenuController@store');
    $router->get('rest-menus/{id}', 'RestMenuController@show');
    $router->put('rest-menus', 'RestMenuController@update');
    $router->delete('rest-menus/{id}', 'RestMenuController@destroy');

    // *** API StatusOrder ***
    $router->get('status-orders', 'StatusOrderController@index');
    $router->post('status-orders', 'StatusOrderController@store');
    $router->get('status-orders/{id}', 'StatusOrderController@show');
    $router->put('status-orders', 'StatusOrderController@update');
    $router->delete('status-orders/{id}', 'StatusOrderController@destroy');

    // *** API OrderType ***
    $router->get('order-types', 'OrderTypeController@index');
    $router->post('order-types', 'OrderTypeController@store');
    $router->get('order-types/{id}', 'OrderTypeController@show');
    $router->put('order-types', 'OrderTypeController@update');
    $router->delete('order-types/{id}', 'OrderTypeController@destroy');

    // *** API CategoryMenu ***
    $router->get('category-menus', 'CategoryMenuController@index');
    $router->post('category-menus/sub_category', 'CategoryMenuController@sub_category');
    $router->post('category-menus', 'CategoryMenuController@store');
    $router->post('category-menus/menus', 'CategoryMenuController@menus');
    $router->get('category-menus/{id}', 'CategoryMenuController@show');
    $router->put('category-menus', 'CategoryMenuController@update');
    $router->delete('category-menus/{id}', 'CategoryMenuController@destroy');

    // *** API MealTime ***
    $router->get('meal-times', 'MealTimeController@index');
    $router->post('meal-times', 'MealTimeController@store');
    $router->get('meal-times/{id}', 'MealTimeController@show');
    $router->put('meal-times', 'MealTimeController@update');
    $router->delete('meal-times/{id}', 'MealTimeController@destroy');

    // *** API OrderRestriction ***
    $router->get('order-restrictions', 'OrderRestrictionController@index');
    $router->post('order-restrictions', 'OrderRestrictionController@store');
    $router->get('order-restrictions/{id}', 'OrderRestrictionController@show');
    $router->put('order-restrictions', 'OrderRestrictionController@update');
    $router->delete('order-restrictions/{id}', 'OrderRestrictionController@destroy');

    // *** API PaymentMethod ***
    $router->get('payment-methods', 'PaymentMethodController@index');
    $router->post('payment-methods', 'PaymentMethodController@store');
    $router->get('payment-methods/{id}', 'PaymentMethodController@show');
    $router->put('payment-methods', 'PaymentMethodController@update');
    $router->delete('payment-methods/{id}', 'PaymentMethodController@destroy');

    // *** API SaleOrder ***
    $router->get('sale-orders/details/{id}', 'SaleOrderController@details');
    $router->get('sale-orders', 'SaleOrderController@index');
    $router->post('sale-orders', 'SaleOrderController@store');
    $router->get('sale-orders/{id}', 'SaleOrderController@show');
    $router->put('sale-orders', 'SaleOrderController@update');
    // $router->delete('sale-orders/{id}', 'SaleOrderController@destroy');

     // *** API Customer ***
     $router->get('customers/search/{identity_card}', 'CustomerController@searchByIdentity');
     $router->get('customers', 'CustomerController@index');
     $router->post('customers', 'CustomerController@store');
     $router->get('customers/{id}', 'CustomerController@show');
     $router->put('customers', 'CustomerController@update');
     // $router->delete('customers/{id}', 'CustomerController@destroy');

     // *** API Payment ***
     $router->get('payments', 'PaymentController@index');
     $router->post('payments', 'PaymentController@store');
     $router->get('payments/{id}', 'PaymentController@show');
     // $router->put('payments', 'PaymentController@update');
     // $router->delete('payments/{id}', 'PaymentController@destroy');

     // *** API SaleOrderDetail ***
    $router->get('sale-order-details', 'SaleOrderDetailController@index');
    $router->post('sale-order-details', 'SaleOrderDetailController@store');
    $router->get('sale-order-details/{id}', 'SaleOrderDetailController@show');
    // $router->put('sale-order-details', 'SaleOrderDetailController@update');
    $router->delete('sale-order-details/{id}', 'SaleOrderDetailController@destroy');

    // *** API MeasureUnit ***
    $router->get('measure-units', 'MeasureUnitController@index');
    $router->post('measure-units', 'MeasureUnitController@store');
    $router->get('measure-units/{id}', 'MeasureUnitController@show');
    $router->put('measure-units', 'MeasureUnitController@update');
    $router->delete('measure-units/{id}', 'MeasureUnitController@destroy');

    // *** API CategoryProduct ***
    $router->get('category-products', 'CategoryProductController@index');
    $router->post('category-products/sub_category', 'CategoryProductController@sub_category');
    $router->post('category-products', 'CategoryProductController@store');
    $router->post('category-products/products', 'CategoryProductController@products');
    $router->get('category-products/{id}', 'CategoryProductController@show');
    $router->put('category-products', 'CategoryProductController@update');
    $router->delete('category-products/{id}', 'CategoryProductController@destroy');

    // *** API Provider ***
    $router->get('providers/search/{name}', 'ProviderController@searchByName');
    $router->get('providers', 'ProviderController@index');
    $router->post('providers', 'ProviderController@store');
    $router->get('providers/{id}', 'ProviderController@show');
    $router->put('providers', 'ProviderController@update');
    $router->delete('providers/{id}', 'ProviderController@destroy');

    // *** API PurchaseOrder ***
    $router->get('purchase-orders/details/{id}', 'PurchaseOrderController@details');
    $router->get('purchase-orders', 'PurchaseOrderController@index');
    $router->post('purchase-orders', 'PurchaseOrderController@store');
    $router->get('purchase-orders/{id}', 'PurchaseOrderController@show');
    $router->put('purchase-orders', 'PurchaseOrderController@update');
    // $router->delete('purchase-orders/{id}', 'PurchaseOrderController@destroy');

     // *** API PurchaseOrderDetail ***
     $router->get('purchase-order-details', 'PurchaseOrderDetailController@index');
     $router->post('purchase-order-details', 'PurchaseOrderDetailController@store');
     $router->get('purchase-order-details/{id}', 'PurchaseOrderDetailController@show');
     // $router->put('purchase-order-details', 'PurchaseOrderDetailController@update');
     $router->delete('purchase-order-details/{id}', 'PurchaseOrderDetailController@destroy');

     // *** API Product ***
    $router->get('products', 'ProductController@index');
    $router->post('products', 'ProductController@store');
    $router->get('products/{id}', 'ProductController@show');
    $router->put('products', 'ProductController@update');
    $router->delete('products/{id}', 'ProductController@destroy');

 });
