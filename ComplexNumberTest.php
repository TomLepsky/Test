<?php

require_once './vendor/autoload.php';
require_once 'ComplexNumber.php';

use PHPUnit\Framework\TestCase;

class ComplexNumberTest extends TestCase {

	/**
     * @dataProvider numberProvider
     */
	public function testNumber($a, $b, $c, $d, $expected) {
		$test1 = new ComplexNumber($a, $b);
		$test2 = new ComplexNumber($c, $d);
		$result = $test1->divide($test2, true)->multiply($test1)->add($test1)->subtract($test1)->convertToStr();
		$this->assertEquals($expected, $result);
	}

	public function numberProvider() {
		return [
			[10, 18, 8, 6, "8 + 6i"],
			[2, 4.1, 3.2, 7, "3.2 + 7i"]
		];
	}
}