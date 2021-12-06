<?php

namespace natof\command;

use natof\GradeEasy;
use natof\manager\ConfigManager;
use natof\manager\GradeManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionAttachment;
use pocketmine\permission\PermissionManager;
use pocketmine\player\Player;
use pocketmine\Server;

class SetGrade extends Command{

    public function __construct()
    {
        parent::__construct("setgrade", "the command for set grade", "/setgrade {player} {grade}");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if(Server::getInstance()->isOp($sender->getName()) || $sender->hasPermission("grade.use"))
            if (isset($args[0])) {
                if (Server::getInstance()->getPlayerByPrefix($args[0])) {
                    $target = Server::getInstance()->getPlayerByPrefix($args[0]);
                    $configManager = new ConfigManager();
                    if (isset($args[1])) {
                        if ($configManager->existGrade($args[1])) {
                            $gradeManager = new GradeManager($target);
                            foreach ($configManager->getPermission($gradeManager->getGrade()) as $permission) {
                                $target->addAttachment(GradeEasy::getInstance(), $permission, false);
                            }
                            $gradeManager->setGrade($args[1]);
                            foreach ($configManager->getPermission($gradeManager->getGrade()) as $permission) {
                                $target->addAttachment(GradeEasy::getInstance(), $permission, true);
                            }
                            $sender->sendMessage("[GradeEasy] You gave the grade " . $configManager->getColorGrade($args[1]) . "$args[1]§r to " . $target->getName() . ".");
                        } else {
                            $sender->sendMessage("[GradeEasy] The specified grade does not exist.");
                        }
                    } else {
                        $sender->sendMessage("[GradeEasy] The grade is not specified.");
                    }
                } else {
                    $sender->sendMessage("[GradeEasy] Player is not online or exists.");
                }
            } else {
                $sender->sendMessage("[GradeEasy] The player is not specified.");
            }
        }
    }
}