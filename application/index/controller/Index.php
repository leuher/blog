<?php
namespace app\index\controller;

use think\Controller;

class Index extends  Controller
{
    //网站首页
    public function index()
    {
        return $this->fetch();
    }
}
