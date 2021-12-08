<?php

namespace natof\rankEasy\event;

use natof\rankEasy\manager\ConfigManager;
use natof\rankEasy\manager\RankManager;
use natof\rankEasy\RankEasy;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;

class PlayerListener implements Listener
{

    public function onJoin(PlayerJoinEvent $event)
    {
        $rankManager = new RankManager($event->getPlayer());
        $rankManager->createProfile();
    }

    public function onChat(PlayerChatEvent $event)
    {
        $event->cancel();
        $player = $event->getPlayer();
        $configManager = new ConfigManager();
        $rankManager = new RankManager($player);
        $rank = $rankManager->getRank();
        $colorRank = $configManager->getColorRank($rank);
        $colorMessage = $configManager->getColorMessage($rank);
        RankEasy::getInstance()->getServer()->broadcastMessage("${colorRank}[${rank}]§r" . $player->getName() . "${colorRank} §l»§r ${colorMessage}" . $event->getMessage());
    }
}