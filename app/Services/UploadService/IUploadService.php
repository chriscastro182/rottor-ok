<?php

namespace App\Services\UploadService;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

interface IUploadService
{
	public function upload(UploadedFile $file, $destination);
	public function getUploadedData();

}
