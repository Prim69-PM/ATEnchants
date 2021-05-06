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

	public function onArmorChange(EntityArmorChangeEvent $event){
		if($event->isCancelled()) return;
		ToggledArmorEnchant::onToggle($event);
	}

	public function onDamage(EntityDamageEvent $event){
		if($event->isCancelled()) return;
		RandomArmorEnchant::onDamage($event);
	}

	public function onShoot(ProjectileHitBlockEvent $event){
		BowEnchant::onHitBlock($event);
	}

	public function onBreak(BlockBreakEvent $event){
		if($event->isCancelled()) return;
		PickaxeEnchant::onBreak($event);
	}
	
}
