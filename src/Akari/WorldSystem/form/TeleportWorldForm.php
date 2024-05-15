<?php

namespace Akari\WorldSystem\form;

use Akari\WorldSystem\Loader;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class TeleportWorldForm extends CustomForm {

    protected Loader $plugin;

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct(function (Player $player, ?array $data): void {
            if ($data === null) {
                return;
            }

            $worldName = $data[0];
            $worldManager = $this->plugin->getServer()->getWorldManager();

            $world = $worldManager->getWorldByName($worldName);

            if ($world !== null) {
                $player->teleport($world->getSafeSpawn());
                $player->sendMessage("§7Teleported to world §e$worldName.");
            } else {
                $player->sendMessage("§cThe world §e$worldName §cis not loaded.");
            }
        });

        $this->setTitle("Teleport World");
        $this->addInput("World Name:");
    }
}