<?php

namespace app\admin\controller;

use think\Controller;

class Category extends Controller
{
    protected $db;

    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new \app\common\model\Category();
    }

    //栏目管理
    public function index(){
        $category_list = db('category')->select();
//        halt($category_list);
        $this->assign('category_list',$category_list);
        return $this->fetch();
    }

    //添加栏目
    public function store()
    {
        if(request()->isPost()){
             $res = $this->db->store(input('post.'));
             if($res['valid']!=0){
                 $this->success($res['msg'],'index');
             }else{
                 $this->error($res['msg']);
             }
        }else{
            return $this->fetch();
        }
    }

    //添加子栏目
    public function addSon()
    {
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            if($res['valid']!=0){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }else {
            //pathinfo模式下获取get参数使用的是param方式
            $cate_id = input('param.cate_id');
            $data = db('category')->where('n_id', $cate_id)->find();
            $this->assign('data', $data);
            return $this->fetch('addSon');
        }
    }
}
