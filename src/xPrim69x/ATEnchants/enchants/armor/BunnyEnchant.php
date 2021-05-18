<?php

namespace xPrim69x\ATEnchants\enchants\armor;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\Item;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\ToggledArmorEnchant;

class BunnyEnchant extends ToggledArmorEnchant {

	public function onEquip(Player $player, Item $item) : void {
		$player->addEffect(new EffectInstance(Effect::getEffect(Effect::JUMP_BOOST), 2147483647, $item->getEnchantment(80)->getLevel() - 1));
	}

	public function onDequip(Player $player, Item $item) : void {
		if($player->hasEffect(Effect::JUMP_BOOST)) $player->removeEffect(Effect::JUMP_BOOST);
	}

}