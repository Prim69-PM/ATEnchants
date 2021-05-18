<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\level\particle\FlameParticle;
use pocketmine\Player;
use function mt_rand;

class HadesEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool {
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float {
		return 0;
	}

	public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void {
		if($victim instanceof Player && $attacker instanceof Player){
			if(mt_rand(1,50) <= $enchantmentLevel){
				$victim->setOnFire($enchantmentLevel * 2.5);
				$victim->setHealth($victim->getHealth() - $enchantmentLevel * 0.5);
				$victim->getLevel()->addParticle(new FlameParticle($victim->add((mt_rand(-10, 10) / 10), (mt_rand(0, 20) / 10), (mt_rand(-10, 10) / 10))));
			}
		}
	}
}