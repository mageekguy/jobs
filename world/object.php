<?php

namespace jobs\world;

interface object extends comparable
{
	function enterInArea(area $area);
	function leaveArea(area $area);
}
