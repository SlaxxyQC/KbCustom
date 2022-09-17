<?php

namespace KbCustom\Core;

use KbCustom\Commands\CustomKBCommand;
use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\CancelTaskException;
use pocketmine\scheduler\ClosureTask;
use KbCustom\Listener\Events;

class Main extends PluginBase {

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new Events($this), $this);
        $this->getServer()->getCommandMap()->register("ckb", new CustomKBCommand($this));
		$this->getLogger()->notice("KbCustom By SlaxxyQC");
	}

    

}
