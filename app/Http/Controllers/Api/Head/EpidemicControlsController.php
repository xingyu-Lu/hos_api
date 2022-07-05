<?php

namespace App\Http\Controllers\Api\Head;

use App\Http\Controllers\Controller;
use App\Models\EpidemicControl;
use Illuminate\Http\Request;

class EpidemicControlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $epidemic_controls = EpidemicControl::whereIn('status', $where_arr)->paginate(10);

        return responder()->success($epidemic_controls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $epidemic_control = EpidemicControl::whereIn('status', $where_arr)->where('id', $id)->first();

        $epidemic_control->num += 1;

        $epidemic_control->save();

        return responder()->success($epidemic_control);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
