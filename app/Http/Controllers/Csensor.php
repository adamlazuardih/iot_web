<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Csensor extends Controller
{
    function store(Request $r) {

        DB::table('sensor')->insert([
            'hub_id' => $r->hub_id,
            'sensorsuhu' => $r->sensorsuhu,
            'sensorph' => $r->sensorph,
            'sensortds' => $r->sensortds,
            'sensoramonia' => $r->sensoramonia,
            'sensorkekeruhan' => $r->sensorkekeruhan
        ]);
        return 'Data Terkirim ke Database';
    }

    function get() {
        return DB::table('sensor')->get();
    }
}
