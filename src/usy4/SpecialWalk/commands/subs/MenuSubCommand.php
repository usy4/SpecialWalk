<?php

namespace usy4\SpecialWalk\commands\subs;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use usy4\SpecialWalk\gui\SpecialWalkMenu;
use usy4\SpecialWalk\Main;

class MenuSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        //nothing
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if(!isset(Main::$SpecialWalk[$sender->getName()])){
            $sender->sendMessage("§cFirst, Turn the SpecialWalk on");
            return;
        }
        SpecialWalkMenu::send($sender);
    }

}