<?php

namespace app\admin\controller;

use think\Controller;

class Link extends Controller
{
    private $db;

    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new \app\common\model\Link();
    }

    //友链首页
    public function index()
    {
        $link_list = $this->db->getAll();
        $this->assign('link_list',$link_list);
        return $this->fetch();
    }
    //添加友链
    public function store()
    {
        $id = input('param.n_id');
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            if($res['valid']==1){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }else{
            if($id){
                //取出旧数据：
                $old_data = $this->db->find($id);
                $this->assign('old_data',$old_data);
            }else{
                $this->assign('old_data',['v_title'=>'','v_link'=>'','n_sort'=>100]);
            }
            return $this->fetch();
        }
    }
    //删除友链：
    public function del()
    {
        $id = input('get.id');
        $res = \app\common\model\Link::destroy($id);
        if($res){
            $this->success('友链删除成功','index');
        }else{
            $this->error('友链删除失败');
        }
    }
}
