<?
namespace App\Core;

class View
{
	function generate($template, $content, $data = null)
	{
		if(is_array($data)) {
            extract($data);
		}

	    include __DIR__."/../Views/{$template}.php";
	}
}
