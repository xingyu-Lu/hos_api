<?php

namespace App\Http\Controllers\Api\Head;

use App\Http\Controllers\Controller;
use App\Models\Brief;
use App\Models\Culture;
use App\Models\History;
use App\Models\HistoryLeader;
use App\Models\HistoryPic;
use App\Models\Leader;
use App\Models\LeaderNew;
use App\Models\Organization;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BriefsController extends Controller
{
    /**
     * 医院简介
     * @return [type] [description]
     */
    public function yyjj()
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $brief = Brief::whereIn('status', $where_arr)->first();

        return responder()->success($brief);
    }

    /**
     * 领导团队
     * @return [type] [description]
     */
    public function ldtd()
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $leader = LeaderNew::whereIn('status', $where_arr)->first();

        // $leader = Leader::whereIn('status', $where_arr)->get()->toArray();

        // foreach ($leader as $key => &$value) {
        //     $file = UploadFile::find($value['file_id']);
        //     $url = '';
        //     if ($file) {
        //         $url = Storage::disk('public')->url($file['file_url']);
        //     }
        //     $value['img_url'] = $url;

        //     $value['position'] = explode(',', $value['position']);
        //     $value['professional'] = explode(',', $value['professional']);
        // }
        // unset($value);

        // $leader = array_chunk($leader, 6);

        return responder()->success($leader);
    }

    /**
     * 
     * 医院文化
     * @return [type] [description]
     */
    public function yywh()
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $culture = Culture::whereIn('status', $where_arr)->first();

        return responder()->success($culture);
    }

    /**
     * 历史沿革
     * @return [type] [description]
     */
    public function lsyg()
    {
        $data = [];
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $history = History::whereIn('status', $where_arr)->first();

        $history_leader = HistoryLeader::whereIn('status', $where_arr)->get()->toArray();

        foreach ($history_leader as $key => &$value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;
        }
        unset($value);
        $history_leader_img_arr = [];
        // foreach ($history_leader as $key => $value) {
        //     $history_leader_img_arr[$value['id']] = $value['img_url'];
        // }
        $history_leader_img_arr = array_column($history_leader, 'img_url');

        $history_leader = array_chunk($history_leader, 4);

        $history_pic = HistoryPic::whereIn('status', $where_arr)->get()->toArray();

        foreach ($history_pic as $key => &$value) {
            $file = UploadFile::find($value['file_id']);
            $url = '';
            if ($file) {
                $url = Storage::disk('public')->url($file['file_url']);
            }
            $value['img_url'] = $url;
        }
        unset($value);
        $history_pic_img_arr = [];
        // foreach ($history_pic as $key => $value) {
        //     $history_pic_img_arr[$value['id']] = $value['img_url'];
        // }
        $history_pic_img_arr = array_column($history_pic, 'img_url');

        $history_pic = array_chunk($history_pic, 4);

        $data['history'] = $history;
        $data['history_leader'] = $history_leader;
        $data['history_pic'] = $history_pic;

        $data['src_list'] = [
            'history_leader' => $history_leader_img_arr,
            'history_pic' => $history_pic_img_arr
        ];

        return responder()->success($data);
    }

    /**
     * 组织机构
     * @return [type] [description]
     */
    public function zzjg()
    {
        $where_arr = [];

        $user = auth('h-api')->user();
        if ($user) {
            $where_arr = [0, 1];    
        } else {
            $where_arr = [1];
        }

        $organization = Organization::whereIn('status', $where_arr)->first();

        return responder()->success($organization);
    }
}
