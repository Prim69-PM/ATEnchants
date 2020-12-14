<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\Player;
use xPrim69x\ATEnchants\Main;

class GooeyEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $d, Entity $player, int $enchantmentLevel) : void{
    		if($player instanceof Player && $d instanceof Player){
			if(mt_rand(1,40) <= ($enchantmentLevel * 2)){
				if (!$entity->isClosed() && !$entity->isFlaggedForDespawn())
					$entity->setMotion(new Vector3($entity->getMotion()->x, $enchantmentLevel * .15 + .75, $entity->getMotion()->z));
			}
		}
	}
}
