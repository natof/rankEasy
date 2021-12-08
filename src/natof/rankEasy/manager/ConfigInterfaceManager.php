<?php

namespace natof\rankEasy\manager;

interface ConfigInterfaceManager
{

    /**
     * @return string
     * Get Default rank
     */
    public function getDefaultRank(): string;

    /**
     * @param string $rank
     * @return string
     * Get color of rank
     */
    public function getColorRank(string $rank): string;

    /**
     * @param string $rank
     * @return string
     * Get color of message
     */
    public function getColorMessage(string $rank): string;

    /**
     * @param string $rank
     * @return bool
     * Check if the rank exist in the config
     */
    public function existRank(string $rank): bool;

    /**
     * @param string $rank
     * @return array
     */
    public function getPermission(string $rank): array;

    /**
     * @return array
     */
    public function getRanks(): array;
}