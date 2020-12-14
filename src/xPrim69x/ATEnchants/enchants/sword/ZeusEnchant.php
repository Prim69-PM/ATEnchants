<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\Player;

class ZeusEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $d, Entity $player, int $enchantmentLevel) : void{
		if($player instanceof Player && $d instanceof Player){
			if(mt_rand(1,40) <= ($enchantmentLevel * 2)){
				$light = new AddActorPacket();
				$light->type = "minecraft:lightning_bolt";
				$light->entityRuntimeId = Entity::$entityCount++;
				$light->position = new Vector3($player->getX(), $player->getY(), $player->getZ());
				$player->getServer()->broadcastPacket($player->getLevel()->getPlayers(), $light);
				$player->setHealth($player->getHealth() - ($enchantmentLevel * 2));
			}
		}

	}
}