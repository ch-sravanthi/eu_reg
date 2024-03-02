<?php
namespace App\Helpers;

use Storage;
use Illuminate\Http\UploadedFile;

class FileHelper
{

	public static function getTmpFilename($name, $filename = null) {
		return strpos(request()->$name, 'temp/') !== false ? request()->$name : null;
	}

	public static function checkAndSetTmpFile($name, $filename = null) {
		if ($filename && is_string($filename)) {
			if (!Storage::exists($filename)) {
				return true;
			}
			$path = Storage::path($filename);
			$path_parts = pathinfo($path);
			$file = new UploadedFile(
				$path,
				$path_parts['basename'],
				Storage::mimeType($filename),
				Storage::size($filename),
				true,
				TRUE
			);
			request()->merge([$name => $file]);
			request()->files->set($name, $file);
			return true;
		}
		return false;
	}
}
