<?php

namespace xPrim69x\ATEnchants\enchants\sword;

use pocketmine\entity\Entity;
use pocketmine\entity\Living;
use pocketmine\item\enchantment\MeleeWeaponEnchantment;
use pocketmine\Player;
use xPrim69x\ATEnchants\Main;
use xPrim69x\ATEnchants\tasks\BleedTask;
use function mt_rand;

class BleedEnchant extends MeleeWeaponEnchantment {

	public function isApplicableTo(Entity $victim) : bool{
		return $victim instanceof Living;
	}

	public function getDamageBonus(int $enchantmentLevel) : float{
		return 0;
	}

	public function onPostAttack(Entity $attacker, Entity $victim, int $enchantmentLevel) : void{
		if ($victim instanceof Player && $attacker instanceof Player) {
			if (mt_rand(1, 40) <= $enchantmentLevel) {
				Main::getInstance()->getScheduler()->scheduleRepeatingTask(new BleedTask(Main::getInstance(), $victim), 60);
			}
		}
	}
}