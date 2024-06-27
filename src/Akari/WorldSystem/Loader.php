<?php

namespace Akari\WorldSystem;

use Akari\WorldSystem\commands\WorldCommand;
use Akari\WorldSystem\utils\VoidGenerator;
use pocketmine\plugin\PluginBase;
use pocketmine\world\generator\GeneratorManager;

class Loader extends PluginBase {

    protected function onEnable(): void{
        $this->getServer()->getLogger()->info("WorldSystem Enable");
        $this->getServer()->getCommandMap()->register("ws", new WorldCommand($this));
        GeneratorManager::getInstance()->addGenerator(VoidGenerator::class, "void", fn() => null);
    }
}