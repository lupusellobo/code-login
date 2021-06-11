<?php

namespace codelogin\includes;

class Code_Generator {
	public static function get_code( int $len ) {
		$maxNbrStr = str_repeat( '9', $len );
		$maxNbr = intval( $maxNbrStr );
		$n = mt_rand( 0, $maxNbr );
		$pin = str_pad( $n, $len, "0", STR_PAD_LEFT );
		return $pin;
	}
}
