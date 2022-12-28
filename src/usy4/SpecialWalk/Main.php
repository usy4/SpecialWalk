<?php

namespace usy4\SpecialWalk;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\event\Listener;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockLegacyIds;
use CortexPE\Commando\PacketHooker;
use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\type\util\InvMenuTypeBuilders;
use usy4\SpecialWalk\EventListener;
use usy4\SpecialWalk\gui\SpecialWalkMenu;
use usy4\SpecialWalk\commands\SpecialWalkCommand;


class Main extends PluginBase implements Listener{

    private static Main $instance;
    
    public const TYPE_DROPPER = "SpecialWalk::dropper";

    public static array $data = [];

    public static array $blocks = [];

    public static array $SpecialWalk = [];
    
    
    public static function getInstance(): Main {
        return self::$instance;
    }
    
    protected function onEnable() : void{
        Server::getInstance()->getCommandMap()->register(
            $this->getName(),
            new SpecialWalkCommand($this,
            "specialwalk",
            "To make your walk special",
            aliases: ["sw"]
        ));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
    	if(!PacketHooker::isRegistered()) {
            PacketHooker::register($this);
        }
        self::registerDropper();
        SpecialWalkMenu::init();
        self::$instance = $this;
    }
    
    public function onDisable() : void {
         foreach(self::$blocks as $keys => $values){
             Server::getInstance()->getWorldManager()->getWorldByName($values[5])->setBlockAt($values[0], $values[1], $values[2], $values[3]);
         }
    }

    public static function registerDropper(){
        InvMenuHandler::getTypeRegistry()->register(
            self::TYPE_DROPPER,
            InvMenuTypeBuilders::BLOCK_ACTOR_FIXED()
            ->setBlock(BlockFactory::getInstance()->get(BlockLegacyIds::DROPPER, 0))
            ->setBlockActorId("Dropper")
            ->setSize(9)
            ->setNetworkWindowType(WindowTypes::DROPPER)
            ->build());
    }

    public static function unsetBlocks(Player $player){
        foreach(self::$blocks as $keys => $values){
            if (!str_contains($keys, $player->getName())) return;
            Server::getInstance()->getWorldManager()->getWorldByName($values[5])->setBlockAt($values[0], $values[1], $values[2], $values[3]);
            unset(self::$blocks[$keys]);
        }
    }

}