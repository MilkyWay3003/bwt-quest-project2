<?php

namespace App\Core;

use Exception;

class Route
{
	static function start()
	{
		$controllerName = 'ParticipantController';
		$actionName = 'Index';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if (!empty($routes[1])){
			$controllerName = $routes[1];
		}

		if (!empty($routes[2])){
			$actionName = $routes[2];
		}

		$action = 'action'.$actionName;
		$controllerName = "App\\Controllers\\$controllerName";

		try {
			$controller = new $controllerName;
			if (method_exists($controller, $action)) {
				$controller->$action();
			} else {
				throw new Exception("404 Page not found");
			}
		} catch(Exception $e) {
			echo 'Message: ' .$e->getMessage() .'<br>';
		}
	}
}
