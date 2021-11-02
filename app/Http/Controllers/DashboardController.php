<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function markNotification( Request $request) {
        if ( $request->input('id') ) {
            \DB::table('notifications')->where( 'id', $request->input('id') )->update([ 'read_at' => \Carbon\Carbon::now() ]);
        } else {
            \DB::table('notifications')->whereNull('read_at')->update([ 'read_at' => \Carbon\Carbon::now() ]);
        }

        return response()->noContent();
    }
}
