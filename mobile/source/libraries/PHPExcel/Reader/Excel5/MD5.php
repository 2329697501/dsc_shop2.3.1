<?php
//dezend by  QQ:2172298892
class PHPExcel_Reader_Excel5_MD5
{
	private $a;
	private $b;
	private $c;
	private $d;

	public function __construct()
	{
		$this->reset();
	}

	public function reset()
	{
		$this->a = 1732584193;
		$this->b = 4023233417;
		$this->c = 2562383102;
		$this->d = 271733878;
	}

	public function getContext()
	{
		$s = '';

		foreach (array('a', 'b', 'c', 'd') as $i) {
			$v = $this->$i;
			$s .= chr($v & 255);
			$s .= chr(($v >> 8) & 255);
			$s .= chr(($v >> 16) & 255);
			$s .= chr(($v >> 24) & 255);
		}

		return $s;
	}

	public function add($data)
	{
		$words = array_values(unpack('V16', $data));
		$A = $this->a;
		$B = $this->b;
		$C = $this->c;
		$D = $this->d;
		$F = array('PHPExcel_Reader_Excel5_MD5', 'F');
		$G = array('PHPExcel_Reader_Excel5_MD5', 'G');
		$H = array('PHPExcel_Reader_Excel5_MD5', 'H');
		$I = array('PHPExcel_Reader_Excel5_MD5', 'I');
		self::step($F, $A, $B, $C, $D, $words[0], 7, 3614090360);
		self::step($F, $D, $A, $B, $C, $words[1], 12, 3905402710);
		self::step($F, $C, $D, $A, $B, $words[2], 17, 606105819);
		self::step($F, $B, $C, $D, $A, $words[3], 22, 3250441966);
		self::step($F, $A, $B, $C, $D, $words[4], 7, 4118548399);
		self::step($F, $D, $A, $B, $C, $words[5], 12, 1200080426);
		self::step($F, $C, $D, $A, $B, $words[6], 17, 2821735955);
		self::step($F, $B, $C, $D, $A, $words[7], 22, 4249261313);
		self::step($F, $A, $B, $C, $D, $words[8], 7, 1770035416);
		self::step($F, $D, $A, $B, $C, $words[9], 12, 2336552879);
		self::step($F, $C, $D, $A, $B, $words[10], 17, 4294925233);
		self::step($F, $B, $C, $D, $A, $words[11], 22, 2304563134);
		self::step($F, $A, $B, $C, $D, $words[12], 7, 1804603682);
		self::step($F, $D, $A, $B, $C, $words[13], 12, 4254626195);
		self::step($F, $C, $D, $A, $B, $words[14], 17, 2792965006);
		self::step($F, $B, $C, $D, $A, $words[15], 22, 1236535329);
		self::step($G, $A, $B, $C, $D, $words[1], 5, 4129170786);
		self::step($G, $D, $A, $B, $C, $words[6], 9, 3225465664);
		self::step($G, $C, $D, $A, $B, $words[11], 14, 643717713);
		self::step($G, $B, $C, $D, $A, $words[0], 20, 3921069994);
		self::step($G, $A, $B, $C, $D, $words[5], 5, 3593408605);
		self::step($G, $D, $A, $B, $C, $words[10], 9, 38016083);
		self::step($G, $C, $D, $A, $B, $words[15], 14, 3634488961);
		self::step($G, $B, $C, $D, $A, $words[4], 20, 3889429448);
		self::step($G, $A, $B, $C, $D, $words[9], 5, 568446438);
		self::step($G, $D, $A, $B, $C, $words[14], 9, 3275163606);
		self::step($G, $C, $D, $A, $B, $words[3], 14, 4107603335);
		self::step($G, $B, $C, $D, $A, $words[8], 20, 1163531501);
		self::step($G, $A, $B, $C, $D, $words[13], 5, 2850285829);
		self::step($G, $D, $A, $B, $C, $words[2], 9, 4243563512);
		self::step($G, $C, $D, $A, $B, $words[7], 14, 1735328473);
		self::step($G, $B, $C, $D, $A, $words[12], 20, 2368359562);
		self::step($H, $A, $B, $C, $D, $words[5], 4, 4294588738);
		self::step($H, $D, $A, $B, $C, $words[8], 11, 2272392833);
		self::step($H, $C, $D, $A, $B, $words[11], 16, 1839030562);
		self::step($H, $B, $C, $D, $A, $words[14], 23, 4259657740);
		self::step($H, $A, $B, $C, $D, $words[1], 4, 2763975236);
		self::step($H, $D, $A, $B, $C, $words[4], 11, 1272893353);
		self::step($H, $C, $D, $A, $B, $words[7], 16, 4139469664);
		self::step($H, $B, $C, $D, $A, $words[10], 23, 3200236656);
		self::step($H, $A, $B, $C, $D, $words[13], 4, 681279174);
		self::step($H, $D, $A, $B, $C, $words[0], 11, 3936430074);
		self::step($H, $C, $D, $A, $B, $words[3], 16, 3572445317);
		self::step($H, $B, $C, $D, $A, $words[6], 23, 76029189);
		self::step($H, $A, $B, $C, $D, $words[9], 4, 3654602809);
		self::step($H, $D, $A, $B, $C, $words[12], 11, 3873151461);
		self::step($H, $C, $D, $A, $B, $words[15], 16, 530742520);
		self::step($H, $B, $C, $D, $A, $words[2], 23, 3299628645);
		self::step($I, $A, $B, $C, $D, $words[0], 6, 4096336452);
		self::step($I, $D, $A, $B, $C, $words[7], 10, 1126891415);
		self::step($I, $C, $D, $A, $B, $words[14], 15, 2878612391);
		self::step($I, $B, $C, $D, $A, $words[5], 21, 4237533241);
		self::step($I, $A, $B, $C, $D, $words[12], 6, 1700485571);
		self::step($I, $D, $A, $B, $C, $words[3], 10, 2399980690);
		self::step($I, $C, $D, $A, $B, $words[10], 15, 4293915773);
		self::step($I, $B, $C, $D, $A, $words[1], 21, 2240044497);
		self::step($I, $A, $B, $C, $D, $words[8], 6, 1873313359);
		self::step($I, $D, $A, $B, $C, $words[15], 10, 4264355552);
		self::step($I, $C, $D, $A, $B, $words[6], 15, 2734768916);
		self::step($I, $B, $C, $D, $A, $words[13], 21, 1309151649);
		self::step($I, $A, $B, $C, $D, $words[4], 6, 4149444226);
		self::step($I, $D, $A, $B, $C, $words[11], 10, 3174756917);
		self::step($I, $C, $D, $A, $B, $words[2], 15, 718787259);
		self::step($I, $B, $C, $D, $A, $words[9], 21, 3951481745);
		$this->a = ($this->a + $A) & 4294967295;
		$this->b = ($this->b + $B) & 4294967295;
		$this->c = ($this->c + $C) & 4294967295;
		$this->d = ($this->d + $D) & 4294967295;
	}

	static private function F($X, $Y, $Z)
	{
		return ($X & $Y) | (~$X & $Z);
	}

	static private function G($X, $Y, $Z)
	{
		return ($X & $Z) | ($Y & ~$Z);
	}

	static private function H($X, $Y, $Z)
	{
		return $X ^ $Y ^ $Z;
	}

	static private function I($X, $Y, $Z)
	{
		return $Y ^ ($X | ~$Z);
	}

	static private function step($func, &$A, $B, $C, $D, $M, $s, $t)
	{
		$A = ($A + call_user_func($func, $B, $C, $D) + $M + $t) & 4294967295;
		$A = self::rotate($A, $s);
		$A = ($B + $A) & 4294967295;
	}

	static private function rotate($decimal, $bits)
	{
		$binary = str_pad(decbin($decimal), 32, '0', STR_PAD_LEFT);
		return bindec(substr($binary, $bits) . substr($binary, 0, $bits));
	}
}


?>
