<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\level\particle\HugeExplodeParticle;
use pocketmine\Player;
use function mt_rand;

class KaboomEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
		if ($victim instanceof Player && $attacker instanceof Player) {
			if (mt_rand(1, 50) <= $enchantmentLevel) {
				$level = 0.8;
				if ($enchantmentLevel <= 2) {
					$level = 0.6;
				}
				$victim->getLevel()->addParticle(new HugeExplodeParticle($victim));
				$victim->getLevel()->broadcastLevelSoundEvent($victim, 48);
				$victim->knockBack($attacker, 0, $victim->x - $attacker->x, $victim->z - $attacker->z, $level);
				if ($victim->getHealth() < 10) {
					$victim->setHealth($victim->getHealth() - ($enchantmentLevel * 1.33));
				} else {
					$victim->setHealth($victim->getHealth() - ($enchantmentLevel * 2));
				}
			}
		}
	}
}