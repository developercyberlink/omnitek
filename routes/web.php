<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use App\Http\Controllers\FrontendControllers\CustomerRegisterController;

Route::get('/', 'FrontendControllers\FrontpageController@index');
Route::get('/proposal-request/{uri?}', 'FrontendControllers\FrontpageController@proposal_request')->name('proposal-request');
Route::post('/proposal-request/{uri?}', 'FrontendControllers\FrontpageController@proposal_request')->name('proposal-request');
Route::get('/appointment/{uri?}', 'FrontendControllers\FrontpageController@appointment')->name('appointment');
Route::post('/appointment/{uri?}', 'FrontendControllers\FrontpageController@appointment')->name('appointment');
Route::get('search-results', 'FrontendControllers\FrontpageController@search_results')->name('search-results');
Route::get('search-publication', 'FrontendControllers\FrontpageController@search_publication')->name('search-publication');
Route::post('search-results', 'FrontendControllers\FrontpageController@search_results')->name('search-results');
Route::post('search-publication', 'FrontendControllers\FrontpageController@search_publication')->name('search-publication');

Route::get('/donors', 'FrontendControllers\FrontpageController@members')->name('post.members');
Route::post('/career', 'FrontendControllers\CareerController@store')->name('career');

//Inquiry routes
Route::post('trip-inquiry', 'FrontendControllers\FrontpageController@post_inquiry')->name('post-inquiry');
//
Route::post('trip-booking', 'FrontendControllers\FrontpageController@random_tripbooking')->name('random-trip');
Route::post('vehicle-booking', 'FrontendControllers\FrontpageController@vehicle_booking')->name('vehicles-booking');


