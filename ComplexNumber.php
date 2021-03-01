<?php 

class ComplexNumber {

	public float $real;
	public float $image;

	public function __construct(float $real, float $image) {
		$this->real = $real;
		$this->image = $image;
	}

	public function add(ComplexNumber $number) : ComplexNumber {
		return new self($this->real + $number->real, $this->image + $number->image);
	}

	public function subtract(ComplexNumber $number, bool $inverse = false) : ComplexNumber {
		$newReal = $this->real - $number->real;
		$newImage = $this->image - $number->image;

		if ($inverse) {
			$newReal = -$newReal;
			$newImage = -$newImage;
		}

		return new self($newReal, $newImage);
	}

	public function multiply(ComplexNumber $number) : ComplexNumber {
		$newReal = $this->real * $number->real - ($this->image * $number->image);
		$newImage = $this->image * $number->real + ($this->real * $number->image);

		return new self($newReal, $newImage);
	}

	public function divide(ComplexNumber $number, bool $inverse = false) : ComplexNumber {
		if (($number->real == 0) && ($number->image == 0)) {
			throw new Exception("Not allow to divide by zero!");
		}

		if ($inverse) {
			$numerator = $number->multiply($this->adjoint());
			$denumenator = $this->multiply($this->adjoint());
		} else {
			$numerator = $this->multiply($number->adjoint());
			$denumenator = $number->multiply($number->adjoint());
		}

		return new self($numerator->real / $denumenator->real, $numerator->image / $denumenator->real);
	}

	public function adjoint() : ComplexNumber {
		return new self($this->real, -$this->image);
	}

	public function convertToStr() : string {
		$str = $this->real == 0 ? "" : $this->real;
		if ($this->image != 0) {
			$sign = $this->image >= 0 ? "+" : "-";
			$str .= " {$sign} " . abs($this->image) . "i";
		}
		return $str;
	}

}