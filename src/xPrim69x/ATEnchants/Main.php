<?php

namespace xPrim69x\ATEnchants;

use pocketmine\item\Armor;
use pocketmine\item\Bow;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\item\Pickaxe;
use pocketmine\item\Sword;
use pocketmine\plugin\PluginBase;
use function file_get_contents;
use function in_array;
use function is_int;
use function json_decode;

class Main extends PluginBase {

	public static $swordEnchants = [
		"Kaboom" => 3,
		"Zeus" => 3,
		"Bleed" => 3,
		"Daze" => 3,
		"Frost" => 3,
		"Hades" => 3,
		"Poison" => 2,
		"Lifesteal" => 2,
		"Uplift" => 1,
		"OOF" => 1
	];

	public static $armorEnchants = [
		"Bunny" => 3,
		"Gears" => 2,
		"Overlord" => 2,
		"Glowing" => 1,
		"Scorch" => 5,
		"Adrenaline" => 1,
	];

	const BOW_ENCHANTS = [
		"Relocate" => 1
	];

	const PICKAXE_ENCHANTS = [
		"Feed" => 1
	];

	public static $instance;
	public $bleeding = [];

	public function onEnable(){
		$this->saveResource("maxlevels.json");
		$this->saveLevels();

		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$this->getServer()->getCommandMap()->register($this->getName(), new EnchantCommand($this));
		CustomEnchantManager::init();
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

	public static function getType(Item $item, bool $type = true) : ?int {
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

	public static function canEnchant(Item $item, Enchantment $enchantment) : bool {
		$type = self::getType($item);
		if($enchantment->getPrimaryItemFlags() == $type) return true;
		if($item instanceof Armor){
			if($enchantment->getPrimaryItemFlags() == 0x1 | 0x2 | 0x4 | 0x8) return true; //fix
			if($enchantment->getPrimaryItemFlags() == $type) return true;
		}
		return false;
	}

	public function saveLevels(){
		$data = json_decode(file_get_contents($this->getDataFolder() . "maxlevels.json"), true);
		foreach(self::$swordEnchants as $name => $level){
			if(isset($data["swordlevels"][$name]) && is_int($data["swordlevels"][$name])){
				if((int) $data["swordlevels"][$name] <= 0 || (int) $data["swordlevels"][$name] > 10){
					$this->getLogger()->warning("Level for $name must be greater than 0 and less than 11. Setting level to default value of $level");
					continue;
				}
				self::$swordEnchants[$name] = $data["swordlevels"][$name];
			}
		}
		foreach(self::$armorEnchants as $name => $level){
			if(isset($data["armorlevels"][$name]) && is_int($data["armorlevels"][$name])){
				if((int) $data["armorlevels"][$name] <= 0 || (int) $data["armorlevels"][$name] > 10){
					$this->getLogger()->warning("Level for $name must be greater than 0 and less than 11. Setting level to default value of $level");
					continue;
				}
				self::$armorEnchants[$name] = $data["armorlevels"][$name];
			}
		}
	}

}