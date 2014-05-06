<?php

namespace jobs\tests\units\object\property;

require __DIR__ . '/../../../runner.php';

class value extends \atoum
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\object\property\value');
	}

	function testMatch()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->match($this->testedInstance))->isTestedInstance
				->object($this->testedInstance->match(clone $this->testedInstance))->isTestedInstance
				->exception(function() { $this->testedInstance->match(new \mock\jobs\world\object\property\value()); })
					->isInstanceOf('jobs\object\property\value\exception')
					->hasMessage('Value does not match!')
		;
	}
}
