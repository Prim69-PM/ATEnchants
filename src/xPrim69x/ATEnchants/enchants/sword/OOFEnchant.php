<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\Player;
use pocketmine\Server;

class OOFEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $d, Entity $player, int $enchantmentLevel) : void{
		if($player instanceof Player && $d instanceof Player){
			if(mt_rand(1,40) <= $enchantmentLevel){
				foreach(Server::getInstance()->getOnlinePlayers() as $players){
					$pk = new PlaySoundPacket();
					$pk->soundName = "random.hurt";
					$pk->x = $players->getX();
					$pk->y = $players->getY();
					$pk->z = $players->getX();
					$pk->volume = $enchantmentLevel * 2;
					$pk->pitch = 1;
					$players->dataPacket($pk);
				}

			}
		}
	}
}