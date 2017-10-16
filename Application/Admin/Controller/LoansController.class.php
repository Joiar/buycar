<?php
namespace Admin\Controller;

use Think\Controller;

class LoansController extends BaseController
{

    public function exportData()
    {
        $startTime = I('get.start_time');
        $endTime = I('get.end_time');
        if ($startTime && $endTime) {
            $startTime = strtotime($startTime);
            $endTime = strtotime($endTime) + 86400;
            $arr = M('car_loan')->where('addtime >= '.$startTime.' and addtime <='.$endTime)->select();
        } else {
            $arr = M('car_loan')->select();
        }

        for ($i=0; $i < count($arr); $i++) {
            $arr[$i]['addtime'] = date('Y-m-d H:i:s', $arr[$i]['addtime']);
        }
        if (!$arr) {
            $this->error('数据为空');
            exit;

        }
        $filename = "汽车贷款申请记录";
        $headArr=array("ID", "姓名", "手机号", "地区", "申请时间");
        $this->getExcel($filename,$headArr, $arr);
    }


    private function getExcel($fileName,$headArr,$data){
        //对数据进行检验
        if(empty($data) || !is_array($data)){
            die("data must be a array");
        }
        // 检查文件名
        if(empty($fileName)){
            exit;
        }
        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        vendor('phpExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        // 设置表头
        $key = ord("A");
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }
        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        // 行写入
        foreach($data as $key => $rows){
            $span = ord("A");
            // 列写入
            foreach($rows as $keyName=>$value){
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }




    // 汽车端贷款管理
    public function pcList()
    {
        $res = M('car_loan')->select();
        $count = (count($res));
        for ($i=0; $i < count($res); $i++) {
            $res[$i]['addtime'] = date('Y-m-d H:i:s', $res[$i]['addtime']);
        }
        $this->assign('res', $res);
        $this->assign('count', $count);
        $this->display();
    }

    // 删除
    public function del()
    {
        if (IS_AJAX) {
            $id = I('post.id');
            $delRes = M('car_loan')->where(array('id' => $id))->delete();
            if ($delRes) {
                $this->ajaxReturn([
                    'status' => 1,
                    'msg' => '删除成功',
                    'data' => ''
                ]);
            } else {
                $this->ajaxReturn([
                    'status' => 0,
                    'msg' => '删除失败，请重试',
                    'data' => ''
                ]);
            }
        }
    }
}
