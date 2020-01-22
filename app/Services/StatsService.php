<?php
namespace App\Services;

use App\Hole;

class StatsService {

     public function getGirValue($requestGir): string {
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

    public function getFirValue(int $holeId, $value) {
         $par = Hole::find($holeId)->par;

         if ($par === 3) {
             return "n/a";
         }

         if (is_bool($value) && $value) {
             return "yes";
         }
         else {
             return "no";
         }
    }

    public function getYesNoValue($requestValue): string {
        if (is_null($requestValue)) {
            return "n/a";
        }

        return $requestValue;
    }
}