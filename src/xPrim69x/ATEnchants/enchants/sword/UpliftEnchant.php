<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\Player;

class UpliftEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $d, Entity $player, int $enchantmentLevel) : void{
		if($player instanceof Player && $d instanceof Player){
			if(mt_rand(1,23) <= $enchantmentLevel){
				$levels = [2, 1.8, 1.5, 1.5, 1.3, 2.5, 2.9];
				$level = $levels[array_rand($levels)];
				$player->knockBack($d, 0, $player->x - $d->x, $player->z - $d->z, $level);
			}
		}

	}
}