<?php

namespace Akari\WorldSystem\form;

use Akari\WorldSystem\Loader;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class MainForm extends SimpleForm {

    protected Loader $plugin;

    public function __construct(Loader $plugin){
        $this->plugin = $plugin;
        parent::__construct(function(Player $player, ?int $data) : void{
            if ($data === null) {
                return;
            }
            switch ($data) {
                case 0:
                    $player->sendForm(new CreateWorldForm($this->plugin));
                    break;
                case 1:
                    $player->sendForm(new DeleteWorldForm($this->plugin));
                    break;
                case 2:
                    $player->sendForm(new LoadWorldForm($this->plugin));
                    break;
                case 3:
                    $player->sendForm(new unLoadWorldForm($this->plugin));
                    break;
                case 4:
                    $player->sendForm(new TeleportWorldForm($this->plugin));
                    break;
            }
        });
        $this->setTitle("World Manager");
        $this->addButton("Create World", 0, "textures/items/compass_item");
        $this->addButton("Delete World", 0, "textures/ui/icon_trash");
        $this->addButton("Load World", 0, "textures/ui/up_arrow");
        $this->addButton("unLoad World", 0, "textures/ui/down_arrow");
        $this->addButton("Teleport World", 0, "textures/items/ender_pearl");
    }
}