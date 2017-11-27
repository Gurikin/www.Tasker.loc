<?php
class UtilClass {
    public static function clearData($data, $type="s")
    {
	switch($type) {
            case "s":
            $data = trim(strip_tags($data));
            break;
            case "i":
		$data = abs((int)$data);
            break;
	}
	return $data;
    }
}

function printf_array($format, $arr) 
{ 
    return call_user_func_array('printf', array_merge((array)$format, $arr)); 
} 
?>