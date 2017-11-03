<?php
/**
* 
*/
class CleanDoor
{
	// Método que elimina texto en html
	static function cambiaParaEnvio($cadena){
		$cadena = htmlentities($cadena,ENT_NOQUOTES,"ISO8859-1");
		return($cadena);
	}

	//Método que permite reemplazar caracteres especiales
	static function limpiarMiga($nombreVariable){
		$limpieza = array(	/*" " => "-",*/
							"á" => "á",
							"é" => "é",
							"í" => "í",
							"ó" => "ó",
							"ú" => "ú",
							"Á" => "Á",
							"É" => "É",
							"Í" => "Í",
							"Ó" => "Ó",
							"Ú" => "Ú",
							"ñ" => "ñ",
							"Ñ" => "Ñ",
							"&aacute;" => "á",
							"&eacute;" => "é",
							"&iacute;" => "í",
							"&oacute;" => "ó",
							"&uacute;" => "ú",
							"&Aacute;" => "Á",
							"&Eacute;" => "É",
							"&Iacute;" => "Í",
							"&Oacute;" => "Ó",
							"&Uacute;" => "Ú",
							"&ntilde;" => "Ñ",
							"&Ntilde;" => "Ñ",
							"_" => "-",
							"(" => "-",
							")" => "-"
		);
		$nombreVariable = strtr($nombreVariable, $limpieza);
		return $nombreVariable;
	}
	// Método para buscar inyecciones 
	static function buscaInjec($valor){
		//Si encontramos alguna palabra reservada
		$blocked = array("cast","char","convert","declare","delete","drop","exec","insert","meta","script","select","set","truncate","update","version");
		for($i = 0; $i < count($blocked); $i++) {
			// Comprobamos si estan
			if (in_array($valor, $blocked)) {
				exit;
			}
		}
		return $valor;
	}

	// Método para borrar xss
    static function xss_cleaner_str($input_str) {
        $return_str = str_replace( array("cast","char","convert","declare","drop","exec","meta","script","select","set","truncate","version","CAST","CHAR","CONVERT","DECLARE","DROP","EXEC","META","SCRIPT","SELECT","SET","TRUNCATE","VERSION"),'', $input_str ); 
        return $return_str;
    }

    // Método para borrar xss
	static function xss_cleaner($input_str) {
		$return_str = str_replace( array('<','>',"'",'"',')','(','&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;','/'),'', $input_str ); 
		$return_str = str_ireplace( '%3Cscript', '', $return_str ); 
		return $return_str;
	}


	static function clean_input( $input, $safe_level = 0 ) {
        $output = $input;
        do {
            // Treat $input as buffer on each loop, faster than new var
            $input = $output;
            
            // Remove unwanted tags
            $output = self::strip_tags( $input );
            $output = self::strip_encoded_entities( $output );
            // Use 2nd input param if not empty or '0'
            if ( $safe_level !== 0 ) {
                $output = self::strip_base64( $output );
            }
        } while ( $output !== $input );
        return $output;
    }
    /*
     * Focuses on stripping encoded entities
     * *** This appears to be why people use this sample code. Unclear how well Kses does this ***
     *
     * @param   string  $input  Content to be cleaned. It MAY be modified in output
     * @return  string  $input  Modified $input string
     */
    static function strip_encoded_entities( $input ) {
        // Fix &entity\n;
        $input = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $input);
        $input = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $input);
        $input = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $input);
        $input = html_entity_decode($input, ENT_COMPAT, 'UTF-8');
        // Remove any attribute starting with "on" or xmlns
        $input = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+[>\b]?#iu', '$1>', $input);
        // Remove javascript: and vbscript: protocols
        $input = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $input);
        $input = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $input);
        $input = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $input);
        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $input = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $input);
        $input = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $input);
        $input = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $input);
        return $input;
    }
    /*
     * Focuses on stripping unencoded HTML tags & namespaces
     *
     * @param   string  $input  Content to be cleaned. It MAY be modified in output
     * @return  string  $input  Modified $input string
     */
    static function strip_tags( $input ) {
        // Remove tags
        $input = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $input);
        // Remove namespaced elements
        $input = preg_replace('#</*\w+:\w[^>]*+>#i', '', $input);
        return $input;
    }
    /*
     * Focuses on stripping entities from Base64 encoded strings
     *
     * NOT ENABLED by default!
     * To enable 2nd param of clean_input() can be set to anything other than 0 or '0':
     * ie: xssClean->clean_input( $input_string, 1 )
     *
     * @param   string  $input      Maybe Base64 encoded string
     * @return  string  $output     Modified & re-encoded $input string
     */
    static function strip_base64( $input ) {
        $decoded = base64_decode( $input );
        $decoded = self::strip_tags( $decoded );
        $decoded = self::strip_encoded_entities( $decoded );
        $output = base64_encode( $decoded );
        return $output;
    }






	// Método que llama todas las funciones de limpieza de la url
	static function allClean($cadena,$xss_cleaner=false){
		//$cadena=self::cambiaParaEnvio($cadena);
		$cadena=self::limpiarMiga($cadena);
		$cadena=self::buscaInjec($cadena);
        $cadena=self::xss_cleaner_str($cadena);
        if ($xss_cleaner) {
            $cadena=self::xss_cleaner($cadena);
        }
		$cadena=self::clean_input($cadena);
		return $cadena;
	}
}


	
?>