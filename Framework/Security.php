<?php 

namespace Framework;

class Security {
    
    public static function sanitize($value)
    {
        if (is_array($value) OR is_object($value))
        {
            foreach ($value as $key => $val)
            {
                // Recursively clean each value
                $value[$key] = self::sanitize($val);
            }
        }
        elseif (is_string($value))
        {
            if (strpos($value, "\r") !== FALSE)
            {
                // Standardize newlines
                $value = str_replace(array("\r\n", "\r"), "\n", $value);
            }
            if (strpos($value, "\0") !== FALSE)
            {
                // Null bytes issues
                $value = str_replace("\0", '', $value);
            }
    
        }
    
        return $value;
    }
}