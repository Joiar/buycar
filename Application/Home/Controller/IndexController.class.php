<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    // 显示主页
    public function index()
    {
        $province = M('tree')->where ( array('pid'=>1) )->select();
        $this->assign('province',$province);
        $this->display();
    }

    public function getRegion(){
        $Region = M("tree");
        $map['pid'] = $_REQUEST["pid"];
        $map['type'] = $_REQUEST["type"];
        $list=$Region->where($map)->select();
        echo json_encode($list);
    }

    // 录入数据
    public function getOrderIn()
    {
        $input = I('post.form');
        if (!$input['code'] or !$input['username'] or !$input['mobile'] or !I('post.area1')) {
            $this->ajaxReturn([
                'status' => 0,
                'msg' => '请填写完整数据后提交'
            ]);
        }
        $verCode = $input['mobile'].'-'.$input['code'];
        $verCode = md5(md5($verCode));
        if ($verCode != session('verCode')) {
            $this->ajaxReturn([
                'status' => 0,
                'msg' => '短信验证码错误'
            ]);
        } else {
            $p = M('tree')->field('name')->where(array('id' => I('post.area1')))->find();
            $c = M('tree')->field('name')->where(array('id' => I('post.area2')))->find();
            $a = M('tree')->field('name')->where(array('id' => I('post.area3')))->find();
            $area = $p['name'].' '.$c['name'].' '.$a['name'];
            $formData['username'] = $input['username'];
            $formData['mobile'] = $input['mobile'];
            $formData['area'] = $area;
            $formData['addtime'] = time();
            $addRes = M('car_loan')->add($formData);
            if ($addRes) {
                $this->ajaxReturn([
                    'status' => 1,
                    'msg' => '添加成功'
                ]);
            } else {
                $this->ajaxReturn([
                    'status' => 0,
                    'msg' => '添加失败'
                ]);
            }
        }
    }

    // 发送短信
    public function sendSms()
    {
        if (I('post.phone')) {
            $phone = I('post.phone');
        } else {
            $this->ajaxReturn([
                'status' => 0,
                'msg' => '请输入手机号后再获取验证码'
            ]);
        }

        Vendor('Alidayu.TopSdk','','.php');
        $c = new \TopClient;
        $c->appkey = C('APPKEY');
        $c->secretKey = C('SECRET');
        $req = new \AlibabaAliqinFcSmsNumSendRequest;

        $code = rand(100000, 999999);
        $req->setExtend($code);
        $req->setSmsType("normal");

        $req->setSmsFreeSignName("云狄网络");
        $req->setSmsParam("{\"code\":\"$code\"}");
        $req->setRecNum($phone);
        $req->setSmsTemplateCode("SMS_103470065");
        $resp = $c->execute($req);
        if ($resp->result->success == true) {

            $verCode = $phone.'-'.$code;
            $verCode = md5(md5($verCode));
            session('verCode', $verCode);

            $this->ajaxReturn([
                'status' => 1,
                'msg' => '短信发送成功'
            ]);
        } else {
            if ($resp->sub_code == 'isv.BUSINESS_LIMIT_CONTROL') {
                $msg = '短信发送太频繁，请稍后再试';
            } else {
                $msg = $this->sub_msg;
            }

            $this->ajaxReturn([
                'status' => 0,
                'msg' => $msg
            ]);
        }
    }

}
