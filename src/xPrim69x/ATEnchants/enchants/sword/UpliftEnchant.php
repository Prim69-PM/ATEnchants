<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\Player;
use function array_rand;
use function mt_rand;

class UpliftEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
		if ($victim instanceof Player && $attacker instanceof Player) {
			if (mt_rand(1, 23) <= $enchantmentLevel) {
				$levels = [2, 1.8, 1.5, 1.5, 1.3, 2.5, 2.9];
				$level = $levels[array_rand($levels)];
				$victim->knockBack($attacker, 0, $victim->x - $attacker->x, $victim->z - $attacker->z, $level);
			}
		}
	}
}