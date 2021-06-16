<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['cmenus/list'] = 'cmenus/list';
$route['cmenus/(:any)'] = 'cmenus/$1';
$route['cmenus'] = 'cmenus/index';
// Default nya Controller Pages function View
$route['default_controller'] = 'cpages/view';
$route['(:any)'] = 'cpages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
