<?php

interface madisoftThemePluginBaseInterface
{
    /**
     * check if the plugins is active in theme option
     */
    function checkifActive();


    /**
     * tool to return text for attribute of selected options
     */
    function selected($value1, $value2, $print = false);

    function get_post_from_rss($link, $items = 10);
}