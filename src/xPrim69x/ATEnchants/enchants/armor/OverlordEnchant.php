<?php

namespace xPrim69x\ATEnchants\enchants\armor;

use pocketmine\item\Item;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\ToggledArmorEnchant;

class OverlordEnchant extends ToggledArmorEnchant {

	public function onEquip(Player $player, Item $item){
		$player->setMaxHealth($player->getMaxHealth() + ($item->getEnchantment(82)->getLevel() * 2));
	}

	public function onDequip(Player $player, Item $item){
		if ($player->getMaxHealth() > 20) {
			$player->setMaxHealth($player->getMaxHealth() - ($item->getEnchantment(82)->getLevel() * 2));
		}
	}

}