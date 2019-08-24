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
$route['default_controller'] = 'portal/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['portal'] = 'portal/login';
$route['loyalty'] = 'loyalty/main';
$route['about-us'] = "about_us" ;

$route['api/submissions/submissions/(:num)'] = 'api/submissions/submissions/submissionid/$1'; // Example 4
$route['api/api_reponse/api/(:num)'] = 'api/api_response/api/apiresponseid/$1'; // Example 4
$route['api/workflow_engine/wf/(:num)'] = 'api/workflow_engine/wf/id/$1'; // Example 4
$route['api/api/api/(:num)'] = 'api/api/api/id/$1'; // Example 4
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/mongodb/users/(:num)'] = 'api/mongodbs/users/id/$1'; // Example 4
$route['api/forms/forms/(:any)'] = 'api/forms/forms/formid/$1'; // Example 4
$route['api/ldap_sync/ldap/(:any)'] = 'api/ldap_sync/ldap/formid/$1'; // Example 4
$route['api/submissions/submissions/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/submissions/submissions/submissionid/$1/format/$3$4'; // Example 8
$route['api/api_response/api/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/api_response/api/apiresponseid/$1/format/$3$4'; // Example 8
$route['api/workflow_engine/wf/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/workflow_engine/wf/id/$1/format/$3$4'; // Example 8
$route['api/api/api/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/api/api/id/$1/format/$3$4'; // Example 8
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
$route['api/mongodb/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/mongodbs/users/id/$1/format/$3$4'; // Example 8
$route['api/forms/forms/(:any)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/forms/forms/formid/$1/format/$3$4'; // Example 8
$route['api/ldap_sync/ldap/(:any)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/ldap_sync/ldap/formid/$1/format/$3$4'; // Example 8
