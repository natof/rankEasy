<?php

namespace natof\command;

use natof\manager\ConfigManager;
use natof\manager\RankManager;
use natof\RankEasy;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class SetRank extends Command
{

    public function __construct()
    {
        parent::__construct("setrank", "the command for set rank", "/setrank {player} {rank}");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            if (Server::getInstance()->isOp($sender->getName()) || $sender->hasPermission("rank.use"))
                if (isset($args[0])) {
                    if (Server::getInstance()->getPlayerByPrefix($args[0])) {
                        $target = Server::getInstance()->getPlayerByPrefix($args[0]);
                        $configManager = new ConfigManager();
                        if (isset($args[1])) {
                            if ($configManager->existRank($args[1])) {
                                $rankManager = new RankManager($target);
                                foreach ($configManager->getPermission($rankManager->getRank()) as $permission) {
                                    $target->addAttachment(RankEasy::getInstance(), $permission, false);
                                }
                                $rankManager->setRank($args[1]);
                                foreach ($configManager->getPermission($rankManager->getRank()) as $permission) {
                                    $target->addAttachment(RankEasy::getInstance(), $permission, true);
                                }
                                $sender->sendMessage("[RankEasy] You gave the rank " . $configManager->getColorRank($args[1]) . "$args[1]§r to " . $target->getName() . ".");
                            } else {
                                $sender->sendMessage("[RankEasy] The specified rank does not exist.");
                            }
                        } else {
                            $sender->sendMessage("[RankEasy] The rank is not specified.");
                        }
                    } else {
                        $sender->sendMessage("[RankEasy] Player is not online or exists.");
                    }
                } else {
                    $sender->sendMessage("[RankEasy] The player is not specified.");
                }
        }
    }
}