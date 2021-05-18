<?php

namespace xPrim69x\ATEnchants\enchants\pickaxe;

use pocketmine\item\Item;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\PickaxeEnchant;
use function min;
use function mt_rand;

class FeedEnchant extends PickaxeEnchant {

	public function execute(Player $player, Item $item) : void {
		$enchantmentLevel = $item->getEnchantment(86)->getLevel();
		if(mt_rand(1, 20) <= $enchantmentLevel){
			if($player->getFood() < 20) $player->setFood(min(20, $player->getFood() + mt_rand(7, 10)));
		}
	}

}