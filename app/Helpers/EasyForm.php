<?php
namespace App\Helpers;

use Illuminate\Support\HtmlString;
use App\Helpers\AppHelper;
use App\Helpers\ApiHelper;
use Storage;

class EasyForm
{
	private static $errors;
	private static $label = 4;
	private static $field = 8;
	private static $noRows = false;
	
	public static function setErrors($errors) {
		self::$errors = $errors;
	}
	
	public static function setNoRows() {
		self::$noRows = true;
	}
	
	public static function setSize($size) {
		if ($size == 'fullpage') {
			self::$label = 3;
			self::$field = 9;
		}
	}
	
	public static function setColSizes($c1, $c2) {
		self::$label = $c1;
		self::$field = $c2;
	}
	
    public static function input($name, $label, $value, $attributes=[])
	{		
		$attributes['value'] = $value;
        return self::toRow($name, $label, '<input '.self::attributes($name, $attributes).'>');
	}
	public static function numbers($name, $label, $value, $attributes=[])
	{
		$attributes['value'] = $value;
        return self::toRow($name, $label, '<input type="number" '.self::attributes($name, $attributes).'>', $attributes);
	}
	
    public static function hidden($name, $value, $attributes=[])
	{		
		$attributes['value'] = $value;
        return '<input type="hidden" '.self::attributes($name, $attributes).'>';
	}
	
    public static function date($name, $label, $value, $attributes=[])
	{		
		$attributes['value'] = $value;
		$hidden = "";
		if (isset($attributes['readonly']) && $attributes['readonly'] === true) {
			$attributes['disabled'] = true;			
			$hidden = "<input type=hidden name='$name' value='$value'>";
		}
		$attributes['readonly'] = true;
		$attributes['autocomplete'] = 'off';
		if (empty($attributes['class'])) $attributes['class'] = 'datepicker';
		$script = "";
		if (isset($attributes['min']) && isset($attributes['max'])) {
			$id = isset($attributes['id']) ? $attributes['id'] : $name;
			$script = "<script>
				$(document).ready(function() {
				  $('#{$id}').datepicker({
					  dateFormat: 'yy-mm-dd',
					  minDate: new Date('".$attributes['min']." 00:00'),
					  maxDate: new Date('".$attributes['max']." 00:00')
				  });
				});
			
			</script>";
		}
		
        return self::toRow($name, $label, $hidden.'<input '.self::attributes($name, $attributes).'>').$script;
	}
	
    public static function select($name, $label, $value, $options, $attributes=[])
	{		
		$attributes['value'] = $value;
		$readonly = (isset($attributes['readonly']) && $attributes['readonly']) ? self::readonly($name) : '';
		$placeholder = (isset($attributes['placeholder'])) ? $attributes['placeholder'] : null;
        return self::toRow($name, $label, '<select '.self::attributes($name, $attributes).'>' . self::options($options, $placeholder, $value) . '</select>' . $readonly);
	}
	
    public static function dependent($name, $label, $value, $options, $parent, $attributes=[])
	{		
		$attributes['value'] = $value;
		
		$dependentScript = self::dependentScript($name, $value, $options, $parent);
		$readonly = (isset($attributes['readonly']) && $attributes['readonly']) ? self::readonly($name) : '';
        return self::toRow($name, $label, '<select '.self::attributes($name, $attributes).'></select>' . $dependentScript . $readonly);
	}
	
    public static function autolist($name, $label, $value, $options, $attributes=[])
	{		
		$attributes['value'] = $value;
		$readonly = (isset($attributes['readonly']) && $attributes['readonly']) ? self::readonly($name) : '';
		$placeholder = (isset($attributes['placeholder'])) ? $attributes['placeholder'] : null;
        return self::toRow($name, $label, '<select '.self::attributes($name, $attributes).'>' . self::options($options, $placeholder, $value) . '</select>' . $readonly);
	}
	
	
    public static function autocomplete($name, $label, $value, $options, $type, $attributes=[])
	{		
		$attributes['autocomplete'] = 'off';
		$autoScript = self::autocompleteScript($name, $options, $value, $type);
        return self::toRow($name, $label, '<div style="max-width: 300px"><div></div><input id="' . $name . '" ' . self::attributes('', $attributes) . ' ><input type="hidden" name="' . $name . '" value="'.$value.'"></div>'.$autoScript);
	}
	
