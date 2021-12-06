<?php

namespace natof\manager;

use natof\GradeEasy;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class GradeManager implements GradeManagerInterface{

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
        $this->config = new Config(GradeEasy::getInstance()->getDataFolder(). "save/" . $player->getName() . ".json", Config::JSON);
        $this->player = $player;
    }

    public function createProfile(): bool
    {
        if(file_exists(GradeEasy::getInstance()->getDataFolder(). "save/" . $this->player->getName() . "json")) return false;
        $ConfigManager = new ConfigManager();
        $this->config->set("grade", $ConfigManager->getDefaultGrade());
        $this->config->save();
        return true;
    }

    public function getGrade(): string
    {
        return $this->config->get("grade");
    }

    public function setGrade(string $grade): bool
    {
        $this->config->set("grade", $grade);
        $this->config->save();
        return true;
    }
}