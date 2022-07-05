<?php

namespace App\Http\Controllers\Api\Back;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Models\EpidemicControl;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EpidemicControlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $where = [];

        if ($params['title']) {
            $where[] = ['title', 'like', '%' . $params['title'] . '%'];
        }

        $epidemic_controls = EpidemicControl::where($where)->orderBy('id', 'desc')->paginate(10);

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
        $params = $request->all();

        if (empty($params['title'])) {
            $params['title'] = '';
        }

        if ($params['attachment']) {
            $params['attachment_id'] = $params['attachment'];
        }

        unset($params['attachment']);

        $params['release_time'] = strtotime($params['release_time']);

        EpidemicControl::create($params);

        return responder()->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $epidemic_control = EpidemicControl::find($id);

        $attachment_ids = explode(',', $epidemic_control['attachment_id']);
        $attachment = [];

        foreach ($attachment_ids as $key => $value) {
            $file = UploadFile::find($value);
            if ($file) {
                $attachment[] = [
                    'name' => Storage::disk('public')->url($file['file_url']),
                    'url' => Storage::disk('public')->url($file['file_url'])
                ];
            }
        }

        $epidemic_control->attachment = $attachment;

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
        $params = $request->all();

        if (empty($params['title'])) {
            $params['title'] = '';
        }

        if ($params['attachment']) {
            $params['attachment_id'] = $params['attachment'];
        }

        unset($params['attachment']);

        $params['release_time'] = strtotime($params['release_time']);
        $params['status'] = 0;

        EpidemicControl::updateOrCreate(['id' => $id], $params);

        return responder()->success();
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

    public function status(Request $request)
    {
        $params = $request->all();

        $id = $params['id'];
        $status = $params['status'];

        EpidemicControl::updateOrCreate(['id' => $id], ['status' => $status]);

        return responder()->success();
    }
}
