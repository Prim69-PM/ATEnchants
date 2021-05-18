<?php

namespace xPrim69x\ATEnchants\enchants\armor;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\item\Armor;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\RandomArmorEnchant;

class AdrenalineEnchant extends RandomArmorEnchant {

	public function execute(Player $player, ?Player $damager, Armor $armor) : void {
		if ($player->getHealth() <= 6) $player->addEffect(new EffectInstance(Effect::getEffect(Effect::SPEED), 140, 0));
	}

}