<?php
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller
{
    public function login()
    {
        if (IS_AJAX) {;
            $checkVcode = $this->check_verify(I('post.vcode'));
            if ($checkVcode) {
                if (I('post.username') && I('post.password')) {
                    $password = md5(md5(I('post.password')));

                    $info = M('admin')->where(['username' => I('post.username'), 'password' => $password])->find();
                    if ($info) {
                        session('AdminInfo', $info);
                        $this->ajaxReturn([
                            'status' => 1,
                            'msg' => '登录成功',
                            'data' => ''
                        ]);
                    } else {
                        $this->ajaxReturn([
                            'status' => 0,
                            'msg' => '账号信息有误，请重试',
                            'data' => ''
                        ]);
                    }
                } else {
                    $this->ajaxReturn([
                        'status' => 0,
                        'msg' => '请填写账号与密码后再登录',
                        'data' => ''
                    ]);
                }

            } else {
                $this->ajaxReturn([
                    'status' => 0,
                    'msg' => '验证码有误',
                    'data' => ''
                ]);
            }
        } else {
            $this->display();
        }
    }

    public function loginOut()
    {
        session('AdminInfo', null);
        $this->redirect('login');
    }

    // 生成验证码
    public function makeCode()
    {
        $config =    array(
            'fontSize'    =>    16,
            'length'      =>    4,
            'useNoise'    =>    false,
            'useCurve'    =>    false,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    // 判断验证码是否正确
    function check_verify($code)
    {
        $verify = new \Think\Verify();
        if ($verify->check($code)) {
            return true;
        } else {
            return false;
        }
    }
}
