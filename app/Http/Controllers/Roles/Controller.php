<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
	 * Render views with admin layout
	 *
	 * @param string $page View file path not including 'admin/'
	 * @param string $page_title Page title
	 * @param array $controller_data Passed data
	 * @param array $css Loaded stylesheets for this view
	 * @param array $js Loaded scripts for this view
	 * @return void
	 */
    public function roleTemplate($page , $page_title, $data = []){
        // prep.  data
		$content['view_file'] = 'roles.' . $page;

		$content['page_title'] = $page_title;

		$content['controller_data'] = $data;

		echo view('layout.app', $content);

		return;
    }
}