/* Authentication Routes... */
Route::get('adminisclient', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('adminisclient', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::redirect('/dashboard', '/admin/dashboard', 301);
//================== Frontend Routes =================//
Route::get('banners', 'FrontendControllers\FrontpageController@banners');

// Normal Pages
Route::get('{uri}.html', 'FrontendControllers\FrontpageController@pagedetail')->name('page.pagedetail');
Route::get('page/{uri}.html', 'FrontendControllers\FrontpageController@posttype')->name('page.posttype');
Route::get('service-category/{uri}.html', 'FrontendControllers\FrontpageController@servicetype')->name('page.servicetype');
Route::get('trades/detail/{uri}', 'FrontendControllers\FrontpageController@portfolio')->name('page.portfolio');
Route::post('/service/serviceorder/{uri}', 'FrontendControllers\FrontpageController@serviceorder')->where('uri', '[0-9A-Za-z]+');
Route::get('{parenturi}/{uri}.html', 'FrontendControllers\FrontpageController@pagedetail_child')->name('page.pagedetail_child');
Route::get('{parenturi}/apply/{uri}.html', 'FrontendControllers\FrontpageController@apply');
Route::post('page/apply/applyjob', 'FrontendControllers\FrontpageController@career_apply_action')->name('career-apply-action');
Route::post('/career/careerapply/{uri}', 'FrontendControllers\FrontpageController@careerapply')->where('uri', '[0-9A-Za-z]+');

Route::get('/applicant/apply-form', 'FrontendControllers\CareerController@apply_form')->name('applicant.applyform');
Route::get('/applicant/register', 'FrontendControllers\CustomerRegisterController@create')->name('applicant.register');
Route::post('/applicant/register', 'FrontendControllers\CustomerRegisterController@store')->name('applicant.register.store');
Route::get('/applicant/verify/{token}', [CustomerRegisterController::class, 'verify'])->name('applicant.verify');

Route::get('/applicant/login', 'FrontendControllers\CustomerRegisterController@customerlogin')->name('applicant.login')->middleware('guest');
Route::post('/applicant/login', 'FrontendControllers\CustomerRegisterController@customerlogin_action')->name('applicant.login.store');
Route::get('/applicant/logout', 'FrontendControllers\CustomerRegisterController@customer_logout')->name('applicant.logout');
// Circular routes
Route::get('/customer/changepassword', 'FrontendControllers\CustomerRegisterController@changepassword')->name('customer.changepassword');
Route::put('/customer/changepassword', 'FrontendControllers\CustomerRegisterController@changepassword_action')->name('customer.changepassword_action');
Route::get('/customer/dashboard', 'FrontendControllers\CustomerRegisterController@customer_dashboard')->name('customer.customer_dashboard');
Route::get('/circular/detail/{uri}', 'FrontendControllers\CustomerRegisterController@circular_detail')->name('circular.detail');

Route::get('page/employeelogin', 'FrontendControllers\CustomerRegisterController@employeelogin')->name('page.employeelogin');
Route::post('page/employeelogin', 'FrontendControllers\CustomerRegisterController@employeelogin_action')->name('page.employeelogin_action');

Route::get('page/password-recover', 'FrontendControllers\CustomerRegisterController@password_recover')->name('page.password-recover');
Route::get('/employeelogout', 'FrontendControllers\CustomerRegisterController@employeelogout')->name('page.employeelogout');

Route::post('/newsletter/newsletter-signup', 'FrontendControllers\NewsletterSignupController@store')->name('newsletter-signup');
Route::post('/dwn/dwnpdf', 'FrontendControllers\NewsletterSignupController@dwnpdf')->name('dwnpdf');
Route::get('/dwn/dwnform/{key_string}', 'FrontendControllers\NewsletterSignupController@dwnform')->name('dwnform');

Route::get('page/photogallery/{category_id}', 'FrontendControllers\FrontpageController@photo_gallery');

// Send Mail
Route::post('page/contact/sendmail', 'FrontendControllers\FrontpageController@sendmail')->name('sendmail');
Route::post('page/contact/contact-sendmail', 'FrontendControllers\FrontpageController@sendmail_contact')->name('sendmail_contact');
Route::post('page/order/sendorder', 'FrontendControllers\FrontpageController@sendorder')->name('sendorder');
Route::post('page/career/sendresume', 'FrontendControllers\FrontpageController@sendresume')->name('sendresume');
Route::get('category/{uri}', 'FrontendControllers\FrontpageController@category_navigation')->name('category.navigation');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//=========================================== Backend Routes =======================================================//
Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('admin/applicant-list', 'FrontendControllers\CareerController@index')->name('applicant-list.index');
    Route::get('admin/appointment', 'DashboardController@proposal_request')->name('appointment.index');
    Route::get('admin/proposal-delete/{id}', 'DashboardController@proposal_delete')->name('proposal-delete');
    Route::get('admin/trip-booking', 'DashboardController@trip_booking')->name('trip-booking');
    Route::get('admin/trip-booking-delete/{id}', 'DashboardController@trip_booking_delete')->name('trip-booking-delete');
    Route::get('admin/vehicle-booking', 'DashboardController@vehicle_booking')->name('vehicle-booking');
    Route::get('admin/vehicle-booking-delete/{id}', 'DashboardController@vehicle_booking_delete')->name('vehicle-booking-delete');
    Route::get('admin/inquiry', 'DashboardController@inquiry')->name('inquiry');
    Route::get('admin/inquiry-delete/{id}', 'DashboardController@inquiry_delete')->name('inquiry-delete');
    Route::get('admin/contact', 'DashboardController@contact_us')->name('contact');
    Route::get('admin/contact-delete/{id}', 'DashboardController@contact_us_delete')->name('contact-delete');

    Route::get('admin/admin-user', 'AdminControllers\Members\UserController@admin_user');
    Route::get('admin/agent-user', 'AdminControllers\Members\UserController@agent_user');
    Route::resources([
        'admin/membership' => 'AdminControllers\Membership\MembershipController',
        'admin/adminmenu' => 'AdminControllers\AdminMenu\AdminMenuController',
        'admin/user' => 'AdminControllers\Members\UserController',
        'admin/member' => 'AdminControllers\Members\MemberController',
        'admin/role' => 'AdminControllers\Members\RoleController',
        'admin/banner' => 'AdminControllers\Banners\BannerController',
        'admin/postcategory' => 'AdminControllers\Posts\PostCategoryController',
        'admin/imagecategory' => 'AdminControllers\Galleries\ImageGalleryCategoryController',
        'admin/imagegallery' => 'AdminControllers\Galleries\ImageGalleryController',
        'admin/videocategory' => 'AdminControllers\Galleries\VideoGalleryCategoryController',
        'admin/videogallery' => 'AdminControllers\Galleries\VideoGalleryController',
        'admin/settings' => 'AdminControllers\Settings\SettingController',
        'admin/department' => 'AdminControllers\Departments\DepartmentController',
        'admin/circulartype' => 'AdminControllers\Circulars\CircularTypeController',
        'admin/portfoliocategory' => 'AdminControllers\Portfolios\PortfolioCategoryController',
        'admin/our-trades' => 'AdminControllers\Portfolios\PortfolioController',
        'admin/dwninfo' => 'AdminControllers\Posts\DwnInfoController',
        'admin/tender' => 'AdminControllers\Tenders\TenderController',
        'admin/tender-category' => 'AdminControllers\Tenders\TenderCategoryController',
        'admin/awarded-vender' => 'AdminControllers\Venders\VenderController',
        'admin/init' => 'AdminControllers\Settings\InitController',

    ]);

    Route::resource('admin.multiplephoto', 'AdminControllers\Posts\PostImageController');
    Route::resource('admin.multiplevideo', 'AdminControllers\Posts\MultipleVideoController');
    Route::resource('admin.circular', 'AdminControllers\Circulars\CircularController');
    Route::resource('admin.multiplebanner', 'AdminControllers\MultipleBanners\MultipleBannerController');
    Route::get('admin/permissionedit/{user}', 'AdminControllers\Members\UserController@permission_edit')->name('user.permissionEdit');;
    Route::put('admin/permissionedit/{user}', 'AdminControllers\Members\UserController@permission_update')->name('user.permissionUpdate');;

    Route::get('admin/assignroles/{id}', 'AdminControllers\Members\UserController@assign_roles')->name('user.assignroles');
    Route::put('admin/assignroles/{user}', 'AdminControllers\Members\UserController@update_roles')->name('user.update_roles');

    Route::get('admin/userprofile', 'AdminControllers\Members\UserController@userprofile')->name('admin.userprofile');
    Route::put('admin/update_password', 'AdminControllers\Members\UserController@update_password')->name('admin.update_password');
    Route::get('admin/changepassword', 'AdminControllers\Members\UserController@changepassword')->name('admin.changepassword');

    // For posttype
    Route::get('type/{posttype}', 'AdminControllers\Posts\PostTypeController@index')->name('type.posttype.index');
    Route::get('type-user/{posttype}', 'AdminControllers\Posts\PostTypeController@index_user')->name('type.posttype.index.user');
    Route::get('type/{posttype}/create', 'AdminControllers\Posts\PostTypeController@create')->name('type.posttype.create');
    Route::post('type/{posttype}/store', 'AdminControllers\Posts\PostTypeController@store')->name('type.posttype.store');
    Route::put('type/{posttype}/{id}', 'AdminControllers\Posts\PostTypeController@update')->name('type.posttype.update');
    Route::get('type/{posttype}/{id}/edit', 'AdminControllers\Posts\PostTypeController@edit')->name('type.posttype.edit');
    Route::delete('type/{posttype}/{id}', 'AdminControllers\Posts\PostTypeController@destroy')->name('type.posttype.destroy');

    // For post
    Route::get('admin/{post}', 'AdminControllers\Posts\PostController@index')->name('admin.post.index');
    Route::get('admin/{post}/create', 'AdminControllers\Posts\PostController@create')->name('admin.post.create');
    Route::post('admin/{post}/store', 'AdminControllers\Posts\PostController@store')->name('admin.post.store');
    Route::put('admin/{post}/{id}', 'AdminControllers\Posts\PostController@update')->name('admin.post.update');
    Route::get('admin/{post}/{id}/edit', 'AdminControllers\Posts\PostController@edit')->name('admin.post.edit');
    Route::get('admin/{post}/{id}', 'AdminControllers\Posts\PostController@childlist')->name('post.childlist');
    Route::delete('admin/{post}/{id}', 'AdminControllers\Posts\PostController@destroy')->name('admin.post.destroy');
    Route::delete('delete_pagethumbnail/{id}', 'AdminControllers\Posts\PostController@delete_pagethumbnail');
    Route::delete('delete_icon/{id}', 'AdminControllers\Posts\PostController@delete_icon');
    Route::delete('delete_thumbnail/{id}', 'AdminControllers\Posts\PostController@delete_thumbnail');
    Route::delete('delete_banner/{id}', 'AdminControllers\Posts\PostController@delete_banner');
    Route::put('poststatus/{id}', 'AdminControllers\Posts\PostController@poststatus')->name('admin.poststatus');
    Route::put('aprovestatus/{id}', 'AdminControllers\Members\MemberController@aprovestatus')->name('admin.aprovestatus');
    Route::put('globalpost/{id}', 'AdminControllers\Posts\PostController@globalpost')->name('admin.globalpost');

    Route::delete('delete_portfolio_thumb/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_portfolio_pthumb');
    Route::delete('delete_picon/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_picon');
    Route::delete('delete_pthumbnail/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_pthumbnail');
    Route::delete('delete_pbanner/{id}', 'AdminControllers\Portfolios\PortfolioController@delete_pbanner');
    Route::delete('delete_portfolio_cat/{id}', 'AdminControllers\Portfolios\PortfolioCategoryController@delete_category_thumb');
    Route::get('newsletter/subcribers', 'FrontendControllers\NewsletterSignupController@index')->name('subcribers');
    Route::delete('newsletter/subcribers/{id}', 'FrontendControllers\NewsletterSignupController@destroy');

    // Associated Post
    Route::get('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@associated_post')->name('associated.post.index');
    Route::get('admin/associated/{type}/{id}/create', 'AdminControllers\Posts\AssociatedPostController@create')->name('admin.associated.create');
    Route::post('admin/associated/{type}/{id}/store', 'AdminControllers\Posts\AssociatedPostController@store')->name('admin.associated.store');
    Route::delete('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@destroy')->name('admin.associated.destroy');
    Route::get('admin/associated/{type}/{id}/edit', 'AdminControllers\Posts\AssociatedPostController@edit')->name('admin.associated.edit');
    Route::put('admin/associated/{type}/{id}', 'AdminControllers\Posts\AssociatedPostController@update')->name('admin.associated.update');
    Route::delete('delete_posttype_banner/{id}', 'AdminControllers\Posts\PostTypeController@delete_posttype_banner');
    // Associated Portfolios
    Route::get('admin/associates/{type}/{id}', 'AdminControllers\Portfolios\AssociatedPortfolioController@associated_post')->name('associates.post.index');
    Route::get('admin/associates/{type}/{id}/create', 'AdminControllers\Portfolios\AssociatedPortfolioController@create')->name('admin.associates.create');
    Route::post('admin/associates/{type}/{id}/store', 'AdminControllers\Portfolios\AssociatedPortfolioController@store')->name('admin.associates.store');
    Route::delete('admin/associates/{type}/{id}', 'AdminControllers\Portfolios\AssociatedPortfolioController@destroy')->name('admin.associates.destroy');
    Route::get('admin/associates/{type}/{id}/edit', 'AdminControllers\Portfolios\AssociatedPortfolioController@edit')->name('admin.associates.edit');
    Route::put('admin/associates/{type}/{id}', 'AdminControllers\Portfolios\AssociatedPortfolioController@update')->name('admin.associates.update');

    // Upload multiple document
    Route::get('doc/multipledocument/{post_id}', 'AdminControllers\Posts\PostDocController@index')->name('doc.multipledocument');
    Route::get('doc/multipledocument/{post_id}/create', 'AdminControllers\Posts\PostDocController@create');
    Route::post('doc/multipledocument/store', 'AdminControllers\Posts\PostDocController@store')->name('multipledocument.store');
    Route::get('doc/multipledocument/{post_id}/{id}/edit', 'AdminControllers\Posts\PostDocController@edit');
    Route::put('doc/multipledocument/{post_id}', 'AdminControllers\Posts\PostDocController@update');
    Route::delete('doc/deleterow/{id}', 'AdminControllers\Posts\PostDocController@destroy');
    Route::delete('doc/multipledocument/{id}', 'AdminControllers\Posts\PostDocController@delete_doc_file');

    // List User for API
    Route::get('admin/pages/listusers/{dept}', 'AdminControllers\Circulars\CircularController@listusers');
    Route::get('admin/pages/departments', 'AdminControllers\Circulars\CircularController@departments');

    View::composer(['*'], function ($view) {
        $posttype = App\Models\Posts\PostTypeModel::orderBy('ordering', 'asc')->get();
        $view->with('posttype', $posttype);
    });

    View::composer(['*'], function ($view) {
        $circulartype = App\Models\Circulars\CircularTypeModel::orderBy('ordering', 'asc')->get();
        $view->with('circulartype', $circulartype);
    });
});
