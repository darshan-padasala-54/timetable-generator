<?php
if (! function_exists('recursive_associative_shuffle')) {
    function recursive_associative_shuffle($array)
    {
        $ary_keys = array_keys($array);
        $ary_values = array_values($array);
        shuffle($ary_values);
        foreach($ary_keys as $key => $value) {
            if (is_array($ary_values[$key]) AND $ary_values[$key] != NULL) {
                $ary_values[$key] = recursive_associative_shuffle($ary_values[$key]);
            }
            $new[$value] = $ary_values[$key];
        }
        return $new;
    }
}


