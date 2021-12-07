<?php

namespace natof\rankEasy\manager;

use natof\rankEasy\RankEasy;
use pocketmine\utils\Config;

class ConfigManager implements ConfigInterfaceManager
{

    /**
     * @var Config
     */
    private Config $config;

    public function __construct()
    {
        $this->config = new Config(RankEasy::getInstance()->getDataFolder() . "rank.yml", Config::YAML);
    }

    /**
     * @return string
     */
    public function getDefaultRank(): string
    {
        return $this->config->get("default");
    }

    /**
     * @param string $rank
     * @return string
     */
    public function getColorRank(string $rank): string
    {
        return $this->config->getNested("rank." . $rank . ".colorRank");
    }

    /**
     * @param string $rank
     * @return string
     */
    public function getColorMessage(string $rank): string
    {
        return $this->config->getNested("rank." . $rank . ".colorChat");
    }

    public function existRank(string $rank): bool
    {
        if (is_null($this->config->getNested("rank." . $rank))) return false;
        return true;
    }

    public function getPermission(string $rank): array
    {
        return $this->config->getNested("rank." . $rank . ".permission");
    }

    public function getRanks(): array
    {
        return $this->config->getNested("rank");
    }
}