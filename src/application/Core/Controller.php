<?
namespace App\Core;

abstract class Controller
{

    public $model;
    public $view;

    function __construct($controller = "") //rename psr-2
    {
        $this->view = new View($controller);
    }

}