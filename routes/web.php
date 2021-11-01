<?php


header("Access-Control-Allow-Origin: *");


$site_settings=DB::table('systems')->first();
View::share('site_settings', $site_settings);

$control_settings=\DB::table('control_panel')->first();

\View::share('control_settings', $control_settings);




//Authentication routes
Route::get('/', 'HomeController@Index');
Route::get('/translate/{id}/{lang_name}', 'HomeController@translate');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@logout');
Route::get('/register/{ref_id?}', 'Auth\AuthController@getRegister');
Route::post('/register/{ref_id?}', 'Auth\AuthController@postRegister');
Route::get('/register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\AuthController@confirm'
]);


Route::post('password/email', 'Auth\PasswordController@postForgotPassword');

// Password reset routes...
Route::get('/reset_password/{email}/{reset_code}', 'Auth\PasswordController@getReset');
Route::post('/reset', 'Auth\PasswordController@postReset');


//Admin Routes


Route::group(['prefix' => 'administrator' , 'middleware' => 'admin_auth'], function () {

    Route::get('/', 'HomeController@users');
    Route::get('/websites', 'HomeController@websites');
    Route::get('/support', 'HomeController@messages');
    Route::get('/emailing', 'HomeController@emailing');
    Route::post('/emailing', 'HomeController@PostEmailing');
    Route::get('/withdrawals', 'HomeController@withdrawals');
    Route::get('/transfers', 'HomeController@adminTransfers');
    Route::get('/activities', 'HomeController@activities');
    Route::post('/activities', 'HomeController@postActivities');
    Route::get('/withdrawal/process/{id}', 'HomeController@changeStatus');
    Route::get('/subscriptions', 'HomeController@subscriptionSettings');
    Route::post('/subscriptions', 'HomeController@storeSubscriptionAmount');
    Route::get('/points', 'HomeController@pointsSettings');
    Route::post('/points', 'HomeController@setPointsSettings');
    Route::get('/settings', 'HomeController@changePassword');
    Route::get('/system', 'HomeController@system');
    Route::post('/system', 'HomeController@postSystem');
    Route::get('/social', 'HomeController@social');
    Route::get('/media', 'HomeController@media');
    Route::get('/account/delete/{id}', 'Auth\AuthController@delete');
    Route::get('/account/edit/{id}', 'Auth\AuthController@edit');
    Route::post('/edit/{id}', 'Auth\AuthController@postEdit');
    Route::get('/website/delete/{id}', 'WebsiteController@deleteWebsite');
    Route::get('/website/status/{id}', 'WebsiteController@websiteStatus');
    Route::get('/link/delete/{id}', 'HomeController@deleteLink');
    Route::get('/link/status/{id}', 'HomeController@linkStatus');
    Route::get('/video/delete/{id}', 'HomeController@deleteVideo');
    Route::get('/video/status/{id}', 'HomeController@videoStatus');
    Route::post('/change_password', 'Auth\AuthController@changePassword');
    Route::get('/panel', 'HomeController@panelShow');
    Route::post('/panel', 'HomeController@panelStore');
    Route::get('/logout', 'Auth\AuthController@logout');


});

Route::group(['middleware' => 'auth'], function () {
//Returning views
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/traffic-exchange', 'ApiController@trafficExchange');
    Route::get('/manual-exchange', 'ApiController@manualExchange');
    Route::get('/api/manual_exchange/{id}', 'ApiController@PostManualExchange');
    Route::get('/referrals', 'HomeController@referrals');
    Route::get('/subscriptions', 'HomeController@subscriptions');
    Route::get('/points', 'HomeController@points');
    Route::get('/transfers', 'HomeController@transfers');
    Route::get('/transferlist', 'HomeController@gettransfers');
    Route::post('/transfers', 'HomeController@processTransfers');
    Route::post('/withdraw', 'HomeController@processWithdraw');
    Route::get('/withdraw', 'HomeController@withdraw');
    Route::get('/withdrawallist', 'HomeController@getwithdrawals');
    Route::get('/social', 'SocialController@getView');
    Route::post('/social/add', 'SocialController@store');
    Route::get('/videos', 'VideoController@getView');
    Route::get('/video_list', 'VideoController@getVideos');
    Route::post('/video/add', 'VideoController@store');
    Route::get('/video/delete/{id}', 'VideoController@deleteVideo');
    Route::get('/links', 'SocialController@getLinks');
    Route::get('/link/delete/{id}', 'SocialController@deleteLink');
    Route::get('/short_links', 'WebsiteController@getShortLinks');

    Route::get('/downloads', 'HomeController@downloads');
    Route::get('/support', 'HomeController@support');
    Route::post('/support', 'DashboardController@support');
    Route::get('/settings', 'HomeController@settings');
    Route::get('/bitcoin/{price}', 'PaypalController@bitcoin');
    Route::get('/coingate/process', 'PaypalController@processBitcoin');
    // this is after make the payment, PayPal redirect back to your site
    Route::get('payment/status', array(
        'as' => 'payment.status',
        'uses' => 'PaypalController@getPaymentStatus',
    ));
    Route::get('/payment/{charge}', array(
        'middleware' => 'auth',
        'as' => 'payment',
        'uses' => 'PaypalController@postPayment',
    ));


    Route::get('membership/status', array(
        'as' => 'membership.status',
        'uses' => 'PaypalController@getMembershipStatus',
    ));
    Route::get('/membership/{charge}', array(
        'middleware' => 'auth',
        'as' => 'payment',
        'uses' => 'PaypalController@postMembership',
    ));


    //websites routes
    Route::get('/websites', 'WebsiteController@getWebsites');
    Route::post('/website/add', 'WebsiteController@addWebsite');
    Route::get('/website/delete/{id}', 'WebsiteController@deleteWebsite');

    //Api routes
    Route::get('/api/social', 'SocialController@process');
    Route::get('/api/media', 'VideoController@process');
    Route::get('/api/session', 'ApiController@session');
    Route::get('/api/increment', 'ApiController@increment');
    Route::get('/api/stripe', 'ApiController@stripe');
    Route::get('/api/points', 'ApiController@purchasePoints');
    Route::get('/api/check', 'ApiController@check');
    Route::get('/api/short_links', 'ApiController@shortLinks');


    //Account routes

    Route::get('/account/delete', 'Auth\AuthController@delete');

    Route::post('/change_password', 'Auth\AuthController@changePassword');

    Route::get('/{id}', 'HomeController@redirect');


});









