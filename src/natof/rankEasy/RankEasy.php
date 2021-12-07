<?php

namespace natof\rankEasy;

use natof\rankEasy\command\SetRank;
use natof\rankEasy\event\PlayerListener;
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
        Server::getInstance()->getCommandMap()->register("rankEasy", new SetRank());
        PermissionManager::getInstance()->addPermission(new Permission("rankEasy.rank.use"));
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