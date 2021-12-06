<?php

namespace natof\manager;

use natof\GradeEasy;
use pocketmine\utils\Config;

class ConfigManager implements ConfigInterfaceManager{

    /**
     * @var Config
     */
    private Config $config;

    public function __construct()
    {
        $this->config = new Config(GradeEasy::getInstance()->getDataFolder() . "grade.yml", Config::YAML);
    }

    /**
     * @return string
     */
    public function getDefaultGrade(): string
    {
        return $this->config->get("default");
    }

    /**
     * @param string $grade
     * @return string
     */
    public function getColorGrade(string $grade): string
    {
        return $this->config->getNested("grade." . $grade . ".colorGrade");
    }

    /**
     * @param string $grade
     * @return string
     */
    public function getColorMessage(string $grade): string
    {
        return $this->config->getNested("grade." . $grade . ".colorChat");
    }

    public function existGrade(string $grade): bool
    {
        if (is_null($this->config->getNested("grade." . $grade))) return false;
        return true;
    }

    public function getPermission(string $grade): array
    {
        return $this->config->getNested("grade." . $grade . ".permission");
    }

    public function getGrades(): array
    {
        return $this->config->getNested("grade");
    }
}