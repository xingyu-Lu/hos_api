<?php

namespace App\Console\Commands;

use App\Models\Brief;
use App\Models\Culture;
use App\Models\Expert;
use App\Models\History;
use App\Models\Job;
use App\Models\LeaderNew;
use App\Models\News;
use App\Models\Organization;
use App\Models\PatientService;
use App\Models\StaffArticle;
use App\Models\TechnicalOfficeColumn;
use App\Models\TechnicalOfficeDoctor;
use App\Models\TechnicalOfficeDynamic;
use App\Models\TechnicalOfficeIntroduce;
use App\Models\TechnicalOfficeOutpatientNew;
use Illuminate\Console\Command;

class FixDomainUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:domain-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Domain Url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $replace_arr = ['http://120.25.160.244:8001' => 'https://api.666120.cn'];
        // $replace_arr = ['https://api.666120.cn' => 'http://luxy.three_hospital_api.com'];


        // 员工文章
        $staff_articles = StaffArticle::get()->toArray();

        foreach ($staff_articles as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $staff_article = StaffArticle::find($value['id']);
            $staff_article->content = $content;
            $staff_article->save();
        }

        // 医院简介
        $briefs = Brief::get()->toArray();

        foreach ($briefs as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $brief = Brief::find($value['id']);
            $brief->content = $content;
            $brief->save();
        }

        // 领导团队新
        $leaderNews = LeaderNew::get()->toArray();
        foreach ($leaderNews as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $leaderNew = LeaderNew::find($value['id']);
            $leaderNew->content = $content;
            $leaderNew->save();
        }

        // 医院文化
        $cultures = Culture::get()->toArray();
        foreach ($cultures as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $culture = Culture::find($value['id']);
            $culture->content = $content;
            $culture->save();
        }

        // 历史沿革
        $historys = History::get()->toArray();
        foreach ($historys as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $history = History::find($value['id']);
            $history->content = $content;
            $history->save();
        }

        // 组织机构
        $organizations = Organization::get()->toArray();
        foreach ($organizations as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $organization = Organization::find($value['id']);
            $organization->content = $content;
            $organization->save();
        }

        // 新闻公告
        $news = News::get()->toArray();

        foreach ($news as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $new = News::find($value['id']);
            $new->content = $content;
            $new->save();
        }

        // 科室介绍
        $technical_office_introduces = TechnicalOfficeIntroduce::get()->toArray();
        foreach ($technical_office_introduces as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $technical_office_introduce = TechnicalOfficeIntroduce::find($value['id']);
            $technical_office_introduce->content = $content;
            $technical_office_introduce->save();
        }

        // 科室动态
        $technical_office_dynamics = TechnicalOfficeDynamic::get()->toArray();
        foreach ($technical_office_dynamics as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $technical_office_dynamic = TechnicalOfficeDynamic::find($value['id']);
            $technical_office_dynamic->content = $content;
            $technical_office_dynamic->save();
        }

        // 科室医生
        $technical_office_doctors = TechnicalOfficeDoctor::get()->toArray();
        foreach ($technical_office_doctors as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $technical_office_doctor = TechnicalOfficeDoctor::find($value['id']);
            $technical_office_doctor->content = $content;
            $technical_office_doctor->save();
        }

        // 科室门诊新
        $technical_office_outpatient_news = TechnicalOfficeOutpatientNew::get()->toArray();
        foreach ($technical_office_outpatient_news as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $technical_office_outpatient_new = TechnicalOfficeOutpatientNew::find($value['id']);
            $technical_office_outpatient_new->content = $content;
            $technical_office_outpatient_new->save();
        }

        // 科室栏目
        $technical_office_columns = TechnicalOfficeColumn::get()->toArray();
        foreach ($technical_office_columns as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $technical_office_column = TechnicalOfficeColumn::find($value['id']);
            $technical_office_column->content = $content;
            $technical_office_column->save();
        }

        // 专家介绍
        $experts = Expert::get()->toArray();
        foreach ($experts as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $expert = Expert::find($value['id']);
            $expert->content = $content;
            $expert->save();
        }

        // 患者服务
        $patientServices = PatientService::get()->toArray();
        foreach ($patientServices as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $patientService = PatientService::find($value['id']);
            $patientService->content = $content;
            $patientService->save();
        }

        // 招聘信息
        $jobs = Job::get()->toArray();
        foreach ($jobs as $key => $value) {
            $content = strtr($value['content'], $replace_arr);
            $job = Job::find($value['id']);
            $job->content = $content;
            $job->save();
        }

        return 0;
    }
}
