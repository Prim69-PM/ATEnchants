<?php

namespace xPrim69x\ATEnchants;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\projectile\Arrow;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\ProjectileHitBlockEvent;
use pocketmine\event\Listener;
use pocketmine\item\Armor;
use pocketmine\item\Pickaxe;
use pocketmine\Player;

class EventListener implements Listener{

	public function onArmorChange(EntityArmorChangeEvent $event){
		$player = $event->getEntity();
		$item = $event->getNewItem();
		$old = $event->getOldItem();
		if(!$player instanceof Player) return;
		$ef = [
			1 => 79,
			8 => 80,
			16 => 81
		];
		foreach($ef as $effect => $enchant){
			if($item->hasEnchantment($enchant)){
				if(!$player->hasEffect($effect)) {
					$enchantmentLevel = $item->getEnchantment($enchant)->getLevel();
					$player->addEffect(new EffectInstance(Effect::getEffect($effect), 99999999, $enchantmentLevel - 1));
				} }
			if($old->hasEnchantment($enchant)){
				if($player->hasEffect($effect)){
					$player->removeEffect($effect);
				} }
		}
		if($item->hasEnchantment(82)){
			$enchantmentLevel = $item->getEnchantment(82)->getLevel();
			$player->setMaxHealth($player->getMaxHealth() + ($enchantmentLevel * 2));
		}
		if($old->hasEnchantment(82)){
			if($player->getMaxHealth() > 20){
				$enchantmentLevel = $old->getEnchantment(82)->getLevel();
				$player->setMaxHealth($player->getMaxHealth() - ($enchantmentLevel * 2));
			}
		}
	}

	public function onDamage(EntityDamageByEntityEvent $event){
		$player = $event->getEntity();
		if(!$player instanceof Player) return;
		$damager = $event->getDamager();
		if(!$damager instanceof Player) return;
		$arm = $player->getArmorInventory();
		foreach([$arm->getBoots(), $arm->getLeggings(), $arm->getChestplate(), $arm->getHelmet()] as $armor){
			if($armor instanceof Armor){
			if($armor->hasEnchantment(84)){
				$enchantmentLevel = $armor->getEnchantment(84)->getLevel();
				if(mt_rand(1,50) <= $enchantmentLevel){
					$damager->setOnFire($enchantmentLevel);
				} }
			}
		}
	}

	public function onDamagee(EntityDamageEvent $event){
		$player = $event->getEntity();
		if(!$player instanceof Player) return;
		$arm = $player->getArmorInventory();
		foreach([$arm->getBoots(), $arm->getLeggings(), $arm->getChestplate(), $arm->getHelmet()] as $armor){
			if($armor instanceof Armor){
			if($armor->hasEnchantment(85)){
				if($player->getHealth() <= 6){
					$player->addEffect(new EffectInstance(Effect::getEffect(1), 140, 0));
				}
			}
			}
		}
	}

	public function onShoot(ProjectileHitBlockEvent $event){
		$arrow = $event->getEntity();
		if(!$arrow instanceof Arrow) return;
		$player = $arrow->getOwningEntity();
		if(!$player) return;
		if($player instanceof Player){
		$item = $player->getInventory()->getItemInHand();
		if($player->getLevel() === $arrow->getLevel()){
			if(!$item->hasEnchantment(83)) return;
			$player->teleport($arrow->getPosition());
			}
		}
	}

	public function onBreak(BlockBreakEvent $event){
		$player = $event->getPlayer();
		if(!$player) return;
		$item = $player->getInventory()->getItemInHand();
		if(!$item instanceof Pickaxe) return;
		if($player instanceof Player){
			if($item->hasEnchantment(86)) {
				$enchantmentLevel = $item->getEnchantment(86)->getLevel();
				if(mt_rand(1,20) <= $enchantmentLevel){
					if($player->getFood() < 20){
						$player->setFood(min(20, $player->getFood() + mt_rand(7, 10)));
					}
				}
			}
		}
	}

}