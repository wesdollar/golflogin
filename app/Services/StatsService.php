<?php
namespace App\Services;

class StatsService {

    public function getYesNoValue($requestGir) {
        if (is_null($requestGir)) {
            return "n/a";
        }

        switch ($requestGir) {
            case true:
                $value = "yes";
                break;
            case false:
                $value = "no";
                break;
            default:
                $value = "n/a";
        }

        return $value;
    }
}