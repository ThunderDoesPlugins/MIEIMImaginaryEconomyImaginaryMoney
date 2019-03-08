<?php
declare(strict_types=1);
/** Created By Thunder33345 **/

namespace Thunder33345\MIEIM;

use pocketmine\plugin\PluginManager;
use pocketmine\Server;

class ImaginaryManager
{
	private static $name = "MIEIMImaginaryEconomyImaginaryMoney";

	private $server;
	private $imaginaryEconomy;
	private $imaginaryTokens = [];

	public function __construct(ImaginaryEconomy $imaginaryEconomy)
	{
		$this->imaginaryEconomy = $imaginaryEconomy;
		$this->server = $imaginaryEconomy->getServer();
	}

	/**
	 * @param string $ticker
	 * Ticker of said currency
	 * @return ImaginaryCurrency
	 * Returns the currency
	 */
	public function getCurrency(string $ticker):?ImaginaryCurrency
	{
		if(!isset($this->imaginaryTokens[$ticker]) OR !$this->imaginaryTokens[$ticker] instanceof ImaginaryCurrency)
			return null;
		else return $this->imaginaryTokens[$ticker];
	}

	public function createCurrency(string $name, string $ticker, array $msgOverwrite):?ImaginaryCurrency
	{
		if(isset($this->imaginaryTokens[$ticker]) AND $this->imaginaryTokens[$ticker] instanceof ImaginaryCurrency){
			return null;
		}
		$this->imaginaryTokens[$ticker] = new ImaginaryCurrency($name, $ticker, $msgOverwrite);
		return $this->imaginaryTokens[$ticker];
	}

	public function createOrGetCurrency(string $name, string $ticker, array $msgOverwrite):?ImaginaryCurrency
	{
		$currency = $this->getCurrency($ticker);
		if($currency === null)
			return $this->createOrGetCurrency($name, $ticker, $msgOverwrite);
		else return $currency;
	}

	/**
	 * @param $server Server|PluginManager
	 *
	 * @throws \UnexpectedValueException \RuntimeException
	 * @return ImaginaryManager
	 *
	 * Main method to get IMEIM Manager
	 */
	public static function getInstance($server):ImaginaryManager
	{
		if($server instanceof Server){
			$server = $server->getPluginManager();
		}
		if(!$server instanceof PluginManager){
			throw new \UnexpectedValueException("\$server must be Server or PluginManager");
		}
		$plugin = $server->getPlugin(self::$name);
		if(!$plugin instanceof ImaginaryEconomy){
			throw new \RuntimeException("Cannot find " . self::$name . " plugin");
		}
		try{
			$MIEIM = $plugin->getMIEIM();
		} catch(\RuntimeException $exception){
			throw $exception;
		}
		if(!$MIEIM instanceof ImaginaryManager){
			throw new \RuntimeException("Fail to get ImaginaryManager");
		}
		return $MIEIM;
	}
}