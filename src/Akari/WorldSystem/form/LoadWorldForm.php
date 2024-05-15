<?php

namespace Akari\WorldSystem\form;

use Akari\WorldSystem\Loader;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;

class LoadWorldForm extends CustomForm{

    protected Loader $plugin;

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct(function (Player $player, ?array $data): void {
            if ($data === null) {
                return;
            }
            $worldName = $data[0];

            if ($this->plugin->getServer()->getWorldManager()->isWorldGenerated($worldName)) {
                $this->plugin->getServer()->getWorldManager()->loadWorld($worldName);
                $player->sendMessage("§7World §e$worldName §7loaded successfully.");
            } else {
                $player->sendMessage("§cThe world §e$worldName §cdoes not exist.");
            }
        });
        $this->setTitle("Load World");
        $this->addInput("Name of the world:");
    }
}