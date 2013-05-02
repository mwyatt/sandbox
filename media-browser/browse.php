<?php
define('BASE_PATH', (string) (__DIR__ . '/'));

/**
* 
*/
class Browse
{
	

	public $directory = 'media/';


	public function getDirectory($directory) {
		$directory = $directory;
		$handler = glob(BASE_PATH . $directory . '*', GLOB_MARK);
		foreach ($handler as $key => $handle) {
			$fileInfo = pathinfo($handle);
			if (is_dir($handle)) {
				$items['directory'][$key] = $fileInfo;
			} else {
				$items['file'][$key] = $fileInfo;
				$items['file'][$key]['path'] = $handle;
			}
		}
		echo json_encode($items);
		// echo '<pre>';
		// print_r($items);
		// echo '</pre>';
	}


	public function getFile($path) {
		if (! is_file($path)) {
			return false;
		}
		$pathParts = explode('/media', $path);
		$fileInfo = pathinfo($path);
		$fileInfo['guid'] = $this->directory . ltrim($pathParts[1], '/');
		// echo '<pre>';
		// print_r($fileInfo);
		// echo '</pre>';
		echo json_encode($fileInfo);
	}


}

$browse = new Browse();
$browse->$_GET['o']['method']($_GET['o']['action']);

// if (array_key_exists('method', $_GET)) {
// 	if (method_exists($browse, $_GET['method'])) {
// 	}
// }
