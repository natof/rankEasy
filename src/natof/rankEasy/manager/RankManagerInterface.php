<?php

namespace natof\rankEasy\manager;

interface RankManagerInterface
{

    /**
     * @return bool
     * Create profile for save rank of player
     */
    public function createProfile(): bool;

    /**
     * @return string
     * Return rank of player
     */
    public function getRank(): string;

    /**
     * @param string $rank
     * @return bool
     * Set rank of player
     */
    public function setRank(string $rank): bool;

}