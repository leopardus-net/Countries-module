<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

/*
|--------------------------------------------------------------------------
| Instalador del módulo
|--------------------------------------------------------------------------
|
| Aquí se establecerán todas las reglas de instalación
| de tal forma que se pueda instalar automaticamente el módulo
| sin necesidad de instalarlo manualmente, ejecutar migraciones, 
| copiar assets, etc.
|
*/
if( sys_installed() ) {
	/* 
	| Instalador del módulo.
	|
	| module_install( function )->make(array());
	|
	| "function" puede ser una función anonima o 
	| un string con el controlador y la función.
	|
	*/
	module_install(__DIR__, function( $module ) {
		/* 
		| Creador del menú lateral izquierdo.
		| leftSidebar( $sidebar, $menu, $sub_menu )->make(array());
		|
		*/
		leftSidebar('sistema', 'configuracion')->make(array(
			['name' => [
				'es' => 'Paises',
				'en' => 'Countries'
			], 'route' => 'admin/settings/country']
		));

		/*
		| Ejecutamos las migraciones
		|
		*/
		Artisan::call("module:migrate", [
			'module' => $module->name
		]);

	});
}