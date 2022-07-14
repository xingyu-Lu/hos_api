<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\TechnicalOffice;
use App\Models\TechnicalOfficeDoctor;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Overtrue\Pinyin\Pinyin;

class TechnicalOfficeDoctorsController extends Controller
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

        if ($params['office_name']) {
            $where[] = ['office_name', 'like', '%' . $params['office_name'] . '%'];
        }

        $news = TechnicalOfficeDoctor::where($where)->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(30);

        foreach ($news as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['url'] = $url;
        }

        return responder()->success($news);
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

        if ($params['img']) {
            $params['file_id'] = $params['img'];
        }

        unset($params['img']);

        $office_id = $params['office_id'];

        $office = TechnicalOffice::where('id', $office_id)->first();

        $params['office_name'] = $office['name'];

        $params['professional'] = $params['professional'] ?? '';

        TechnicalOfficeDoctor::create($params);

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
        $doctor = TechnicalOfficeDoctor::find($id);

        $file = UploadFile::find($doctor['file_id']);

        $url = '';

        if ($file) {
            $url = Storage::disk('public')->url($file['file_url']);
        }

        $doctor->url = $url;

        return responder()->success($doctor);
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

        if ($params['img']) {
            $params['file_id'] = $params['img'];
        }

        unset($params['img']);

        $office_id = $params['office_id'];

        $office = TechnicalOffice::where('id', $office_id)->first();

        $params['office_name'] = $office['name'];

        $params['status'] = 0;

        $params['professional'] = $params['professional'] ?? '';

        TechnicalOfficeDoctor::updateOrCreate(['id' => $id], $params);

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

        TechnicalOfficeDoctor::updateOrCreate(['id' => $id], ['status' => $status]);

        return responder()->success();
    }

    public function synExpert(){
        $doctors = TechnicalOfficeDoctor::where('status', 1)->get()->toArray();

        foreach ($doctors as $key => $value) {
            $expert = Expert::where('name', $value['name'])->first();
            if (in_array($value['professional'], ['主任医师', '副主任医师']) && (!$expert || ($expert && $expert['office_doctor_id'] == $value['id'])) && strpos($value['office_name'], '门诊') === false) {
                $pinyin = new Pinyin();
                $s = mb_substr($value['name'], 0, 1, 'utf-8');
                $firstChar = $pinyin->abbr($s);

                $syn_data = [
                    'office_id' => $value['office_id'],
                    'office_name' => $value['office_name'],
                    'file_id' => $value['file_id'],
                    'office_doctor_id' => $value['id'],
                    'name' => $value['name'],
                    'professional' => $value['professional'],
                    'excel' => $value['excel'],
                    'content' => $value['content'],
                    'index' => $firstChar,
                    'status' => $value['status'],
                ];

                Expert::updateOrCreate(['office_doctor_id' => $value['id']], $syn_data);
            }
        }

        return responder()->success();
    }
}
