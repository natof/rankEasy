<?php

namespace natof\event;

use natof\GradeEasy;
use natof\manager\ConfigManager;
use natof\manager\GradeManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;

class PlayerListener implements Listener {

    public function onJoin(PlayerJoinEvent $event){
        $gradeManager = new GradeManager($event->getPlayer());
        $gradeManager->createProfile();
    }

    public function onChat(PlayerChatEvent $event){
        $event->cancel();
        $player = $event->getPlayer();
        $configManager = new ConfigManager();
        $gradeManager = new GradeManager($player);
        $grade = $gradeManager->getGrade();
        $colorGrade = $configManager->getColorGrade($grade);
        $colorMessage = $configManager->getColorMessage($grade);
        GradeEasy::getInstance()->getServer()->broadcastMessage("${colorGrade}[${grade}]§r" . $player->getName() . "${colorGrade} §l»§r ${colorMessage}" . $event->getMessage());
    }
}