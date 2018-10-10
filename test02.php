<?php

//function run($str)
//{
//    $res='';
//    for($i=0;true;$i++)
//    {
//        if(!isset($str[$i]))
//        {
//            break;
//        }
//    }
//    $len=$i;
//    for($i=$len-1;$i>=0;$i--)
//    {
//        $res.=$str[$i];
//    }
//    return $res;
//}
//
//var_dump(run('abcdefg'));

$arr=[100,33,1,4,8,90,2,3,22];

function getMaopao($arr)
{
    $len=count($arr);
    for($i=0;$i<$len;$i++)
    {
        for($j=0;$j<$len-$i-1;$j++)
        {
            if($arr[$j]>$arr[$j+1])
            {
                $temp=$arr[$j+1];
                $arr[$j+1]=$arr[$j];
                $arr[$j]=$temp;
//                var_dump($arr);
            }
        }
    }
    return $arr;
}
//var_dump(getMaopao($arr));

function getSelect($arr)
{
    $len=count($arr);
    for($i=0;$i<$len-1;$i++)//无需比较最后一个
    {
        $p=$i;
        for($j=$i+1;$j<$len;$j++)
        {
            if($arr[$p]>$arr[$j])
            {
                $p=$j;
            }
        }
        if($p!=$i)
        {
            $temp=$arr[$p];
            $arr[$p]=$arr[$i];
            $arr[$i]=$temp;
        }
//        var_dump($arr);
    }
    return $arr;
}
//var_dump(getSelect($arr));
function getInsert($arr)
{
    for($i=1,$len=count($arr);$i<$len;$i++)
    {
        $temp=$arr[$i];//第二个索引开始 默认左半部分即第一个是已排序
        for($k=$i-1;$k>=0;$k--)
        {
            if($arr[$k]>$temp)
            {
                $arr[$k+1]=$arr[$k];
                $arr[$k]=$temp;
                var_dump($arr);
            }else{
                //左半部分是已排序的数组 所以和该元素-1位置比较如果大于 无需比较左侧其他更小数字；
                break;
            }
        }
    }
    return $arr;
}
//var_dump(getInsert($arr));

function getQuick($arr)
{
    $len=count($arr);
    if($len<=1){return $arr;}//!!!!!!!!!!!!!!

    $base_num=$arr[0];
    $left_array=[];
    $reight_array=[];

    for($i=1;$i<$len;$i++)
    {
        if($arr[$i]<$base_num)
        {
            $left_array[]=$arr[$i];
        }else{
            $reight_array[]=$arr[$i];
        }

    }
    $left_array=getQuick($left_array);
    $reight_array=getQuick($reight_array);

    return array_merge($left_array,array($base_num),$reight_array);
}
//var_dump(getQuick($arr));

function HuntFor($arr,$search)
{
    $low=0;
    $height=count($arr)-1;

    while($low<=$height)//注意循环
    {
        $mid=floor(($low+$height)/2);//注意位置
        if($arr[$mid]==$search)
        {
            return $mid;
        }else if($arr[$mid]<$search)
        {
            $low=$mid+1;
        }else if($arr[$mid]>$search)
        {
            $height=$mid-1;
        }
    }
    return 'No Data';
}