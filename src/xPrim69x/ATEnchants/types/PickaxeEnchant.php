<?php

namespace xPrim69x\ATEnchants\types;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\Player;

abstract class PickaxeEnchant extends Enchantment {

	abstract public function execute(Player $player, Item $item) : void ;

	public static function onBreak(BlockBreakEvent $event) : void {
		$player = $event->getPlayer();
		$item = $event->getItem();
		foreach($item->getEnchantments() as $enchant){
			if(($enchant = $enchant->getType()) instanceof PickaxeEnchant) $enchant->execute($player, $item);
		}
	}

}