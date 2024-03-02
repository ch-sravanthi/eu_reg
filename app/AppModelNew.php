<?php
namespace App;

use Illuminate\Support\Collection;
use App\Helpers\ApiHelper;

class AppModelNew
{
	
	private $niceNames; 
	
	public function __construct($id = null) {
		if (isset($this->fillable)) {
			foreach($this->fillable as $f) {
				$this->$f = null;			
			}
		}
		if ($id) { // init
		
			$data = ApiHelper::get('model/get/'.$this->name().'/id/'.$id);	
			if (empty((array)$data)) {
				return;
			}
			$this->load($data);
		}
	}
	
	public function label($field) {
		if (!$this->niceNames) {
			$this->niceNames = $this->niceNames();
		}
		return isset($this->niceNames[$field]) ? $this->niceNames[$field] : $field;
	}
	
	public function fill($attr) {
		foreach($attr as $k => $v) {
			if (preg_match('/^[a-zA-Z0-9_]+$/',$k)) {
				$this->$k = $v;
			}
		}
	}
	
	public function getAttributes() {
		$arr =  (array) $this;
		foreach ($arr as $k => $v) {
			if (is_array($v) || is_object($v)) {
				unset($arr[$k]);
			}
		}
		return $arr;
	}
	
	
	public function load($data) {
		$this->fill($data);
		foreach($this->relations() as $rk => $rel) {
			//var_dump($data->$rk); die();
			if (isset($data->$rk)) {
				if ($rel[0] == 'hasMany') {
					foreach ($data->$rk as $i => $rdata) {
						$relModel = new $rel[1];
						$relModel->load($rdata);
						$this->$rk[$i] = $relModel;
					}
				} elseif ($rel[0] == 'belongsTo' || $rel[0] == 'hasOne') {
					$relModel = new $rel[1]; 
					$relModel->load($data->$rk);
					$this->$rk = $relModel;//var_dump($relModel);
				}
			} else {
				if ($rel[0] == 'hasMany') {
					$data->$rk = new Collection;
				} elseif ($rel[0] == 'belongsTo'  || $rel[0] == 'hasOne') {
					$this->$rk = null;
				}
			}
		}
	}
	public function relations() {
		return [];
	}
	
	public function getRelated($rel, $id = null) {
		$relations = $this->relations();//var_dump($relations);
		if(isset($relations[$rel])) {
			$modelName = $relations[$rel][1];
			return  new $modelName($id);
		}
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
	
}
