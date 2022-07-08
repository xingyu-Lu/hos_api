<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\PatientService;
use App\Models\TechnicalOffice;
use App\Models\TechnicalOfficeColumn;
use App\Models\TechnicalOfficeColumnSet;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechnicalOfficeColumnsController extends Controller
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

        if ($params['column_name']) {
            $where[] = ['column_name', 'like', '%' . $params['column_name'] . '%'];
        }

        if ($params['office_name']) {
            $where[] = ['office_name', 'like', '%' . $params['office_name'] . '%'];
        }

        if ($params['title']) {
            $where[] = ['title', 'like', '%' . $params['title'] . '%'];
        }

        $office_columns = TechnicalOfficeColumn::where($where)->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(30);

        foreach ($office_columns as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['url'] = $url;

            $column_set = TechnicalOfficeColumnSet::find($value['column_id']);

            $value['column_type_name'] = $column_set['type'] == 0 ? '图文或视频' : '仅图';

            $healthPromotion = PatientService::where('office_column_id', $value['id'])->first();

            if ($healthPromotion) {
                $value['is_health_promotion_set'] = 1;
            } else {
                $value['is_health_promotion_set'] = 0;
            }
        }

        return responder()->success($office_columns);
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

        $office = TechnicalOffice::find($params['office_id']);

        $column_set = TechnicalOfficeColumnSet::find($params['column_id']);

        $insert_data = [
            'office_id' => $params['office_id'],
            'office_name' => $office['name'],
            'column_id' => $params['column_id'],
            'column_name' => $column_set['name'],
            'title' => $params['title'],
            'file_id' => $params['img'] ?? 0,
            'content' => $params['content'] ?? '',
            'release_time' => strtotime($params['release_time']),
        ];

        TechnicalOfficeColumn::create($insert_data);

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
        $office_column = TechnicalOfficeColumn::find($id);

        $file = UploadFile::find($office_column['file_id']);
        $url = '';
        if ($file) {
            $url = Storage::disk('public')->url($file['file_url']);
        }
        $office_column->url = $url;

        return responder()->success($office_column);
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

        $office = TechnicalOffice::find($params['office_id']);

        $column_set = TechnicalOfficeColumnSet::find($params['column_id']);

        $update_data = [
            'office_id' => $params['office_id'],
            'office_name' => $office['name'],
            'column_id' => $params['column_id'],
            'column_name' => $column_set['name'],
            'title' => $params['title'],
            'file_id' => $params['img'] ?? 0,
            'content' => $params['content'] ?? '',
            'release_time' => strtotime($params['release_time']),
        ];

        TechnicalOfficeColumn::updateOrCreate(['id' => $id], $update_data);

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
        TechnicalOfficeColumn::where('id', $id)->delete();

        return responder()->success();
    }

    public function status(Request $request)
    {
        $params = $request->all();

        $id = $params['id'];
        $status = $params['status'];

        TechnicalOfficeColumn::updateOrCreate(['id' => $id], ['status' => $status]);

        return responder()->success();
    }

    public function healthPromotion(Request $request)
    {
        $params = $request->all();

        foreach ($params['multipleSelection'] as $key => $value) {
            $syn_data = [
                'office_id' => $value['office_id'],
                'office_name' => $value['office_name'],
                'title' => $value['title'],
                'content' => $value['content'],
                'release_time' => strtotime($value['release_time']),
                'status' => $value['status'],
                'type' => 9,
            ];

            PatientService::updateOrCreate(['office_column_id' => $value['id']], $syn_data);
        }

        return responder()->success();
    }
}
