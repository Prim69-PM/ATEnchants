<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\Player;
use function mt_rand;

class LifestealEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
		if ($victim instanceof Player && $attacker instanceof Player) {
			if (mt_rand(1, 50) <= $enchantmentLevel) {
				if ($victim->getHealth() > 10 && $attacker->getHealth() < 19) {
					$victim->setHealth($victim->getHealth() - 2);
					$attacker->setHealth($attacker->getHealth() + 2);
				}
			}
		}
	}
}