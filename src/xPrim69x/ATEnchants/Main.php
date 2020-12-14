<?php

namespace xPrim69x\ATEnchants;

use pocketmine\item\Armor;
use pocketmine\item\Bow;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\item\Pickaxe;
use pocketmine\item\Sword;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	public static $instance;
	public $bleeding = [];

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$this->getServer()->getCommandMap()->register($this->getName(), new EnchantCommand());
		CustomEnchantManager::init($this);
		self::$instance = $this;
	}

	//Roman numeral conversion function by BoomYourBang
	public static function lvlToRomanNum(int $level) : string{
		$romanNumeralConversionTable = [
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1
		];
		$romanString = "";
		while($level > 0){
			foreach($romanNumeralConversionTable as $rom => $arb){
				if($level >= $arb){
					$level -= $arb;
					$romanString .= $rom;
					break;
				}
			}
		}
		return $romanString;
	}

	public static function getInstance() : Main {
		return self::$instance;
	}

	public static function getType(Item $item, bool $type = true){
		if($item instanceof Sword) return 0x10;
		if($item instanceof Bow) return 0x20;
		if($item instanceof Pickaxe) return 0x400;
		if($type){
			if(in_array($item->getId(), [298, 302, 306, 310, 314])) return 0x1;
			if(in_array($item->getId(), [299, 303, 307, 311, 315])) return 0x2;
			if(in_array($item->getId(), [300, 304, 308, 312, 316])) return 0x4;
			if(in_array($item->getId(), [301, 305, 309, 313, 317])) return 0x8;
		}
		if($item instanceof Armor) return 0x1 | 0x2 | 0x4 | 0x8;
		return null;
	}

	public static function canEnchant(Item $item, Enchantment $enchantment){
		$type = self::getType($item);
		if($enchantment->getPrimaryItemFlags() == $type) return true;
		if($item instanceof Armor){
			if($enchantment->getPrimaryItemFlags() == 0x1 | 0x2 | 0x4 | 0x8) return true;
			if($enchantment->getPrimaryItemFlags() == $type) return true;
		}
		return false;
	}

}
