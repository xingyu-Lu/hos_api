<?php

namespace App\Http\Controllers\Api\Back;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
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

        $where[] = ['type', '=', $params['type']];

        if ($params['title']) {
            $where[] = ['title', 'like', '%' . $params['title'] . '%'];
        }

        $news = News::where($where)->orderBy('is_recommend', 'desc')->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(10);

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

        if ($params['attachment']) {
            $params['attachment_id'] = $params['attachment'];
        }

        unset($params['img'], $params['attachment']);

        $params['release_time'] = strtotime($params['release_time']);

        News::create($params);

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
        $news = News::find($id);

        $attachment_ids = explode(',', $news['attachment_id']);
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

        $news->attachment = $attachment;

        $file = UploadFile::find($news['file_id']);

        $url = '';

        if ($file) {
            $url = Storage::disk('public')->url($file['file_url']);
        }

        $news->url = $url;

        return responder()->success($news);
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
        } else {
            $params['file_id'] = 0;
        }

        if ($params['attachment']) {
            $params['attachment_id'] = $params['attachment'];
        }

        unset($params['img'], $params['attachment']);

        $params['release_time'] = strtotime($params['release_time']);
        $params['status'] = 0;

        News::updateOrCreate(['id' => $id], $params);

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

        News::updateOrCreate(['id' => $id], ['status' => $status]);

        return responder()->success();
    }

    public function recommend(Request $request)
    {
        $params = $request->all();

        $update_data = [
            'is_recommend' => $params['is_recommend'],
        ];

        foreach ($params['multipleSelection'] as $key => $value) {
            News::updateOrCreate(['id' => $value['id']], $update_data);
        }

        return responder()->success();
    }
}
