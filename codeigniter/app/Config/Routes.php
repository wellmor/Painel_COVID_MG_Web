<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home'); //Pagina inicial acessa o controller home
$routes->setDefaultMethod('municipio'); //Com o método index
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('/admin', function ($routes) {

	//Rotas de administrador que NÃO exigem autenticação
	$routes->add('/', 'Users::index', ['filter' => 'noauth']);
	$routes->get('logout', 'Users::logout');

	//Rotas de administrador que exigem autenticação
	$routes->get('noticias', 'Noticias::index', ['filter' => 'auth']);
	$routes->get('casos', 'Casos::index', ['filter' => 'auth']);
	$routes->match(['post', 'get'], 'painel', 'Users::painel', ['filter' => 'auth']);
	$routes->match(['get'], 'testes', 'Testes::index', ['filter' => 'auth']);
	$routes->match(['post', 'get'], 'perfil', 'Users::profile', ['filter' => 'auth']);

	$routes->get('casos', 'Casos::deleteDt', ['filter' => 'auth']);


});

//Todas as rotas home não exigem autenticação
$routes->group('/home', function ($routes) {
	$routes->get('/', 'Home::index');
	$routes->get('projetos', 'Home::projetos');
	$routes->get('dicas', 'Home::dicas');
	$routes->get('sobre', 'Home::sobre');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
