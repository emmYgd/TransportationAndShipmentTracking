<?php

namespace App\Http\Controllers\Services;

use App\Models\AdminAbstraction;
use App\Models\UserAbstraction;
use App\Models\UserEntityAbstraction;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Str;

trait ModelEntitiesService 
{

	//in groovy on grails, this would have been transactional:
	
	protected function createService(Request $request): array
	{

		$createStatus = array();

		if ($request->isMethod('post')) {
			
		 	$detailsSaved = UserAbstraction::create($request->all());
		 	
		 	return $detailsSaved;
		 		
		}
	}		

	protected function readService(Model $modelClass, array $queryKeysValues) : array
	{
		
		$readModel = $modelClass::where($queryKeysValues)->first();
		return $readModel;

	}

	protected function readAllService(Model $modelClass)
	{
		
		$readAllModel = $modelClass::get();
		return $readAllModel;

	}

	protected function updateService(Model $modelClass, array $queryKeysValues, array $newKeysValues)
	{

		$updateModel = $modelClass->where($oldKeysValues)->update($newKeysValues);
		return $updateModel;

	}

	protected function deleteService(Model $modelClass, array $deleteKeysValues)
	{

		$deleteModel = $modelClass->where($deleteKeysValues)->delete();
		return $deleteModel;

	}

}

?>