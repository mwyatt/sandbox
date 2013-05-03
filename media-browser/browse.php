<?php
define('BASE_PATH', (string) (__DIR__ . '/'));

/**
* browses directory and retrieves file information
*/
class Browse
{
	

	public function getDirectory($directory = 'media/') {
		$handler = glob(BASE_PATH . $directory . '*', GLOB_MARK);
		$items = array(
			'directory' => false
			, 'file' => false
		);
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
	}


	public function getFile($path) {
		if (! is_file($path)) {
			return false;
		}
		$pathParts = explode('/media', $path);
		$fileInfo = pathinfo($path);
		$fileInfo['guid'] = 'media/' . ltrim($pathParts[1], '/');
		echo json_encode($fileInfo);
	}

	public function createDirectory($path) {
		if (!file_exists($path)) {
		    if (mkdir($path)) {
				echo json_encode($path);
		    }
		}
	}


	public function deleteFile($path) {
		if (file_exists($path)) {
		    if (unlink($path)) {
				echo json_encode($path);
		    }
		}
	}

	public function deleteDirectory($path) {
		if (is_dir($path)) {
			if (rmdir($path)) {
				echo json_encode($path);
			}
		}
	}

	public function upload() {
		foreach ($_FILES["images"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $name = $_FILES["images"]["name"][$key];
		        move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $_GET['directory'] . $_FILES['images']['name'][$key]);
		    }
		}
	}

}

$browse = new Browse();

if (! empty($_FILES)) {
	$browse->upload();
} else {
	$browse->$_GET['o']['method']($_GET['o']['action']);
}