    public static function formDependent($name, $value, $options, $parent, $attributes=[])
	{		
		$attributes['value'] = $value;
		
		$dependentScript = self::dependentScript($name, $value, $options, $parent);
        return '<select '.self::attributes($name, $attributes).'></select>' . $dependentScript;
	}
	
	
    public static function textarea($name, $label, $value, $attributes=[])
	{		
        return self::toRow($name, $label, '<textarea '.self::attributes($name, $attributes).'>'.$value.'</textarea>');
	}
	
    public static function file($name, $label, $value, $attributes=[])
	{		
        $input = '';
		$path = explode('/',$value);
		if (isset($attributes['readonly']) && $attributes['readonly'] && isset($path[1])){
			
			$input = "<div class='py-2'>"
					."<a href='".url("download/{$path[0]}/{$path[1]}")."' class='btn btn-theme'>View File</a> &nbsp;"
					."<input type='hidden' name='$name' value='$value'>"
					."</div>";
		}elseif (!empty($value) && isset($path[1])) {
			$input = "<div class='py-2'>"
					."<a href='".url("download/{$path[0]}/{$path[1]}")."' class='btn btn-theme'>View File</a> &nbsp;"
					."<input type='button' class='btn btn-danger' onclick='deleteFile(this)' value='Delete File'>"
					."<input type='hidden' name='$name' value='$value'>"
					."<input type='file' name='$name' class='d-none'>"
					."</div>";
		} else {
			$input = "<div class='py-2'>"
					."<input type='file' name='$name'>"
					."</div>";
		}
		
		return self::toRow($name, $label, $input);
	}
	
    public static function location($name, $label, $value, $attributes=[])
	{		
		$attributes['value'] = $value;
		return self::toRow($name, $label, '<input '.self::attributes($name, $attributes).'><div class="py-2" id="map_'. $name .'" style="min-height:300px"></div>');
	}	
	
    public static function dynamic($name, $label, $value, $url, $attributes=[])
	{		
		$attributes['autocomplete'] = 'off';
		$autoScript = self::dynamicScript($name, $url, $value);
        return self::toRow($name, $label, '<div style="max-width: 300px"><div></div><input id="' . $name . '" ' . self::attributes('', $attributes) . ' ><input type="hidden" name="' . $name . '" id="' . $name . '__dynamic" value="'.$value.'"></div>'.$autoScript);
	}
	
    public static function viewInput($name, $label, $value, $attributes=[])
	{		
        return self::toRow($name, $label, $value, $attributes);
	}
	
    public static function viewTiny($name, $label, $value)
	{		
        return self::toRow($name, $label, ($value == 1) ? 'Yes' : 'No');
	}
	
    public static function viewSelect($name, $label, $value, $options)
	{		
		
        return self::toRow($name, $label, isset($options[$value]) ? $options[$value] : '');
	}
	
    public static function viewDependent($name, $label, $value, $options, $parentValue)
	{	
        return self::toRow($name, $label, isset($options[$parentValue][$value]) ? $options[$parentValue][$value] : '');
	}
	
    public static function viewMultiple($name, $label, $value, $options)
	{		
		$val = '';
		foreach(explode(',', $value) as $v) {
			$val.= isset($options[$v]) ? $options[$v] . ', ' : '';
		}
        return self::toRow($name, $label, rtrim($val, ', '));
	}
	
     public static function viewImage($name, $label, $value, $thumbnail = true)
	{
		if ($value && Storage::has($value)) {
			$class = ($thumbnail) ? 'thumbnail' : 'image';
			$file = \Storage::get($value);
			return self::toRow($name, $label, "<div class='{$class}' style='background-image: url("."data:image/jpeg;base64,".base64_encode($file).")'></div>");
		}
	}

    public static function viewThumbnail($name, $label, $value, $thumbnail = true)
	{
		if ($value && Storage::has($value)) {
			$class = ($thumbnail) ? 'thumbnail' : 'image';
			$file = \Storage::get($value);
			return self::toRow($name, $label, "<div class='{$class}' style='background-image: url("."data:image/jpeg;base64,".base64_encode($file).")'></div>");
		}
	}

