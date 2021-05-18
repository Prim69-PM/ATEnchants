<?php

namespace xPrim69x\ATEnchants;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\event\Listener;
use xPrim69x\ATEnchants\types\BowEnchant;
use xPrim69x\ATEnchants\types\PickaxeEnchant;
use xPrim69x\ATEnchants\types\RandomArmorEnchant;
use xPrim69x\ATEnchants\types\ToggledArmorEnchant;

class EventListener implements Listener {

	/**
	 * @param EntityArmorChangeEvent $event
	 * @ignoreCancelled
	 */
	public function onArmorChange(EntityArmorChangeEvent $event) : void {
		ToggledArmorEnchant::onToggle($event);
	}

	/**
	 * @param EntityDamageEvent $event
	 * @ignoreCancelled
	 */
	public function onDamage(EntityDamageEvent $event) : void {
		RandomArmorEnchant::onDamage($event);
	}

	/**
	 * @param BlockBreakEvent $event
	 * @ignoreCancelled
	 */
	public function onBreak(BlockBreakEvent $event) : void {
		PickaxeEnchant::onBreak($event);
	}

	public function onShoot(ProjectileHitBlockEvent $event) : void {
		BowEnchant::onHitBlock($event);
	}
	
}
