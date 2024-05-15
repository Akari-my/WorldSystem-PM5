<?php

namespace Akari\WorldSystem\commands;

use Akari\WorldSystem\form\MainForm;
use Akari\WorldSystem\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class WorldCommand extends Command implements PluginOwned{

    protected Loader $plugin;

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct("ws", "Open WorldSystem Menu", "/ws", []);
        $this->setPermission("ws.command.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$sender instanceof Player){
            $sender->sendMessage("§cThis command can only be used in game.");
            return;
        }

        if (!$sender->hasPermission("ws.command.use")){
            $sender->sendMessage("§cYou do not have permission to use This Command");
            return;
        }
        $sender->sendForm(new MainForm($this->plugin));
    }

    public function getOwningPlugin(): Plugin{
        return $this->plugin;
    }
}