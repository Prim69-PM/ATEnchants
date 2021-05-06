<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\Player;
use function mt_rand;

class ZeusEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
		if ($victim instanceof Player && $attacker instanceof Player) {
			if (mt_rand(1, 40) <= ($enchantmentLevel * 2)) {
				$light = new AddActorPacket();
				$light->type = "minecraft:lightning_bolt";
				$light->entityRuntimeId = Entity::$entityCount++;
				$light->position = $victim;
				$victim->getServer()->broadcastPacket($victim->getLevel()->getPlayers(), $light);
				$victim->setHealth($victim->getHealth() - ($enchantmentLevel * 2));
			}
		}
	}
}