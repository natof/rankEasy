<?php

namespace natof\rankEasy;

use natof\rankEasy\command\SetRank;
use natof\rankEasy\event\PlayerListener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;

class RankEasy extends PluginBase
{
    use SingletonTrait;

    protected function onEnable(): void
    {
        @mkdir(self::getInstance()->getDataFolder() . "save");
        $this->saveResource("rank.yml");

        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        Server::getInstance()->getCommandMap()->register("rankEasy", new SetRank());

        parent::onEnable();
    }

    protected function onLoad(): void
    {
        self::setInstance($this);

        parent::onLoad();
    }
}
