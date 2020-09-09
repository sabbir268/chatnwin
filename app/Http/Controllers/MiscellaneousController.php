<?php

namespace App\Http\Controllers;

use App\Miscellaneous;
use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
    public function bonusControl()
    {
        $bonus = Miscellaneous::where('key', 'bonus')->first();

        if ($bonus) {
            if ($bonus->value == 1) {
                $bonus->value = 0;
            } else {
                $bonus->value = 1;
            }
            if ($bonus->save()) {
                return "updated";
            }
        }

        return "error";

        // $miscellaneous = Miscellaneous::create([
        //     'key'   => 'bonus',
        //     'value' => 1,
        // ]);
    }

    public function comingSoon()
    {
        $bonus = Miscellaneous::where('key', 'comingsoon')->first();

        if ($bonus) {
            if ($bonus->value == 1) {
                $bonus->value = 0;
            } else {
                $bonus->value = 1;
            }
            if ($bonus->save()) {
                return "updated";
            }
        }

        return "error";

        // $miscellaneous = Miscellaneous::create([
        //     'key'   => 'comingsoon',
        //     'value' => 1,
        // ]);
    }
}
