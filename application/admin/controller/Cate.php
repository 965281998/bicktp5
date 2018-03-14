<?php
namespace app\admin\controller;
use app\admin\controller\Common;
use app\admin\model\Cate as CateModel;
class cate extends Common
{
    public function lst()
    {
        $cate=new CateModel();
        $adminres=db('admin')->select();
        $this->assign('adminres',$adminres);
        return view();

    }

    public function add(){
        if(request()->isPost()){
            $cate=new CateModel();
            $cate->date(input('post.'));
            $add=$cate->save();

            if($add){
                $this->success('添加栏目成功！',url('lst'));
            }else{
                $this->error('添加栏目失败！');
            }
        }
        return view();
    }

    
}