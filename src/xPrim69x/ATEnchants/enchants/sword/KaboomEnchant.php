<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\level\particle\HugeExplodeParticle;
use pocketmine\Player;

class KaboomEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $d, Entity $player, int $enchantmentLevel) : void{
		if($player instanceof Player && $d instanceof Player){
			if(mt_rand(1,50) <= $enchantmentLevel){
			$level = 0.8;
			if($enchantmentLevel <= 2){
				$level = 0.6;
			}
				$player->getLevel()->addParticle(new HugeExplodeParticle($player));
				$player->getLevel()->broadcastLevelSoundEvent($player, 48);
				$player->knockBack($d, 0, $player->x - $d->x, $player->z - $d->z, $level);
				if($player->getHealth() < 10){
					$player->setHealth($player->getHealth() - ($enchantmentLevel * 1.33));
				} else {
					$player->setHealth($player->getHealth() - ($enchantmentLevel * 2));
				}
			}
		}

	}
}