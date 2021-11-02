<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['activity_logs'] = Activity::orderBy('id', 'DESC')->get();
        
        return view('backend.activity-logs.manage_activity_logs', $data);
    }

    public function delete( $id )
    {
        try
        {
            // Initialization
            $id = decrypt($id);
            // End Initialization

            $activity_log = Activity::where('id', '=', $id)->delete();

            return redirect('activity-logs')->with('success', 'Activity Log Has Been Successfully Deleted.');
        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }

        return redirect('activity-logs');
    }
}
