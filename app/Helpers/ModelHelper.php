<?php
namespace App\Helpers;

use CdpTtpProject;
use Cache;

class ModelHelper 
{
    /**
     * Load the model by name and id.
     *
	 * @param  string  $model_name
	 * @param  int  $model_id
     * @return Model
     */
    public static function load($model_name, $model_id = null, $path = '')
    {
        $modelName = str_replace('_','',ucwords($model_name,'_'));
		$class_name = ($modelName == 'User') ? "App\\" . $modelName : "App\\Models\\" . $path . $modelName;
		
		if (!$model_id) {
			$model = new $class_name;
			$model->model_name = $model_name;
			return $model;
		} else {
			return $class_name::findOrFail($model_id);
		}
	}
	
    public static function loadOld($model_name, $model_id = null, $path = '')
    {
        $modelName = str_replace('_','',ucwords($model_name,'_'));
		$class_name = ($modelName == 'User') ? "App\\" . $modelName : "App\\Models\\" . $path . $modelName;
		
		if (!$model_id) {
			$model = new $class_name;
			return $model;
		} else {
			return $class_name::findOrFail($model_id);
		}
	}
	
	
    /**
     * Remove the cache of given model.
     *
	 * @param  Model  $model
     * @return
     */
    public static function flushCache(&$model, $extra = [])
    {
		$cacheKey = $model->name() . '.' . $model->id;
		Cache::forget($cacheKey);
		foreach ($extra as $extendedKey) {
			Cache::forget($cacheKey . '.' . $extendedKey);
		}
	}
	
    /**
     * Remove the cache of given key.
     *
	 * @param  Model  $model
     * @return
     */
    public static function flushCacheOnlyKeys(&$model, $extra = [])
    {
		$cacheKey = $model->name() . '.' . $model->id;
		foreach ($extra as $extendedKey) {
			Cache::forget($cacheKey . '.' . $extendedKey);
		}
	}
}
