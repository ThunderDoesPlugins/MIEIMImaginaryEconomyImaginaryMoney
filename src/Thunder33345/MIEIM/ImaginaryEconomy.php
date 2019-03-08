<?php
declare(strict_types=1);
/** Created By Thunder33345 **/

namespace Thunder33345\MIEIM;

use pocketmine\plugin\PluginBase;

class ImaginaryEconomy extends PluginBase
{
	private $MIEIM;

	public function onEnable()
	{
		$this->MIEIM = new ImaginaryManager($this);
	}

	public function getMIEIM()
	{
		if(!isset($this->MIEIM)){
			throw new \RuntimeException("MIEIM Manager Not Initialized");
		}
		return $this->MIEIM;
	}
}