<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Common; 
class Admin extends Common
{
    public function lst()
    {
        $admin=new AdminModel();
        $adminres=$admin->getadmin();
        $this->assign('adminres',$adminres);
        return view();

    }

    public function add()
    {
        if(request()->isPost()){
            // $res=db('admin')->insert(input('post.'));
            $admin=new AdminModel();
            if($admin->addadmin(input('post.'))){
                $this->success('添加管理员成功！',url('lst'));
            }else{
                $this->error('添加管理员失败！');
            }
            return;
        }
        return view();

    }

    public function edit($id)
    {
        $admins=db('admin')->find($id);

        if(request()->isPost()){
            $data=input('post.');
            $admin=new AdminModel();
            $savenum=$admin->saveadmin($data,$admins);
            if( $savenum == '2'){
                $this->error('管理员用户名不得为空！');
            }
            if($admin->saveadmin($data,$admins) !== false){
                $this->success('修改成功！',url('lst'));
            }else{
                $this->error('修改失败！');
            }
            return;
        }

        
        if(!$admins){
            $this->error('该管理员不存在！');
        }
        $this->assign('admin',$admins);
        return view();

    }

    public function del($id){
        $admin=new AdminModel();
        $delnum=$admin->deladmin($id);
        if($delnum == 1){
            $this->success('删除管理员成功！',url('lst'));
        }else{
            $this->error('删除管理员失败！');
        }
    }
}
