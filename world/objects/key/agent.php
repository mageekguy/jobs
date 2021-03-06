<?php

namespace jobs\world\objects\key;

use
	jobs\world\objects\lockable
;

interface agent extends aggregator
{
	function lock(lockable $lockable);
	function unlock(lockable $lockable);
}
