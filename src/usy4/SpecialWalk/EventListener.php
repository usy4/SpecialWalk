<?php

declare(strict_types=1);

namespace usy4\SpecialWalk;

use usy4\SpecialWalk\Main;
use usy4\SpecialWalk\tasks\backTask;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityTeleportEvent;

class EventListener implements Listener
{

    public function onMove(PlayerMoveEvent $event) {
        $player = $event->getPlayer();
        $l = $player->getLocation();
        $block = $player->getWorld()->getBlock(new Vector3($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ()));
        $p = $block->getPosition();
        $alll = ($p->getX() . $p->getY() . $p->getZ());
        if(!$block->isFullCube()) return;
        if(!isset(Main::$data[$player->getName()][1])) return;
        if(Main::$data[$player->getName()][1] == "§rCoal"){
            $ore = VanillaBlocks::COAL_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($p->getX(), $p->getY(), $p->getZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        }elseif(Main::$data[$player->getName()][1] == "§rIron"){
            $ore = VanillaBlocks::IRON_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        } elseif(Main::$data[$player->getName()][1] == "§rGold"){
            $ore = VanillaBlocks::GOLD_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        } elseif(Main::$data[$player->getName()][1] == "§rRedstone"){
            $ore = VanillaBlocks::REDSTONE_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        } elseif(Main::$data[$player->getName()][1] == "§rLapis"){
            $ore = VanillaBlocks::LAPIS_LAZULI_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        } elseif(Main::$data[$player->getName()][1] == "§rDiamond"){
            $ore = VanillaBlocks::DIAMOND_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        } elseif(Main::$data[$player->getName()][1] == "§rEmerald"){
            $ore = VanillaBlocks::EMERALD_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        } elseif(Main::$data[$player->getName()][1] == "§rQuartz"){
            $ore = VanillaBlocks::NETHER_QUARTZ_ORE();
            if($block->isSameType($ore)) return;
            $player->getWorld()->setBlockAt($l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $ore);
            Main::getInstance()->getScheduler()->scheduleDelayedTask(new backTask($block, $player), 20 * 8);
        }
        Main::$blocks[$player->getName() . $alll] = [$l->getFloorX(), $l->getFloorY()-1, $l->getFloorZ(), $block, $alll, $player->getWorld()->getDisplayName()];
    }

    public function onBreak(BlockBreakEvent $event): void
    {
        $block = $event->getBlock();
        $p = $block->getPosition();
        $alll = ($p->getX() . $p->getY() . $p->getZ());
        foreach(Main::$blocks as $keys => $values){
            var_dump($alll == $keys);
            var_dump($alll == Main::$blocks[$keys][4]);
            if ($alll !== Main::$blocks[$keys][4]) return;
            $event->cancel();
        }
    }

    public function onTeleport(EntityTeleportEvent $event): void
    {
        $player = $event->getEntity();
        Main::unsetBlocks($player);
    }

    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        Main::unsetBlocks($player);
        unset(Main::$SpecialWalk[$player->getName()]);
    }

}
