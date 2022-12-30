<?php


namespace usy4\SpecialWalk\tasks;

use pocketmine\block\Block;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use usy4\SpecialWalk\Main;

class backTask extends Task {

    public function __construct(public Block $block, public Player $player)
    {
        //NOTHING.
    }

    public function onRun() : void{
        $this->player->getWorld()->setBlockAt($this->block->getPosition()->x, $this->block->getPosition()->y, $this->block->getPosition()->z, $this->block);
        $alll = ($this->block->getPosition()->x. $this->block->getPosition()->y. $this->block->getPosition()->z);
        var_dump($alll);
        unset(Main::$blocks[$this->player->getName() . $alll]);
    }
}
