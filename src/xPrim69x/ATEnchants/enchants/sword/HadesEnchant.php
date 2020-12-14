<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\level\particle\FlameParticle;
use pocketmine\Player;

class HadesEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $d, Entity $player, int $enchantmentLevel) : void{
		if($player instanceof Player && $d instanceof Player){
			if(mt_rand(1,50) <= $enchantmentLevel){
				$player->setOnFire($enchantmentLevel * 2.5);
				$player->setHealth($player->getHealth() - $enchantmentLevel * 0.5);
				$player->getLevel()->addParticle(new FlameParticle($player->add((mt_rand(-10,10)/10),(mt_rand(0,20)/10),(mt_rand(-10,10)/10))));
			}
		}
	}
}