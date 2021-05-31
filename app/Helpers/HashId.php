<?php

namespace App\Helpers;

use Jenssegers\Optimus\Optimus;

class HashId {
    public static function hashid_encode($id){
        $optimus = new Optimus(640053727, 1925876255, 178453107);
        return $optimus->encode($id);
    }

    public static function hashid_decode($id){
        $optimus = new Optimus(640053727, 1925876255, 178453107);
        return $optimus->decode($id);
    }
}