    public static function viewImageFile($name, $label, $value, $code='')
	{
		$filename = !empty($code) ? $code : 'View File';
		$exp = explode('.', $value);
		if (isset($exp[1]) && $exp[1] == 'pdf') {
			//return self::viewFile($name, $label, $value, $code);
			$link = ($value && Storage::has($value)) ? "<span class='pointer d-inline text-theme' href='#' data-toggle='modal' onclick='openPdfViewer(\"". url('viewfile/'.$value.'/'.str_replace('/', '-',$code)) ."\", \"". $code ."\")'>".$filename."</span>" : '<span class="text-danger">No File</span>';
		} else {
			$link = ($value && Storage::has($value)) ? "<span class='pointer d-inline text-theme' href='#' data-toggle='modal' onclick='openImageViewer(\"". url('viewfile/'.$value) ."\", \"". $code ."\")'>".$filename."</span>" : '<span class="text-danger">No File</span>';
		}

		return self::toRow($name, $label, "<div>". $link ."</div>");
	}

    public static function viewFile($name, $label, $value, $placeholder = 'View File')
	{
		$exp = explode('.', $value);
		$type = (isset($exp[1]) && !in_array($exp[1], ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) ? 'download' : 'viewfile';
		$link = ($value && Storage::has($value)) ? "<a href='".url($type.'/'.$value)."' target='_blank'><i class='fas fa-file-image'></i> ".$placeholder."</a>" : '<span class="text-danger">'.$placeholder.' - No File</span>';
		return self::toRow($name, $label, "<div>". $link ."</div>");
	}
	


    public static function viewPublicFile($name, $label, $value, $code='')
	{
		$filename = !empty($code) ? $code : 'View File';
		$exp = explode('.', $value);
		if (isset($exp[1]) && $exp[1] == 'pdf') {
			//return self::viewFile($name, $label, $value, $code);
			$link = "<span class='pointer d-inline text-theme' href='#' data-toggle='modal' onclick='openPdfViewer(\"". url('viewpublicfile/'.$value)."\")'>".$filename."</span>" ;
		} else {
			$link = "<span class='pointer d-inline text-theme' href='#' data-toggle='modal' onclick='openImageViewer(\"". url('viewpublicfile/'.$value) ."\", \"". $code ."\")'>".$filename."</span>" ;
		}

		return self::toRow($name, $label, "<div>". $link ."</div>");
	}
	
    public static function valueSelect($value, $options)
	{		
		
        return isset($options[$value]) ? $options[$value] : '';
	}
	
    public static function valueDependent($value, $options, $parentValue)
	{		
        return isset($options[$parentValue][$value]) ? $options[$parentValue][$value] : '';
	}
	
    public static function valueImage($value, $thumbnail = true)
	{			
		if (Storage::has($value)) {
			$path = explode('/',$value);
			$size = ($thumbnail) ? ' width=200 height=120 ' : '';
			return "<img {$size} src='".url("download/{$path[0]}/{$path[1]}")."'>";
		}
	}
	
    public static function submit($label)
	{		
        return self::toRow('', '&nbsp;', '<input type="submit" class="d-none"><button class="btn btn-theme submit"><i class="fas fa-spinner fa-spin d-none"></i> '.$label.'</button>');
	}
	
    /**
     * Transform to complete Row
     *
     * @param $label Label
	 * @param $input HTML Input
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected static function toRow($name, $label, $input, $attributes=[])
    {
		$class = isset($attributes['class']) ? $attributes['class'] : '';
		$error = !empty($name) ? self::error($name) : '';
		if (!$label) {
			return  self::toHtmlString($input . $error);
		} else {
			$field = '<div class="col-lg-'.(self::$label).' label '. $class .'">' . $label . '</div>'
					.'<div class="col-lg-'.(self::$field).' '.$class.'">' . $input . $error . '</div>';
			return (self::$noRows) ?  self::toHtmlString($field) : self::toHtmlString('<div class="row">'. $field .'</div>');
		}
    }
	 /**
     * Transform to complete Row
     *
     * @param $label Label
	 * @param $input HTML Input
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected static function toField($name, $input)
    {
		$field =  $input . self::error($name);
        return  self::toHtmlString($field);
    }
	
    /**
     * Add Html Attributes using options array
     *
     * @param $options
     *
     * @return String
     */
   
	protected static function attributes($name, $attributes)
    {
        $attr = '';
		if (isset($attributes['readonly']) && !$attributes['readonly']) {
			unset($attributes['readonly']);
		}
		$attributes['name'] = $name;
		$attributes['id'] = !isset($attributes['id']) ? $name : $attributes['id'];
		$attributes['class'] = isset($attributes['class']) ? 'form-control '.$attributes['class'] : 'form-control';
		foreach ($attributes as $k => $v) {
			if (!is_array($v)) {
				$attr.= " $k = '$v' ";
			}
		}
		return $attr;
    }
	
    /**
     * Add Errors 
     *
     * @param $options
     *
     * @return String
     */
    protected static function error($name)
    {
        if (self::$errors && self::$errors->has($name)) {
			return '<div class="error">' . self::$errors->first($name) . '</div>';
		}
    }	
	
    /**
     * Return Select options using drop down value
     *
     * @param $options
     *
     * @return String
     */
    protected static function options($dropdown, $placeholder, $value = [])
    {       
		if (!is_array($value) && strpos($value, ',') !== false) {
			$value = explode(',', $value);
		}
		$value = is_array($value) ? $value : [$value];
		$opts = ($placeholder) ? '<option value="">'.$placeholder.'</option>' : '<option value=""></option>';
		foreach ($dropdown as $k => $v) {
			$selected = (in_array($k,$value)) ? 'selected' : '';			
			$opts.= '<option value="' . $k . '" ' . $selected. '>' . $v . '</option>';
		}
		return $opts;
    }
	
    /**
     * Add Dependencies 
     *
     * @param $name
     * @param $options
     *
     * @return Javascript
     */
    protected static function autoOptions($dropdown, $value = [])
    {
		$value = is_array($value) ? $value : [$value];
		$opts = '<option></option>';
		foreach ($dropdown as $k => $v) {
			$selected = (in_array($k,$value)) ? 'selected' : '';
			$opts.= '<option value="' . $k . '" ' . $selected. '>' . $v . '</option>';
		}
		return $opts;
	
    }
	
	 public static function radio($name, $label, $value, $options, $attributes=[])
	{
		$noempty = false;
		if (isset($attributes['noempty']) && $attributes['noempty']) {
			$noempty = false;
			unset($attributes['noempty']);
		}
		$placeholder = (isset($attributes['placeholder'])) ? $attributes['placeholder'] : null;
        return self::toRow($name, $label, self::radioOptions($options, $name, $placeholder, $value, $noempty, $attributes));
	}
	
	protected static function radioOptions($dropdown, $name, $placeholder, $value = [], $noempty=false, $attributes)
    {
		if (!is_array($value) && strpos($value, ',') !== false) {
			$value = explode(',', $value);
		}
		$value = is_array($value) ? $value : [$value];
		
        $attr = '';	
		$readonlyClass = (isset($attributes['readonly']) && $attributes['readonly']) ? 'pe-none' : '';	
		if (isset($attributes['readonly']) && !$attributes['readonly']) {
			unset($attributes['readonly']);
		}		
		foreach ($attributes as $k => $v) {
				$attr.= " $k = '$v' ";
		}
		
		$opts = '';			
		foreach ($dropdown as $k => $v) {
			$id = $name.'_'.$k;
			$selected = (in_array($k,$value)) ? 'checked' : '';
			$opts.= '<div class="form-check '.$readonlyClass.'"><input type="radio" name="'.$name.'" value="' . $k . '" ' . $selected. ' '.$attr.' id="'.$id.'">  <label class="form-check-label" for="'.$id.'">
    '.$v.'
  </label></div>';
		}
		
		return $opts;
    }
	
	  public static function checkbox($name, $label, $value, $options, $attributes=[])
	{
		$attributes['value'] = $value;
		$noempty = false;
		if (isset($attributes['noempty']) && $attributes['noempty']) {
			$noempty = true;
			unset($attributes['noempty']);
		}
		$placeholder = (isset($attributes['placeholder'])) ? $attributes['placeholder'] : null;
        return self::toRow($name, $label, self::checkOptions($name, $options, $placeholder, $value, $noempty, $attributes));
	}
	
	  protected static function checkOptions($name, $dropdown, $placeholder, $value = [], $noempty=false, $attributes)
    {
		$readonlyClass = (isset($attributes['readonly']) && $attributes['readonly']) ? 'pe-none' : '';	
		if (!is_array($value) && strpos($value, ',') !== false) {
			$value = explode(',', $value);
		}
		$value = is_array($value) ? $value : [$value];
		
		$opts = '';
		foreach ($dropdown as $k => $v) {
			$id = $name.'_'.$k;
			$selected = (in_array($k,$value)) ? 'checked' : '';
			$opts.= '<div class="form-check '.$readonlyClass.'"><input type="checkbox" name="'.$name.'[]" value="' . $k . '" ' . $selected. ' id="'.$id.'"> <label class="form-check-label" for="'.$id.'">
    '.$v.'
  </label></div>';
		}
		return $opts;
    }
	
	 public static function viewCheckbox($name, $label, $value, $attributes=[])
	{		
        return self::toRow($name, $label, $value, $attributes);
	}
	
	public static function viewRadio($name, $label, $value, $options, $attributes=[])
	{
		 return self::toRow($name, $label, isset($options[$value]) ? $options[$value] : '');
	}
	
    /**
     * Transform the string to an Html serializable object
     *
     * @param $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected static function toHtmlString($html)
    {
        return new HtmlString($html);
    }
	
	
    /**
     * Add Dependencies 
     *
     * @param $name
     * @param $options
     *
     * @return Javascript
     */
    protected static function dependentScript($name, $value, $options, $parent)
    {
		return "<script>
				if (typeof dependencies === 'undefined') {
					var dependencies = [];
					
				}
				if (typeof dependencies['$parent'] === 'undefined') {
					dependencies['$parent'] = [];
					
				}
				dependencies['$parent']['$name'] = ".json_encode($options).";
				
				updateDependent('$parent', '$name', '$value');
				document.getElementById('$parent').onchange = function() {
					updateDependencies('$parent');
				}
			</script>";
	
    }
	 /**
     * Add Autocompletes 
     *
     * @param $name
     * @param $options
     *
     * @return Javascript
     */
    protected static function autocompleteScript($name, $options, $value, $type)
    {
		return "<script>
				if (typeof autoItems === 'undefined') {
					var autoItems = [];
					
				}
				if (!('$type' in autoItems)) {
					autoItems['$type'] = ".json_encode($options).";
				}
				$( function() {
				$( '#$name')
				.autocomplete({ 
				 create: function( event, ui ) {
       					$(this).attr('autocomplete', 'off');
    				 },
				 source: autoItems['$type'],
					select: function( event, ui ) {
					  updateAutoComplete('$name', ui.item.key, '$type');
					  this.value = '';
					  return false;
					}
				});
			  } );
			  updateAutoComplete('$name', '', '$type');
			  
			</script>";
	
    }	
	
	 /**
     * Add Dynamic 
     *
     * @param $name
     * @param $options
     *
     * @return Javascript
     */
    protected static function dynamicScript($name, $url, $value)
    {
		return "<script>
				
				$( function() {
				$( '#$name')
				.autocomplete({ 
					create: function( event, ui ) {
       					$(this).attr('autocomplete', 'off');
    				},
					source: function( request, response ) {
					   document.getElementById('$name'+'__dynamic').value = '';
						$.ajax({
						  url: '$url'+'/'+ request.term,
						  dataType: 'json',
						  success: function( data ) {
							 document.getElementById('$name'+'__dynamic').value = '';
							 response( data );
						  }
						});
					  },
					select: function( event, ui ) {
					  this.value = ui.item.label;
					  document.getElementById('$name'+'__dynamic').value = ui.item.key;
					  return true;
					}
				});
			  });
			  
			</script>";
	
    }	
	
    protected static function readonly($name) {
		return "<script>			
			   $('#$name').css('pointer-events','none'); 		
				</script>
			";
	}
}
