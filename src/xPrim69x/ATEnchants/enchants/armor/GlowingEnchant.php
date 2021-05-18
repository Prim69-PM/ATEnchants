<?php

namespace xPrim69x\ATEnchants\enchants\armor;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\Item;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\ToggledArmorEnchant;

class GlowingEnchant extends ToggledArmorEnchant {

	public function onEquip(Player $player, Item $item) : void {
		$player->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 2147483647, $item->getEnchantment(81)->getLevel() - 1));
	}

	public function onDequip(Player $player, Item $item) : void {
		if($player->hasEffect(Effect::NIGHT_VISION)) $player->removeEffect(Effect::NIGHT_VISION);
	}

}