<?php

namespace xPrim69x\ATEnchants\enchants\bow;

use pocketmine\entity\projectile\Arrow;
use pocketmine\item\Item;
use pocketmine\Player;
use xPrim69x\ATEnchants\types\BowEnchant;

class RelocateEnchant extends BowEnchant {

	public function execute(Player $player, Item $item, Arrow $arrow) : void {
		if($player->getLevel() === $arrow->getLevel()) $player->teleport($arrow->getPosition());
	}

}