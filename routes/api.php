<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api\Back')->prefix('back')->group(function () {
    // 获取 token
    Route::post('authorizations', 'AuthorizationsController@store')->name('login');

    // 需要 token 验证的接口
    Route::middleware(['auth:api', 'permission'])->name('api.back.')->group(function () {

        // 角色管理
        Route::apiResource('roles', 'RolesController');

        //save路由api新增权限
        Route::post('permissions/saveApiPermission', 'PermissionsController@saveApiPermission')->name('permissions.saveApiPermission');
        Route::apiResource('permissions', 'PermissionsController');

        // 登录用户信息
        Route::get('admins/info', 'AdminsController@info')->name('admins.info');

        // 管理员
        Route::put('admins/changepwd', 'AdminsController@changepwd')->name('admins.changepwd');
        Route::put('admins/status', 'AdminsController@status')->name('admins.status');
        Route::apiResource('admins', 'AdminsController');

        // 菜单
        Route::put('menus/status', 'MenusController@status')->name('menus.status');
        Route::get('menus/list', 'MenusController@list')->name('menus.list');
        Route::apiResource('menus', 'MenusController');

        // 轮播图
        Route::put('rotates/status', 'RotatesController@status')->name('rotates.status');
        Route::get('rotates/srclist', 'RotatesController@srclist')->name('rotates.srclist');
        Route::apiResource('rotates', 'RotatesController');

        // 医院简介
        Route::put('briefs/status', 'BriefsController@status')->name('briefs.status');
        Route::apiResource('briefs', 'BriefsController');

        // 领导团队
        Route::put('leaderNews/status', 'LeaderNewsController@status')->name('leaderNews.status');
        Route::apiResource('leaderNews', 'LeaderNewsController');

        Route::put('leaders/status', 'LeadersController@status')->name('leaders.status');
        Route::get('leaders/srclist', 'LeadersController@srclist')->name('leaders.srclist');
        Route::apiResource('leaders', 'LeadersController');

        // 医院文化
        Route::put('cultures/status', 'CulturesController@status')->name('cultures.status');
        Route::apiResource('cultures', 'CulturesController');

        // 历史沿革
        Route::put('historys/status', 'HistorysController@status')->name('historys.status');
        Route::apiResource('historys', 'HistorysController');

        // 历任院长
        Route::put('historyLeaders/status', 'HistoryLeadersController@status')->name('historyLeaders.status');
        Route::get('historyLeaders/srclist', 'HistoryLeadersController@srclist')->name('historyLeaders.srclist');
        Route::apiResource('historyLeaders', 'HistoryLeadersController');

        // 历任院长
        Route::put('historyPics/status', 'HistoryPicsController@status')->name('historyPics.status');
        Route::get('historyPics/srclist', 'HistoryPicsController@srclist')->name('historyPics.srclist');
        Route::apiResource('historyPics', 'HistoryPicsController');

        // 组织机构
        Route::put('organizations/status', 'OrganizationsController@status')->name('organizations.status');
        Route::apiResource('organizations', 'OrganizationsController');

        // 医院新闻
        Route::put('news/recommend', 'NewsController@recommend')->name('news.recommend');
        Route::put('news/status', 'NewsController@status')->name('news.status');
        Route::apiResource('news', 'NewsController');

        // 科室列表
        Route::put('technicalOffices/status', 'TechnicalOfficesController@status')->name('technicalOffices.status');
        Route::apiResource('technicalOffices', 'TechnicalOfficesController');

        // 科室成员
        Route::apiResource('technicalOfficeMembers', 'TechnicalOfficeMembersController');

        // 科室栏目设置
        Route::put('technicalOfficeColumnSets/status', 'TechnicalOfficeColumnSetsController@status')->name('technicalOfficeColumnSets.status'); 
        Route::get('technicalOfficeColumnSets/list', 'TechnicalOfficeColumnSetsController@list')->name('technicalOfficeColumnSets.list'); 
        Route::apiResource('technicalOfficeColumnSets', 'TechnicalOfficeColumnSetsController'); 

        // 科室栏目
        Route::put('technicalOfficeColumns/healthPromotion', 'TechnicalOfficeColumnsController@healthPromotion')->name('technicalOfficeColumns.healthPromotion');
        Route::put('technicalOfficeColumns/status', 'TechnicalOfficeColumnsController@status')->name('technicalOfficeColumns.status');
        Route::apiResource('technicalOfficeColumns', 'TechnicalOfficeColumnsController');        

        // 科室介绍
        Route::put('technicalOfficeIntroduces/status', 'TechnicalOfficeIntroduceController@status')->name('technicalOfficeIntroduces.status');
        Route::apiResource('technicalOfficeIntroduces', 'TechnicalOfficeIntroduceController');

        // 科室动态
        Route::put('technicalOfficeDynamics/status', 'TechnicalOfficeDynamicsController@status')->name('technicalOfficeDynamics.status');
        Route::apiResource('technicalOfficeDynamics', 'TechnicalOfficeDynamicsController'); 

        // 科室医生
        Route::put('technicalOfficeDoctors/synExpert', 'TechnicalOfficeDoctorsController@synExpert')->name('technicalOfficeDoctors.synExpert');
        Route::put('technicalOfficeDoctors/status', 'TechnicalOfficeDoctorsController@status')->name('technicalOfficeDoctors.status');
        Route::apiResource('technicalOfficeDoctors', 'TechnicalOfficeDoctorsController');

        // 科室门诊
        Route::put('technicalOfficeOutpatients/status', 'TechnicalOfficeOutpatientsController@status')->name('technicalOfficeOutpatients.status');
        Route::apiResource('technicalOfficeOutpatients', 'TechnicalOfficeOutpatientsController');

        // 科室门诊新
        Route::put('technicalOfficeOutpatientNews/status', 'TechnicalOfficeOutpatientNewsController@status')->name('technicalOfficeOutpatientNews.status');
        Route::apiResource('technicalOfficeOutpatientNews', 'TechnicalOfficeOutpatientNewsController');        

        // 科室特色医疗
        Route::put('technicalOfficeFeatures/status', 'TechnicalOfficeFeaturesController@status')->name('technicalOfficeFeatures.status');
        Route::apiResource('technicalOfficeFeatures', 'TechnicalOfficeFeaturesController');

        // 科室图片
        Route::put('technicalOfficePics/status', 'TechnicalOfficePicsController@status')->name('technicalOfficePics.status');
        Route::apiResource('technicalOfficePics', 'TechnicalOfficePicsController');

        // 科室健康科普
        Route::put('technicalOfficeHealthSciences/status', 'TechnicalOfficeHealthSciencesController@status')->name('technicalOfficeHealthSciences.status');
        Route::apiResource('technicalOfficeHealthSciences', 'TechnicalOfficeHealthSciencesController');

        // 专家介绍
        Route::put('experts/status', 'ExpertsController@status')->name('experts.status');
        Route::apiResource('experts', 'ExpertsController');

        // 科研动态
        Route::put('scientifics/status', 'ScientificsController@status')->name('scientifics.status');
        Route::apiResource('scientifics', 'ScientificsController');

        // 患者服务
        Route::put('patientServices/status', 'PatientServicesController@status')->name('patientServices.status');
        Route::apiResource('patientServices', 'PatientServicesController');

        // 党建
        Route::put('partys/status', 'PartysController@status')->name('partys.status');
        Route::apiResource('partys', 'PartysController');

        // 招聘
        Route::put('jobs/status', 'JobsController@status')->name('jobs.status');
        Route::apiResource('jobs', 'JobsController');

        // 员工之声
        Route::put('voiceEmployees/status', 'VoiceEmployeesController@status')->name('voiceEmployees.status');
        Route::apiResource('voiceEmployees', 'VoiceEmployeesController');

        // 员工管理
        Route::put('staffs/status', 'StaffsController@status')->name('staffs.status');
        Route::get('staffs/list', 'StaffsController@list')->name('staffs.list');
        Route::apiResource('staffs', 'StaffsController');

        // 员工文件
        Route::put('fileEmployees/status', 'FileEmployeesController@status')->name('fileEmployees.status');
        Route::apiResource('fileEmployees', 'FileEmployeesController');        

        // 疫情防控
        Route::put('epidemicControls/status', 'EpidemicControlsController@status')->name('epidemicControls.status');
        Route::apiResource('epidemicControls', 'EpidemicControlsController');

        //文件下载
        Route::get('files/down', 'FilesController@down')->name('files.down');
        //文件上传
        Route::post('files/upload', 'FilesController@upload')->name('files.upload');
        //文件上传(多)
        Route::post('files/uploads', 'FilesController@uploads')->name('files.uploads');

    });
});


