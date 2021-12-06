<?php

namespace natof;

use natof\command\SetRank;
use natof\event\PlayerListener;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class RankEasy extends PluginBase
{

    private static RankEasy $instance;

    protected function onEnable(): void
    {
        @mkdir(self::getInstance()->getDataFolder() . "save");
        $this->saveResource("rank.yml");
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        Server::getInstance()->getCommandMap()->register("setrank", new SetRank());
        PermissionManager::getInstance()->addPermission(new Permission("rank.use"));
        parent::onEnable();
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        return self::$instance;
    }

    protected function onLoad(): void
    {
        self::$instance = $this;
        parent::onLoad();
    }
}