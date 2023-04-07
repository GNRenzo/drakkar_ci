<?php
	class Encriptar_model extends CI_Model{

		private static $pass1 = "ABCDEFGHIJKLLLMNOPQRSTUVWXYZabcdefrgihklllmnopqrstuvwxyz1234567890 ";
	    private static $pass2 = "|°!#$%&/()=?¡'¿<}~ÇüéâäàåçêëèïîìÄÅÉæÆôöòûùÿÖÜø£Ø×ƒƒáíóúñÑª¿®¦ÁÂÀ©¦ãÃ";
	    private static $v1 = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "L", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "r", "g", "i", "h", "k", "l", "l", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", " ", "@");
	    private static $v2 = array("|", "°", "!", "#", "$", "%", "&", "/", "(", ")", "=", "?", "¡", "'", "¿", "<", "}", "~", "Ç", "ü", "é", "â", "ä", "à", "å", "ç", "ê", "ë", "è", "ï", "î", "ì", "Ä", "Å", "É", "æ", "Æ", "ô", "ö", "ò", "û", "ù", "ÿ", "Ö", "Ü", "ø", "£", "Ø", "×", "ƒ", "á", "í", "ó", "ú", "ñ", "Ñ", "ª", "¿", "®", "¦", "Á", "Â", "À", "©", "¦", "ã", "Ã", "@");
		
		
	    public function encriptar($pass) {
	        return base64_encode($pass);
	    }


	    function desencriptar($pass) {
	       
	        return base64_decode($pass);
	    }

	    function str_split_unicode($str, $l = 0) {
		    if ($l > 0) {
		        $ret = array();
		        $len = mb_strlen($str, "UTF-8");
		        for ($i = 0; $i < $len; $i += $l) {
		            $ret[] = mb_substr($str, $i, $l, "UTF-8");
		        }
		        return $ret;
		    }
		    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		}

		
		
	}
?>