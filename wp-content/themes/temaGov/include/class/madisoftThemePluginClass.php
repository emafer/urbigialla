<?php

class madisoftThemePluginClass implements madisoftThemePluginBaseInterface
{
    function __construct()
    {
        if ($this->checkifActive()) {
            $this->initFunction();
        }
    }

    //TODO implement
    function checkifActive()
    {
        return true;
    }

    function initFunction()
    {
        // TODO: Implement initFunction() method.
    }

    public function selected($value1, $value2, $print = false)
    {
        if ($value1 == $value2) {
            $testo = ' selected="selected"';
        } else {
            $testo = "";
        }

        if ($print) {
            echo $testo;

            return true;
        }

        return $testo;
    }

    function get_post_from_rss($link, $items = 10)
    {
        $array = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $returned = curl_exec($ch);
        curl_close($ch);
        try {
            $xml = simplexml_load_string($returned);
        } catch (Exception $e) {
            return $array;
        }
        for ($i = 0; $i < $items; $i += 1) {
            if (!isset($xml->channel->item[$i])) {
                $i = $items;
                break;
            }
            $array[$i]["title"] = $xml->channel->item[$i]->title;
            $array[$i]["desc"] = $xml->channel->item[$i]->description;
            $array[$i]["content"] = $xml->channel->item[$i]->children("content", true);
            $array[$i]["date"] = date("d/m/Y", strtotime((string)($xml->channel->item[$i]->pubDate)));
            $array[$i]["link"] = $xml->channel->item[$i]->link;
        }

        return $array;
    }
}