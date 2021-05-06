<?php

namespace xPrim69x\ATEnchants\types;

use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\Player;

abstract class ToggledArmorEnchant extends Enchantment {

	abstract public function onEquip(Player $player, Item $item);

	abstract public function onDequip(Player $player, Item $item);

	public static function onToggle(EntityArmorChangeEvent $event){
		$player = $event->getEntity();
		if(!$player instanceof Player) return;
		$item = $event->getNewItem();
		$old = $event->getOldItem();
		foreach($item->getEnchantments() as $enchant){
			if(($enchant = $enchant->getType()) instanceof ToggledArmorEnchant && !$item->equals($old, false, true)) {
				$enchant->onEquip($player, $item);
			}
		}
		foreach($old->getEnchantments() as $enchant){
			if (($enchant = $enchant->getType()) instanceof ToggledArmorEnchant && !$old->equals($item, false, true)) {
				$enchant->onDequip($player, $old);
			}
		}
	}

}