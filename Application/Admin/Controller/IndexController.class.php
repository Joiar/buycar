<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends BaseController
{
    // 首页
    public function index()
    {
        $this->display();
    }

    public function welcome()
    {
        $this->display();
    }
}
