<?php

namespace Count;

/**
 * Class dateCount
 * @author lishuo
 */
class dateCount
{
    private function getParam()
    {
        $param = getopt('s:e:');
        if (!$param) {
            exit('写个目标日期呗');
        }
        $param['end'] = $param['e'];
        $param['start'] = $param['s'] ? : date('Y-m-d');
        return $param;
    }

    public function getCount()
    {
        $param = $this->getParam();
        $end = strtotime($param['end']);
        $start = strtotime($param['start']);

        $count = ($end - $start) / 86400;
        $count = (int) $count;
        $param['count'] = $count;
        $this->formatDate($param);
    }

    private function formatDate($param)
    {
        $count = $param['count'];

        $yearFormat = $this->formatYear($count);

        if ($count > 0) {
            echo "距离到期日 {$param['end']} 还有 $yearFormat";
        } else if ($count < 0) {
            $count = -$count;
            echo "距离到期日 {$param['end']} 已过 $yearFormat";
        } else {
            echo "到期日 {$param['end']} 就是今天";
        }
    }

    private function formatYear($days)
    {
        $days = abs($days);
        if ($days < 0) {
            exit('错误的日期');
        }

        if ($days > 365) {
            $years = (int) ($days / 365);
            $days = $days % 365;
        } 
        if ($days > 31) {
            $month = (int) ($days / 31);
            $days = $days % 31;
        } 
        $res = '';
        $years && $res .= $years . '年';
        $month && $res .= $month . '个月';
        $res .= $days . '天';
        return $res;
    }
}

$DateCount = new dateCount();
$count = $DateCount->getCount();



