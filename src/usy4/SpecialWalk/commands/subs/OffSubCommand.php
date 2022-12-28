<?php

namespace usy4\SpecialWalk\commands\subs;

use usy4\SpecialWalk\Main;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

class OffSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        //nothing
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if(!isset(Main::$SpecialWalk[$sender->getName()])){
            $sender->sendMessage("§cYou already turn it off");
            return;
        }
        unset(Main::$SpecialWalk[$sender->getName()]);
        $sender->sendMessage("Done.");
    }

}