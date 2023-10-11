<?php

namespace App\Services\UploadService;

use App;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class UploadService implements IUploadService
{
	public function upload(UploadedFile $file, $destination)
	{
		$response = [
			'message' => '',
			'fileName' => '',
			'fileDir' => '',
			'file' => null,
			'status' => false
		];

		// En esta línea hacemos la diferencia de que si no es un PDF no es aceptado
		$mimeType = ["image/jpeg", "image/png", "image/gif", "image/x-ms-bmp"];
		if (!in_array($file->getClientMimeType(), $mimeType))
		{
			if (env('APP_DEBUG'))
				Log::error('El archivo no es pdf, es del tipo: '.$file->getClientMimeType());

			$response['message'] = trans('message.no_file_type');
			return $response;
		}


		$file_name = time() . '-' . $file->getClientOriginalName();
		$file_name = str_replace(" ", "_", $file_name);

		if (!$file->isValid())
			return $response['message'] = trans('file.invalid');

		//$file_destination = $file->storeAs($destination, $file_name, 'public');
		try {
			$file_destination = $file->storeAs($destination, $file_name, 'public');
			$response['fileDir'] = $file_destination;
			$response['message'] = trans('file.success_upload');
			$response['fileName'] = $file_name;
			$response['status'] = true;
			Log::info("Respuesta de almacenamiento de archivo");
			Log::info($response);

			return $response;
		} catch (Exception $e) {
			Log::info("Error al subir archivo");
			Log::info($e->getMessage());
		}

		return false;
	}

	public function getUploadedData()
	{
	}


}
