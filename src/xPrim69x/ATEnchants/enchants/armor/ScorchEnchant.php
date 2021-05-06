<?php

namespace xPrim69x\ATEnchants\enchants\armor;

use pocketmine\item\Armor;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\RandomArmorEnchant;
use function is_null;
use function mt_rand;

class ScorchEnchant extends RandomArmorEnchant {

	public function execute(Player $player, ?Player $damager, Armor $armor){
		if(is_null($damager)) return;
		$level = $armor->getEnchantment(84)->getLevel();
		if (mt_rand(1, 50) <= $level) $damager->setOnFire($level);
	}

}