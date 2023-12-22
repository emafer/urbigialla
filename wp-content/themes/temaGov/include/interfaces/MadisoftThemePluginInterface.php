<?php

interface madisoftThemePluginInterface
{
    /**
     * check if the plugins is active in theme option
     */
    function checkifActive();

    /**
     * contains the function
     */
    function initFunction();

    /**
     * tool to return text for attribute of selected options
     */
    function selected($value1, $value2, $print = false);
}