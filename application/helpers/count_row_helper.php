<?php
// outputs the query results //
function countRowTable($table,$condition=null)
{  
    $CI=& get_instance();
    if (!empty($condition) && is_array($condition))
    	foreach ($condition as $key => $value)
    		if (is_numeric($key))
    			$CI->db->where($value);
    		else
    			$CI->db->where($key, $value);
    return $CI->db->get($table)->num_rows();
}
if(!function_exists('countTable'))
{
    function countTable($table,$condition=null){
        $CI=& get_instance();
        if (!empty($condition) && is_array($condition))
        	foreach ($condition as $key => $value)
        		if (is_numeric($key))
        			$CI->db->where($value);
                else if(is_array($value))
                    $CI->db->where_in($value);
        		else
        			$CI->db->where($key, $value);
        return $CI->db->get($table)->num_rows();
    }
}
?>