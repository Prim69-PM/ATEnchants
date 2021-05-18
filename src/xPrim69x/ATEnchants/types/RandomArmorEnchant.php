<?php

namespace xPrim69x\ATEnchants\types;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Armor;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\Player;

abstract class RandomArmorEnchant extends Enchantment {

	abstract public function execute(Player $player, ?Player $damager, Armor $armor) : void ;

	public static function onDamage(EntityDamageEvent $event) : void {
		$player = $event->getEntity();
		if(!$player instanceof Player) return;
		$damager = null;
		if($event instanceof EntityDamageByEntityEvent && $event->getDamager() instanceof Player) $damager = $event->getDamager();
		foreach ($player->getArmorInventory()->getContents() as $armor) {
			foreach($armor->getEnchantments() as $enchant){
				if(($enchant = $enchant->getType()) instanceof RandomArmorEnchant && $armor instanceof Armor){
					$enchant->execute($player, $damager, $armor);
				}
			}
		}
	}

}