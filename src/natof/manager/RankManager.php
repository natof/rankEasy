<?php

namespace natof\manager;

use natof\RankEasy;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class RankManager implements RankManagerInterface{

    /**
     * @var Player
     */
    private Player $player;

    /**
     * @var Config
     */
    private Config $config;

    public function __construct(Player $player)
    {
        $this->config = new Config(RankEasy::getInstance()->getDataFolder(). "save/" . $player->getName() . ".json", Config::JSON);
        $this->player = $player;
    }

    public function createProfile(): bool
    {
        if(file_exists(RankEasy::getInstance()->getDataFolder(). "save/" . $this->player->getName() . "json")) return false;
        $ConfigManager = new ConfigManager();
        $this->config->set("rank", $ConfigManager->getDefaultRank());
        $this->config->save();
        return true;
    }

    public function getRank(): string
    {
        return $this->config->get("rank");
    }

    public function setRank(string $rank): bool
    {
        $this->config->set("rank", $rank);
        $this->config->save();
        return true;
    }
}