<?php

namespace App\Http\Controllers\Api\Head;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Models\FileEmployee;
use App\Models\Staff;
use App\Models\UploadFile;
use App\Models\VoiceEmployee;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    public function list(Request $request)
    {
        $params = $request->all();

        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $voice = VoiceEmployee::whereIn('status', $where_arr)->paginate(10);

        return responder()->success($voice);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $where = [];
        if ($params['title']) {
            $where[] = [
                'title', 'like', '%' . $params['title'] . '%'
            ];
        }

        $voice = VoiceEmployee::whereIn('status', [0, 1])->where($where)->where('staff_id', $user['id'])->paginate(10);

        return responder()->success($voice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        $params['release_time'] = strtotime($params['release_time']);

        $params['staff_id'] = $user['id'];

        $params['staff_name'] = $user['name'];

        VoiceEmployee::create($params);

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
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $voice = VoiceEmployee::whereIn('status', [0,1])->where('id', $id)->first();

        $voice->num += 1;

        $voice->save();

        return responder()->success($voice);
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
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        unset($params['release_time']);

        VoiceEmployee::updateOrCreate(['id' => $id], $params);

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
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        $id = $params['id'];
        $status = $params['status'];

        VoiceEmployee::updateOrCreate(['id' => $id], ['status' => $status]);

        return responder()->success();
    }

    public function change_pwd(Request $request)
    {   
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        $password = md5($params['password']);

        Staff::updateOrCreate(['id' => $user['id']], ['password' => $password]);

        return responder()->success();
    }

    public function updload_file(Request $request)
    {
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        $attachment = explode(',', $params['attachment']);

        foreach ($attachment as $key => $value) {
            $file = UploadFile::find($value);

            $insert_data = [
                'file_id' => $value,
                'file_name' => $file['file_name'],
                'staff_id' => $user['id'],
            ];
            
            FileEmployee::create($insert_data);
        }

        return responder()->success();
    }

    public function file_list(Request $request)
    {
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        $where = [];
        if ($params['file_name']) {
            $where[] = [
                'file_name', 'like', '%' . $params['file_name'] . '%'
            ];
        }

        $file = FileEmployee::with('files')->where('status', 1)->where($where)->where('staff_id', $user['id'])->paginate(10);

        return responder()->success($file);
    }

    public function file_delete(Request $request)
    {
        $user = auth('h-api')->user();

        if (!$user) {
            throw new BaseException(['msg' => '未登录', 'status' => '401']);
        }

        $params = $request->all();

        $id = $params['id'];
        $status = $params['status'];

        FileEmployee::updateOrCreate(['id' => $id], ['status' => $status]);

        return responder()->success();
    }
}