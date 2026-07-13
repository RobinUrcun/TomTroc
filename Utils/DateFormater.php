<?php

class DateFormater
{

    public static function format(DateTime $date)
    {
        $now = new DateTime('now');
        $difference = $now->diff($date);

        // echo "<pre>";
        // var_dump($difference);
        // echo "</pre>";
        if ($difference->y >= 1) {
            return $difference->y . " " . ($difference->y > 1 ? "ans" : "an");
        }
        if ($difference->m >= 1) {
            return $difference->m . "mois";
        }
        if ($difference->d >= 1) {
            return $difference->d . " " . ($difference->d > 1 ? "jours" : "jour");
        }
        return $date->setTimezone(new DateTimeZone('Europe/Paris'))->format("H:i");
    }
}
