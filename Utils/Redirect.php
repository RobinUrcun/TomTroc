<?php

class Redirect
{

    public static function to(string $url)
    {
        header("Location: " . "index.php?page=" . $url);
    }
}
