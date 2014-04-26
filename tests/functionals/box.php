<?php

namespace jobs\tests\functionals;

require __DIR__ . '/runner.php';

use
	jobs\world,
	jobs\objects\box
;

class object implements world\object
{
	static $objects = 0;

	public function __construct()
	{
		static::$objects++;

		$this->name = static::$objects;
	}

	public function __toString()
	{
		return 'object ' . $this->name;
	}

	public function ifEqualTo(world\comparable $object, callable $callable)
	{
		if ($this == $object)
		{
			$callable();
		}

		return $this;
	}

	public function ifIdenticalTo(world\comparable $object, callable $callable)
	{
		if ($this === $object)
		{
			$callable();
		}

		return $this;
	}
}

class user implements world\objects\box\user
{
	public function takeKey(world\objects\key $key)
	{
		return $this;
	}

	public function giveKey(world\objects\key\aggregator $aggregator)
	{
		return $this;
	}

	public function openBox(world\objects\box $box, callable $callable = null)
	{
		$box->userOpen($this, $callable);

		return $this;
	}

	public function closeBox(world\objects\box $box, callable $callable = null)
	{
		$box->userClose($this, $callable);

		return $this;
	}

	public function lock(world\objects\lockable $lockable, callable $callable)
	{
		return $this;
	}

	public function unlock(world\objects\lockable $lockable, callable $callable)
	{
		return $this;
	}
}

$user = new user();

(new box())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userRemove($user, 1, function($object) { echo $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo $object . PHP_EOL; })
;