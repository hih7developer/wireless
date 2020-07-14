<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'UserController/dashboard';
$route['login'] = 'UserController/login';
$route['signup'] = 'UserController/signup';
$route['dashboard'] = 'UserController/dashboard';
$route['logout'] = 'UserController/logout';


$route['admin/profile'] = 'UserController/admin_profile';




$route['carrier_admins'] = 'UserController/carrier_admin_list';
$route['carrier_users'] = 'UserController/carrier_user_list';
$route['carrier_admin/details/(:any)'] = 'Carrier_user_controller/carrier_admin_details/$1';
$route['carrier_admin/create'] = 'UserController/add_carrier_admin';
$route['carrier_user/create'] = 'UserController/add_carrier_user';
$route['carrier_admin/profile'] = 'UserController/carrier_admin_profile';
$route['consumer/profile'] = 'UserController/consumer_profile';
$route['email_verification/(:any)'] = 'UserController/email_verification/$1';


$route['plan/create'] = 'PlanController/create_plan';
$route['plans'] = 'PlanController/view_plans';
$route['plans/lists'] = 'DefaultController/get_all_plans';
$route['plans/(:num)'] = 'PlanController/view_plans_by_carrier_admin/$1';
$route['plan/edit/(:any)'] = 'PlanController/edit_plans_by_carrier_admin/$1';
$route['plan/delete/(:any)'] = 'PlanController/delete_plan/$1';
$route['plans/search/(:num)'] = 'PlanController/search_plans/$1';


$route['settings'] = 'DefaultController/setting_page_view';
$route['lifeline'] = 'PlanController/lifeline';


$route['forget_password/email_check'] = 'ForgetPasswordController/enter_email_page/';
$route['forget_password/otp_check'] = 'ForgetPasswordController/insert_otp';
$route['forget_password/new_password'] = 'ForgetPasswordController/insert_new_password';


$route['nlad/check/(:num)'] = 'NladController/check/$1';
$route['nv/check/(:num)'] = 'NladController/nv_check/$1';


//aplication
$route['application/eligibility_check/(:num)'] = 'ApplicationController/profile_eligibilty_check/$1';
$route['application/eligibility_check/without_nv/(:num)'] = 'ApplicationController/without_nv_check/$1';
$route['application/confirm/(:num)'] = 'ApplicationController/application_confirm/$1';
$route['application/success'] = 'ApplicationController/application_success';
$route['carrier/application/details/(:any)'] = 'AdminViewListController/application_details/$1';
$route['consumer/applications'] = 'ApplicationController/consumer_applications_lists';
$route['consumer/application/details/(:any)'] = 'ApplicationController/consumer_application_details/$1';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
