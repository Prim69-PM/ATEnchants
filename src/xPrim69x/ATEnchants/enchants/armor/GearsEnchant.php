<?php

namespace xPrim69x\ATEnchants\enchants\armor;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\Item;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\ToggledArmorEnchant;

class GearsEnchant extends ToggledArmorEnchant {

	public function onEquip(Player $player, Item $item){
		$player->addEffect(new EffectInstance(Effect::getEffect(Effect::SPEED), 2147483647, $item->getEnchantment(79)->getLevel() - 1));
	}

	public function onDequip(Player $player, Item $item){
		if($player->hasEffect(Effect::SPEED)) $player->removeEffect(Effect::SPEED);
	}

}