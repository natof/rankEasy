<?php

namespace natof\manager;

interface ConfigInterfaceManager{

    /**
     * @return string
     * Get Default Grade
     */
    public function getDefaultGrade() : string;

    /**
     * @param string $grade
     * @return string
     * Get color of grade
     */
    public function getColorGrade(string $grade) : string;

    /**
     * @param string $grade
     * @return string
     * Get color of message
     */
    public function getColorMessage(string $grade) : string;

    /**
     * @param string $grade
     * @return bool
     * Check if the grade exist in the config
     */
    public function existGrade(string $grade) : bool;

    /**
     * @param string $grade
     * @return array
     */
    public function getPermission(string $grade) : array;

    /**
     * @return array
     */
    public function getGrades() : array;
}