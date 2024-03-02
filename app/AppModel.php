<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class AppModel extends Model
{
	use SoftDeletes;
	private $niceNames; 
	private $names = [];
	protected $unaudit = [];
	/**
     * Relationship User for Created By
     */
    public function created_user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
	
	public function modelname() {
		return rtrim($this->getTable(), 's');
	}
	
	public function label($field) {
		if (!$this->niceNames) {
			$this->niceNames = $this->niceNames();
		}
		return isset($this->niceNames[$field]) ? $this->niceNames[$field] : $field;
	}
	
	public function createdBy() {
		$user = User::find($this->created_by);
		if ($user) return $user->name;
	}
	
	public static function findModel($type, $id, $sub = null) {
		$model = self::getModel($type, $sub);
		return $model::findOrFail($id);
	}
	
	public static function getModel($type, $sub = null) {
		$c = '';
		$exp = explode('_', $type);
		foreach($exp as $v) {
			$c.=ucfirst($v);
		}
		$sub = ($sub) ? $sub . "\\" : '';
		if ($type == 'user'){
			$class ="\\App\\User";
		} elseif (count($exp) > 1) {
			$class = "\\App\\Models\\" . ucfirst($exp[0]) . "\\" .$sub . $c;
		} else {
			$class = "\\App\\Models\\" .$c.'\\'.$c;			
		}
		return new $class;
	}
	
	public function findRelatedModel($relationship, $id) {
		$model = $this->getRelatedModel($relationship);
		return $model::findOrFail($id);
	}
	public function getRelatedModel($relationship) {
		return $this->$relationship()->getRelated();
	}
	public function name() {
		$class = class_basename($this);
		if (!isset($names[$class])) {		
			$pieces = preg_split('/(?=[A-Z])/',$class);
			$return = "";
			foreach($pieces as $v) {
				if (!empty($v)) {
					$return.= strtolower($v) . '_';
				}
			}
			$names[$class] = rtrim($return, '_');
		}
		return $names[$class];
	}
	
	public function title() {
		if ($this->model_title) {
			return $this->model_title;
		}
		$name = $this->name();
		return ucwords(str_replace('_', ' ', $name));
	}
	
	public function getQuery($filters) {
		
		//echo '<pre>'; print_r($filters); echo '</pre>'; die();
		// relate with
		//has relationship
		$hasRelationship = false;
		if (isset($filters['relate'])) {
			foreach($filters['relate'] as $relationship => $types) {
				foreach ($types as $type => $conditions) {
					foreach($conditions as $k => $v) {
						if (!empty($v)) {
							$hasRelationship = true;
							$query = $this::with($relationship);
							break;
						}
					}
				}
			}
		} 
		if (!isset($query)) {
			$query = $this::query();
			
		}
		foreach ($filters as $type => $typeFilters) {
			if (!is_array($typeFilters)) {
				continue;
			}
			
			if ($type == 'relate' && $hasRelationship) {
				foreach($typeFilters as $relationship => $types) {		
					$query->whereHas($relationship, function($query) use ($types){
						foreach ($types as $type => $conditions) {
							foreach($conditions as $k => $v) {	
								$this->addCondition($query, $type, $k, $v);							
							}
						}
					});
				}				
			} else {					
				foreach($typeFilters as $k => $v) {
					$this->addCondition($query, $type, $k, $v);
				}
			}
		}
		return $query;
	}
	
	private function addCondition(&$query, $type, $key, $value) {
		if (empty($value)) return;
		
		if ($type == 'text') {
			$query->where($key, 'like', "%$value%");
		} elseif ($type == 'date' && $value[0] && $value[1]) { 	
			$query->whereBetween($key, $value);
		} elseif ($type == 'select') {
			$query->where($key, $value);
		} elseif ($type == 'exact'){
			$query->where($key, $value);
		}
	}
	
	public static function filter($filter) {
		$query = self::query();		
		foreach ($filter as $k => $v) {
			is_array($v) ? $query->whereIn($k, $v) : $query->where($k, $v);
		}
		return $query;
	}
	
	/*protected static function boot()
    {
		parent::boot();
        // Update field update_by with current user id each time article is updated.
        static::creating(function ($model) {
			if (empty($model->created_by)) {
				$model->created_by = Auth::user()->id;
			}
        });
        // Update field update_by with current user id each time article is updated.
        static::updating(function ($model) {
			if (Auth::user()) {
				$model->updated_by = Auth::user()->id;
			}
        });
    }*/
	
	public function scopeWithAndWhereHas($query, $relation, $constraint){
		return $query->whereHas($relation, $constraint)
                 ->with([$relation => $constraint]);
	}
	
	public function hasLogs() {
		return $this->logs->first() ? true : false;
	}
	
	public function createdUser() {
		return "<i class='fas fa-user'></i> ". \App\User::getUserName($this->created_by) 
				."&nbsp; <i class='fas fa-calendar-alt'></i>" . date('d M Y', strtotime($this->created_at));
	}
	
	public function has($field) {
		return in_array($field, $this->fillable);
	}
	
	
}
