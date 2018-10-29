<?
// echo __DIR__;
require_once '../../vendor/autoload.php';

session_start();

use App\Core\Route;

require_once 'config.php';
// require_once 'Сore/Model.php';
//require_once 'Сore/View.php';
//require_once 'Сore/Controller.php';

$route = new Route;
$route->start();
