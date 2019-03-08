<?php
declare(strict_types=1);
/** Created By Thunder33345 **/

namespace Thunder33345\MIEIM;

use pocketmine\Player;

class ImaginaryCurrency
{
	protected $name = "Undefined";
	protected $ticker = "\$UNDEF";
	protected $msgFormat = [];

	public function __construct(string $name, string $ticker, array $msgFormat)
	{
		$this->name = $name;
		$this->ticker = $ticker;
		$this->msgFormat = $msgFormat;
	}

	public function give(Player $player, float $amount, string $msgOverwrite = null):void
	{
		if($msgOverwrite === null)
			if(isset($this->msgFormat['give']))
				$msgOverwrite = $this->msgFormat['give'];
			else$msgOverwrite = "";

		$msg = str_replace(['%player%', '%amount%', '%ticker', '%name%'], [$player->getName(), $amount, $this->ticker, $this->name], $msgOverwrite);
		$player->sendMessage($msg);
	}

	public function take(Player $player, float $amount, string $msgOverwrite = null):void
	{
		if($msgOverwrite === null)
			if(isset($this->msgFormat['take']))
				$msgOverwrite = $this->msgFormat['take'];
			else$msgOverwrite = "";

		$msg = str_replace(['%player%', '%amount%', '%ticker', '%name%'], [$player->getName(), $amount, $this->ticker, $this->name], $msgOverwrite);
		$player->sendMessage($msg);
	}

	public function get(Player $player):void
	{
		throw new \LogicException("Impossible to get imaginary value.");
	}
}