<?php

namespace natof\manager;

interface GradeManagerInterface{

    /**
     * @return bool
     * Create profile for save grade of player
     */
    public function createProfile() : bool;

    /**
     * @return string
     * Return grade of player
     */
    public function getGrade() : string;

    /**
     * @param string $grade
     * @return bool
     * Set grade of player
     */
    public function setGrade(string $grade) : bool;

}