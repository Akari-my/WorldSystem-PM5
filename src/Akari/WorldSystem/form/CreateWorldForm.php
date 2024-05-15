<?php

namespace Akari\WorldSystem\form;

use Akari\WorldSystem\Loader;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use pocketmine\world\WorldCreationOptions;

class CreateWorldForm extends CustomForm {

    protected Loader $plugin;

    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
        parent::__construct(function(Player $player, ?array $data): void {
            if ($data === null) {
                return;
            }

            $worldName = $data[0];
            $worldType = $data[1] === 0 ? "pocketmine\\world\\generator\\normal\\Normal" : /* PLEASE DONT USE VOID IS BUGGY */ "Akari\\WorldSystem\\utils\\VoidGenerator";

            $this->plugin->getServer()->getWorldManager()->generateWorld($worldName, WorldCreationOptions::create()->setGeneratorClass($worldType));
            $player->sendMessage("§7World §e$worldName §7created §esuccessfully.");
        });

        $this->setTitle("Create World");
        $this->addInput("World Name:");
        $this->addDropdown("World type:", ["Normal", "Void"]);
    }

}