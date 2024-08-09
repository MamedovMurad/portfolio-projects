<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser{

    protected function successResponse($data, $message = null, $code = 200)
	{
		return [
			'message'=>$message,
			'error'=>null,
			'data' => $data,
			
		];
	}

	protected function errorResponse($message = null, $code)
	{
	$error=response()->json([
		'error'=>([
		'message' => $message,
		'data' => null])
		
	], $code);
		return $error ;
	}

}