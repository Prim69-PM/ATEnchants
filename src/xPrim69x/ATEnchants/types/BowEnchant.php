<?php

namespace xPrim69x\ATEnchants\types;

use pocketmine\entity\projectile\Arrow;
use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\Player;

abstract class BowEnchant extends Enchantment {

	abstract public function execute(Player $player, Item $item, Arrow $arrow) : void ;

	public static function onShoot(EntityShootBowEvent $event) : void {
		//
	}

	public static function onHitBlock(ProjectileHitBlockEvent $event) : void {
		$arrow = $event->getEntity();
		if (!$arrow instanceof Arrow) return;
		$player = $arrow->getOwningEntity();
		if($player && $player instanceof Player){
			$item = $player->getInventory()->getItemInHand();
			foreach($item->getEnchantments() as $enchant){
				if(($enchant = $enchant->getType()) instanceof BowEnchant) $enchant->execute($player, $item, $arrow);
			}
		}
	}

}