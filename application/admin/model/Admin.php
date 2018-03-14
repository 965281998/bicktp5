<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
   public function addadmin($data){
        if(empty($data) || !is_array($data)){
            return false;
        }
        if($data['password']){
            $data['password']=md5($data['password']);
        }
        if($this->save($data)){
            return true;
        }else{
            return false;
        }

   }

   public function getadmin(){
    return $this::order('id asc')->paginate(5);
    // return $this::getByName(111);
    //return $this::where('id',1)->value('name');
   }

   public function saveadmin($data,$admins){
      if(!$data['name']){
          return 2;  //管理员用户名为空
      }
      if(!$data['password']){
          $data['password']=$admins['password'];
      }else{
          $data['password']=md5($data['password']);
      }
      // $res=db('admin')->update($data);
      
      return $this::update(['name'=>$data['name'],'password'=>$data['password']],['id'=>$data['id']]);
   }

   public function deladmin($id){
      if($this::destroy($id)){
        return 1;
      }else{
        return 2;
      }
   }

   public function login($data){
      $admin=Admin::getByName($data['name']);
      if($admin){
          if($admin['password']==md5($data['password'])){
            return 2; //登陆信息正确的情况
          }else{
            return 3; //登陆信息错误的情况
          }
      }else{
          return 1;    //用户不存在的情况
      }
   }

}
