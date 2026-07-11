<?php

class Redirect
{

    public static function to(string $url, ?array $arguments = null)
    {
        $completeUrl = "Location: " . "index.php?page=" . $url;

        if ($arguments) {
            $completeUrl .= "&";
            foreach ($arguments as $key => $value) {
                $completeUrl .= $key;
                $completeUrl .= "=";
                $completeUrl .= $value;
            }
        }
        header($completeUrl);
    }
}
