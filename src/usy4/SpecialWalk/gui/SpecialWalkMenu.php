<?php

declare(strict_types=1);

namespace usy4\SpecialWalk\gui;

use usy4\SpecialWalk\Main;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use pocketmine\player\Player;
use pocketmine\block\VanillaBlocks;

class SpecialWalkMenu
{
    private static InvMenu $menu;

    public static function init()
    {
        $menu = InvMenu::create(Main::TYPE_DROPPER);
        $menu->setName("SpecialWalk Menu");
        $menu->getInventory()->setItem(0, VanillaBlocks::COAL_ORE()->asItem()->setCustomName("§rCoal"));
        $menu->getInventory()->setItem(1, VanillaBlocks::IRON_ORE()->asItem()->setCustomName("§rIron"));
        $menu->getInventory()->setItem(2, VanillaBlocks::GOLD_ORE()->asItem()->setCustomName("§rGold"));
        $menu->getInventory()->setItem(3, VanillaBlocks::REDSTONE_ORE()->asItem()->setCustomName("§rRedstone"));
        $menu->getInventory()->setItem(4, VanillaBlocks::LAPIS_LAZULI_ORE()->asItem()->setCustomName("§rLapis"));
        $menu->getInventory()->setItem(5, VanillaBlocks::DIAMOND_ORE()->asItem()->setCustomName("§rDiamond"));
        $menu->getInventory()->setItem(6, VanillaBlocks::EMERALD_ORE()->asItem()->setCustomName("§rEmerald"));
        $menu->getInventory()->setItem(7, VanillaBlocks::NETHER_QUARTZ_ORE()->asItem()->setCustomName("§rQuartz"));
        $inv = $menu->getInventory();
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void{
            $player = $transaction->getPlayer();
            $item = $transaction->getItemClicked();
            $transaction->getPlayer()->removeCurrentWindow();
            $permission = ("specialwalk" . "." . str_replace("§r","",strtolower($item->getCustomName())));
            if(!$player->hasPermission($permission)){
                $player->sendMessage("§cYou dont have permission: " . $permission);
                return;
            }
            Main::unsetBlocks($player);
            Main::$data[$player->getName()] = [$player, $item->getCustomName()];
            $player->sendMessage("Done, You choose ".$item->getCustomName());
        }));
        self::$menu = $menu;
    }

    public static function send(Player $player)
    {
        self::$menu->send($player);
    }
}
