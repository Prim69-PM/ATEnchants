<?php

namespace xPrim69x\ATEnchants\tasks;

use pocketmine\block\Block;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\scheduler\Task;
use pocketmine\Player;
use xPrim69x\ATEnchants\Main;

class BleedTask extends Task{

	public $main;

	public $player;
	public $runs = 10;

	public function __construct(Main $main, Player $player){
		$this->main = $main;
		$this->player = $player;

		$main->bleeding[$player->getName()] = true;
	}
	//Thanks BoomYourBang for helping me with this task
	public function onRun(int $currentTick){
		if(!in_array($this->player->getName(), $this->main->bleeding)) return;
		$this->runs--;
		if($this->runs <= 0 || !$this->player->isAlive() || !$this->player->isOnline()){
			unset($this->main->bleeding[$this->player->getName()]);
			$this->main->getScheduler()->cancelTask($this->getTaskId());
			return;
		}
		$level = $this->player->getLevel();
		$level->addParticle(new DestroyBlockParticle($this->player->add(0,1), Block::get(236,14)));
		$this->player->setHealth($this->player->getHealth() - 1);
	}
}