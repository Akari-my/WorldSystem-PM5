<?php

namespace Akari\WorldSystem\form;

use Akari\WorldSystem\Loader;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class unLoadWorldForm extends CustomForm{

    protected Loader $plugin;

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct(function (Player $player, ?array $data): void {
            if ($data === null) {
                return;
            }

            $worldName = $data[0];
            $worldManager = $this->plugin->getServer()->getWorldManager();

            if ($worldManager->isWorldGenerated($worldName)) {
                $world = $worldManager->getWorldByName($worldName);
                if ($world !== null) {
                    $worldManager->unloadWorld($world);
                    $player->sendMessage("§7World §e$worldName successfully §7unloaded.");
                } else {
                    $player->sendMessage("§cThe world §e$worldName §cis not loaded.");
                }
            } else {
                $player->sendMessage("§cThe world §e$worldName §cdoes not exist.");
            }
        });

        $this->setTitle("unLoad World");
        $this->addInput("World Name:");
    }
}