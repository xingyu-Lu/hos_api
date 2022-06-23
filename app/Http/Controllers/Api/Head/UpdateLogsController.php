<?php

namespace App\Http\Controllers\Api\Head;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            [
                'content' => '领导团队重构等等',
                'timestamp' => '2022-06-23',
            ],
            [
                'content' => '历任院长、历史照片图片加预览等等',
                'timestamp' => '2022-05-25',
            ],
            [
                'content' => '门诊信息改版，域名注册开始，备份数据库shell脚本等等',
                'timestamp' => '2022-05-05',
            ],
            [
                'content' => '水印图片优化等等',
                'timestamp' => '2022-05-05',
            ],
            [
                'content' => '图片上传大小限制1M，同步专家优化，日常维护审核，后台科室动态、介绍、栏目排序优化等等',
                'timestamp' => '2022-04-28',
            ],
            [
                'content' => '整站wangeditor编辑器行高1.6改为1.5，职称优化，主任副主任医师同步专家，健康科普类的文章可同步健康促进等等',
                'timestamp' => '2022-04-27',
            ],
            [
                'content' => '上传图片接口加水印，获取汉语字的拼音首字母等等',
                'timestamp' => '2022-04-26',
            ],
            [
                'content' => '前台获取科室详情bug修改等等',
                'timestamp' => '2022-04-25',
            ],
            [
                'content' => '整站文字标题字号颜色优化，门诊部门诊信息调整，科室栏目加排序等等',
                'timestamp' => '2022-04-24',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-22',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-21',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-20',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-19',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-18',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-17',
            ],
            [
                'content' => '各种优化修改完善，处理问题及答疑等等',
                'timestamp' => '2022-04-16',
            ],
            [
                'content' => '科室介绍，科室医生给科室开放，科室栏目设置加状态，部署三院服务器等等',
                'timestamp' => '2022-04-15',
            ],
            [
                'content' => '前台首页医院公告，人事招聘显示优化，升级element-plus，后台人才招聘，科研动态bug修复，后台优化等等',
                'timestamp' => '2022-04-09',
            ],
            [
                'content' => '前台手机模式调整去响应式，后台专家新增修改优化等等',
                'timestamp' => '2022-04-02',
            ],
            [
                'content' => '升级element-plus等等',
                'timestamp' => '2022-03-29',
            ],
            [
                'content' => '升级element-plus，添加后台测试数据，科室地址提示优化等等',
                'timestamp' => '2022-03-28',
            ],
            [
                'content' => '升级服务端PHP版本到8.1.4等等',
                'timestamp' => '2022-03-25',
            ],
            [
                'content' => '整站审核状态优化，前端上传文件优化，加宜宾市第三人民医院meta，科室动态自动同步院新闻，测试优化等等',
                'timestamp' => '2022-03-24',
            ],
            [
                'content' => '前台科室设置(科室介绍，科室动态，科室医生，科室门诊，栏目)优化等等',
                'timestamp' => '2022-03-23',
            ],
            [
                'content' => '前台科室设置(科室门诊，科室成员，栏目设置，科室栏目)等等',
                'timestamp' => '2022-03-22',
            ],
            [
                'content' => '前台科室设置(科室动态)等等',
                'timestamp' => '2022-03-21',
            ],
            [
                'content' => '开始改进思考，后台加科室栏目设置优化，前台科室设置开始等等',
                'timestamp' => '2022-03-18',
            ],
            [
                'content' => '后台加科室成员，科室栏目设置，科室栏目，升级element-plus等等',
                'timestamp' => '2022-03-17',
            ],
            [
                'content' => '科室模块改进思考，建表等等',
                'timestamp' => '2022-03-16',
            ],
            [
                'content' => '文件为空优化，首页head图修改，新闻模块加推荐、取消推荐，升级element-plus等等',
                'timestamp' => '2022-03-15',
            ],
            [
                'content' => 'element-plus升级，上传编辑图片优化等等',
                'timestamp' => '2022-03-14',
            ],
            [
                'content' => 'footer优化，专家详情页优化等等',
                'timestamp' => '2022-03-09',
            ],
            [
                'content' => '升级element-plus等等',
                'timestamp' => '2022-03-07',
            ],
            [
                'content' => 'ico优化，head图片制作替换等等',
                'timestamp' => '2022-03-03',
            ],
            [
                'content' => 'bug修复等等',
                'timestamp' => '2022-03-03',
            ],
            [
                'content' => '升级element-pus等等',
                'timestamp' => '2022-03-02',
            ],
            [
                'content' => '升级element-pus等等',
                'timestamp' => '2022-02-28',
            ],
            [
                'content' => '前台token有效性检测等等',
                'timestamp' => '2022-02-18',
            ],
            [
                'content' => '员工文件加下载等等',
                'timestamp' => '2022-02-17',
            ],
            [
                'content' => '后台优化等等',
                'timestamp' => '2022-02-16',
            ],
            [
                'content' => '升级element plus，后台编辑预览优化等等',
                'timestamp' => '2022-02-15',
            ],
            [
                'content' => '员工发文上传文件加限制，列表倒序，文章样式修改等等',
                'timestamp' => '2022-02-14',
            ],
            [
                'content' => '各个模块编辑后为待审核优化，代码优化，医院概况、新闻动态测试优化等等',
                'timestamp' => '2022-02-09',
            ],
            [
                'content' => '后台加员工文件管理，员工文件表加字段优化等等',
                'timestamp' => '2022-02-09',
            ],
            [
                'content' => '后台管理员功能测试，菜单优化，前端token失效清除优化，前台加我的云盘功能，升级element-plus等等',
                'timestamp' => '2022-02-07',
            ],
            [
                'content' => '员工管理，角色管理，权限管理，优化等等',
                'timestamp' => '2022-02-05',
            ],
            [
                'content' => '患者服务，党建之窗，人才招聘，员工之声，搜索等等',
                'timestamp' => '2022-02-04',
            ],
            [
                'content' => '医院概况，新闻动态，科室介绍，专家介绍，科研教学等等',
                'timestamp' => '2022-02-03',
            ],
            [
                'content' => '注册登录，邮箱验证码登录，医院简介，领导团队',
                'timestamp' => '2022-02-02',
            ],
            [
                'content' => '前端开始对接接口，首页对接等等',
                'timestamp' => '2022-02-01',
            ],
            [
                'content' => '专家介绍，科研动态，患者服务，党建之窗，人才招聘，员工之声，优化等等',
                'timestamp' => '2022-01-31',
            ],
            [
                'content' => '科室设置（科室门诊，科室特色医疗，科室图片，科室健康科普），加搜索等等',
                'timestamp' => '2022-01-30',
            ],
            [
                'content' => '科室设置（科室动态，科室医生），科室门诊思考建表等等',
                'timestamp' => '2022-01-29',
            ],
            [
                'content' => '新闻动态加附件功能，上传文件记录文件大小兆，科室设置（科室列表，科室介绍）等等',
                'timestamp' => '2022-01-28',
            ],
            [
                'content' => '了解所需阿里云服务器，新闻动态（医院新闻、医院公告、视频新闻）',
                'timestamp' => '2022-01-27',
            ],
            [
                'content' => '领导团队，医院文化，历史沿革，历任院长，历史照片，组织机构，开发中问题解决处理',
                'timestamp' => '2022-01-26',
            ],
            [
                'content' => '菜单管理完善，首页轮播图，修改密码，退出登录，医院简介',
                'timestamp' => '2022-01-25',
            ],
            [
                'content' => '部署我服务器，后台管理员管理模块，菜单管理部分',
                'timestamp' => '2022-01-24',
            ],
            [
                'content' => '前后端登录jwt、基础处理等等',
                'timestamp' => '2022-01-23',
            ],
            [
                'content' => '服务器问题：docker-compose和MySQL导致内存溢出解决，后端接口仓库搭，后台部署自己服务器',
                'timestamp' => '2022-01-21',
            ],
            [
                'content' => '前端fix，后台前端建代码仓库、前端框架搭建，一些问题优化',
                'timestamp' => '2022-01-20',
            ],
            [
                'content' => '前端架构思考，前端首页修改，生产医院ico，图片存储本地，图片待ps操作，轮播图图片待后端接口',
                'timestamp' => '2022-01-19',
            ],
        ];

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
