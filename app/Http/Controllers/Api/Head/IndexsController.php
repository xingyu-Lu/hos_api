<?php

namespace App\Http\Controllers\Api\Head;

use App\Http\Controllers\Controller;
use App\Models\EpidemicControl;
use App\Models\Expert;
use App\Models\Job;
use App\Models\News;
use App\Models\Party;
use App\Models\PatientService;
use App\Models\Rotate;
use App\Models\TechnicalOffice;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $data = [];

        // 轮播图
        $rotates = Rotate::where('status', Rotate::STATUS_1)->orderBy('sort', 'asc')->get();

        foreach ($rotates as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['url'] = $url;
        }

        $data['rotates'] = $rotates;

        // 科室
        // $office_1 = TechnicalOffice::skip(0)->whereIn('status', $where_arr)->orderBy('sort', 'asc')->take(5)->get();
        // $office_2 = TechnicalOffice::skip(5)->whereIn('status', $where_arr)->orderBy('sort', 'asc')->take(5)->get();
        // $office_3 = TechnicalOffice::skip(10)->whereIn('status', $where_arr)->orderBy('sort', 'asc')->take(5)->get();        
        $office_0 = TechnicalOffice::whereIn('status', $where_arr)->where('type', 0)->orderBy('index', 'asc')->limit(30)->get()->toArray();
        $office_0 = array_chunk($office_0, 6);

        $office_1 = TechnicalOffice::whereIn('status', $where_arr)->where('type', 1)->orderBy('index', 'asc')->limit(30)->get()->toArray();
        $office_1 = array_chunk($office_1, 6);   

        $office_2 = TechnicalOffice::whereIn('status', $where_arr)->where('type', 2)->orderBy('index', 'asc')->limit(30)->get()->toArray();
        $office_2 = array_chunk($office_2, 6);        

        $data['offices_0'] = $office_0;
        $data['offices_1'] = $office_1;
        $data['offices_2'] = $office_2;

        // $data['offices'][] = $office_1;
        // $data['offices'][] = $office_2;
        // $data['offices'][] = $office_3;

        // 专家
        $expert = Expert::skip(0)->whereIn('status', $where_arr)->orderBy('index', 'asc')->take(6)->get();
        foreach ($expert as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;

            $value['position'] = explode(',', $value['position']);
            $value['professional'] = explode(',', $value['professional']);
        }
        $data['expert'][] = $expert;

        // 医院新闻
        $news = News::where('type', 0)->whereIn('status', $where_arr)->orderBy('is_recommend', 'desc')->orderBy('release_time', 'desc')->orderBy('id', 'desc')->limit(6)->get()->toArray();
        foreach ($news as $key => &$value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;
            $value['title'] = mb_substr($value['title'], 0, 20) . '...';
        }
        unset($value);
        $news = array_chunk($news, 2);
        $data['news_xw'] = $news;

        // $news_0_1 = News::where('type', 0)->whereIn('status', $where_arr)->orderBy('is_recommend', 'desc')->orderBy('release_time', 'desc')->orderBy('id', 'desc')->skip(2)->take(4)->get();
        // foreach ($news_0_1 as $key => $value) {
        //     $file = UploadFile::find($value['file_id']);
        //     $url = '';
        //     if ($file) {
        //         $url = Storage::disk('public')->url($file['file_url']);
        //     }
        //     $value['img_url'] = $url;
        //     $value['title'] = mb_substr($value['title'], 0, 30) . '...';
        // }
        // $data['news_xw'][] = $news_0_1;

        // 医院新闻轮播图
        $news_rotate = News::where('type', 0)->where('is_recommend', 1)->whereIn('status', $where_arr)->orderBy('id', 'desc')->skip(0)->take(4)->get();
        foreach ($news_rotate as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;
            $value['title'] = mb_substr($value['title'], 0, 10) . '...';
        }
        $data['news_rotate'] = $news_rotate;


        // 医院公告
        $news_1 = News::where('type', 1)->whereIn('status', $where_arr)->orderBy('is_recommend', 'desc')->orderBy('release_time', 'desc')->orderBy('id', 'desc')->skip(0)->take(5)->get();
        foreach ($news_1 as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;
            $value['title'] = mb_substr($value['title'], 0, 25) . '...';
        }
        $data['news_gg'] = $news_1;

        // 人事招聘
        $job = Job::where('type', 0)->whereIn('status', $where_arr)->orderBy('release_time', 'desc')->orderBy('id', 'desc')->skip(0)->take(5)->get();
        foreach ($job as $key => $value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;
            $value['title'] = mb_substr($value['title'], 0, 25) . '...';
        }
        $data['job'] = $job;

        // 健康促进
        $patient_service = PatientService::where('type', 9)->whereIn('status', $where_arr)->orderBy('id', 'desc')->skip(0)->take(10)->get();
        $data['patient_service'] = $patient_service;

        // 一线党建
        $partys = Party::whereIn('status', $where_arr)->orderBy('id', 'desc')->skip(0)->take(10)->get()->toArray();
        $data['party']['data'] = $partys;
        $data['party']['is_more'] = 0;
        if (count($partys) >= 10) {
            $data['party']['is_more'] = 1;
        }

        // 疫情防控
        $epidemic_controls = EpidemicControl::whereIn('status', $where_arr)->orderBy('id', 'desc')->skip(0)->take(10)->get()->toArray();
        $data['epidemic_control']['data'] = $epidemic_controls;
        $data['epidemic_control']['is_more'] = 0;
        if (count($epidemic_controls) >= 10) {
            $data['epidemic_control']['is_more'] = 1;
        }

        return responder()->success($data);
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
        //
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