Route::namespace('Api\Head')->prefix('head')->group(function () {
    // 获取 token
    Route::post('authorizations', 'AuthorizationsController@store')->name('login');
    
    // 轮播图
    Route::name('api.head.')->group(function () {
        Route::get('indexs', 'IndexsController@index')->name('indexs.index');
        // 注册
        Route::get('registers/code', 'RegistersController@code')->name('registers.code');
        Route::apiResource('registers', 'RegistersController');

        // 医院简介
        Route::get('briefs/yyjj', 'BriefsController@yyjj')->name('briefs.yyjj');
        // 领导团队
        Route::get('briefs/ldtd', 'BriefsController@ldtd')->name('briefs.ldtd');
        // 医院文化
        Route::get('briefs/yywh', 'BriefsController@yywh')->name('briefs.yywh');
        // 历史沿革
        Route::get('briefs/lsyg', 'BriefsController@lsyg')->name('briefs.lsyg');
        // 组织机构
        Route::get('briefs/zzjg', 'BriefsController@zzjg')->name('briefs.zzjg');

        // 医院新闻
        Route::get('news/yyxw', 'NewsController@yyxw')->name('news.yyxw');
        // 医院新闻详情
        Route::get('news/yyxw_detail', 'NewsController@yyxw_detail')->name('news.yyxw_detail');

        // 科室列表
        Route::get('offices/list', 'TechnicalOfficesController@list')->name('offices.list');
        // 科室详情
        Route::get('offices/info', 'TechnicalOfficesController@info')->name('offices.info');
        // 科室介绍列表
        Route::get('offices/kejs', 'TechnicalOfficesController@kejs')->name('offices.kejs');
        // 科室介绍详情
        Route::get('offices/ksjs_detail', 'TechnicalOfficesController@ksjs_detail')->name('offices.ksjs_detail');
        // 科室动态
        Route::get('offices/ksdt', 'TechnicalOfficesController@ksdt')->name('offices.ksdt');
        // 科室动态详情
        Route::get('offices/ksdt_detail', 'TechnicalOfficesController@ksdt_detail')->name('offices.ksdt_detail');
        // 科室医生
        Route::get('offices/ksys', 'TechnicalOfficesController@ksys')->name('offices.ksys');
        // 科室医生详情
        Route::get('offices/ksys_detail', 'TechnicalOfficesController@ksys_detail')->name('offices.ksys_detail');
        // 科室门诊
        Route::get('offices/ksmz', 'TechnicalOfficesController@ksmz')->name('offices.ksmz');
        // 科室特色医疗
        Route::get('offices/tsyl', 'TechnicalOfficesController@tsyl')->name('offices.tsyl');
        // 科室特色医疗详情
        Route::get('offices/tsyl_detail', 'TechnicalOfficesController@tsyl_detail')->name('offices.tsyl_detail');
        // 科室图片
        Route::get('offices/kstp', 'TechnicalOfficesController@kstp')->name('offices.kstp');
        // 科室健康科普
        Route::get('offices/jkkp', 'TechnicalOfficesController@jkkp')->name('offices.jkkp');
        // 科室健康科普详情
        Route::get('offices/jkkp_detail', 'TechnicalOfficesController@jkkp_detail')->name('offices.jkkp_detail');
        // 科室栏目
        Route::apiResource('offices/column', 'TechnicalOfficeHeadColumnsController');

        // 科室设置
        Route::apiResource('technicalOfficeSets', 'TechnicalOfficeSetsController');

        // 科室栏目设置
        Route::get('technicalOfficeColumnSets/list', 'TechnicalOfficeColumnSetsController@list')->name('technicalOfficeColumnSets.list'); 
        Route::get('technicalOfficeColumnSets/column_list', 'TechnicalOfficeColumnSetsController@column_list')->name('technicalOfficeColumnSets.column_list'); 
        Route::apiResource('technicalOfficeColumnSets', 'TechnicalOfficeColumnSetsController');
        // 科室动态管理
        Route::apiResource('technicalOfficeDynamics', 'TechnicalOfficeDynamicsController');
        // 科室门诊管理
        Route::apiResource('technicalOfficeOutpatients', 'TechnicalOfficeOutpatientsController');
        // 科室成员管理
        Route::apiResource('technicalOfficeMembers', 'TechnicalOfficeMembersController');
        // 科室栏目管理
        Route::apiResource('technicalOfficeColumns', 'TechnicalOfficeColumnsController');
        // 科室介绍管理
        Route::apiResource('technicalOfficeIntroduce', 'TechnicalOfficeIntroduceController');
        // 科室医生管理
        Route::apiResource('technicalOfficeDoctors', 'TechnicalOfficeDoctorsController');

        // 专家介绍
        Route::get('experts/index', 'ExpertsController@index')->name('experts.index');
        // 专家介绍详情
        Route::get('experts/show', 'ExpertsController@show')->name('experts.show');

        // 科研教学
        Route::get('scientifics/index', 'ScientificsController@index')->name('scientifics.index');
        // 科研教学详情
        Route::get('scientifics/show', 'ScientificsController@show')->name('scientifics.show');

        // 患者服务
        Route::get('patientservices/mzlc', 'PatientServicesController@mzlc')->name('patientservices.mzlc');
        // 患者服务详情
        Route::get('patientservices/show', 'PatientServicesController@show')->name('patientservices.show');

        // 党建之窗
        Route::get('partys/index', 'PartysController@index')->name('partys.index');
        // 党建之窗详情
        Route::get('partys/show', 'PartysController@show')->name('partys.show');

        // 招聘信息
        Route::get('jobs/index', 'JobsController@index')->name('jobs.index');
        // 招聘信息详情
        Route::get('jobs/show', 'JobsController@show')->name('jobs.show');

        // 员工之声
        Route::get('staffs/staff_list', 'StaffsController@staff_list')->name('staffs.staff_list');
        Route::get('staffs/info', 'StaffsController@info')->name('staffs.info');
        Route::get('staffs/list', 'StaffsController@list')->name('staffs.list');
        Route::put('staffs/status', 'StaffsController@status')->name('staffs.status');
        Route::put('staffs/change_pwd', 'StaffsController@change_pwd')->name('staffs.change_pwd');

        Route::get('staffs/file_list', 'StaffsController@file_list')->name('staffs.file_list');
        Route::post('staffs/updload_file', 'StaffsController@updload_file')->name('staffs.updload_file');
        Route::put('staffs/file_delete', 'StaffsController@file_delete')->name('staffs.file_delete');

        Route::apiResource('staffs', 'StaffsController');

        // 搜索
        Route::get('searchs/index', 'SearchsController@index')->name('searchs.index');

        // 疫情防控
        Route::apiResource('epidemicControls', 'EpidemicControlsController');        

        // 更新
        Route::get('updatelogs/index', 'UpdateLogsController@index')->name('updatelogs.index');

        //文件下载
        Route::get('files/down', 'FilesController@down')->name('files.down');
        //文件上传
        Route::post('files/upload', 'FilesController@upload')->name('files.upload');
        //文件上传(多)
        Route::post('files/uploads', 'FilesController@uploads')->name('files.uploads');
    });

    // 需要 token 验证的接口
    // Route::middleware(['auth:api'])->name('api.head.')->group(function () {
    //     // 登录用户信息
    //     Route::get('admins/info', 'AdminsController@info')->name('admins.info');
    // });
});
