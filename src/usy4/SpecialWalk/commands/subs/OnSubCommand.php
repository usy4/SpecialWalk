<?php

namespace usy4\SpecialWalk\commands\subs;

use usy4\SpecialWalk\Main;
use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;

class OnSubCommand extends BaseSubCommand {

    protected function prepare(): void {
        //nothing
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void {
        if(isset(Main::$SpecialWalk[$sender->getName()])){
            $sender->sendMessage("§cYou already turn it on");
            return;
        }
        Main::$SpecialWalk[$sender->getName()] = $sender;
        $sender->sendMessage("Done.");
    }

}