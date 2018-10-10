<?php
$arr = [100, 33, 1, 4, 22, 8, 90, 2, 3, 22];

function getMaopao($arr)
{
    for($i=0,$len=count($arr);$i<$len;$i++)
    {
        for($k=0;$k<$len-$i-1;$k++)
        {
            if($arr[$k+1]<$arr[$k])
            {
                $temp=$arr[$k+1];
                $arr[$k+1]=$arr[$k];
                $arr[$k]=$temp;
            }
        }
    }
    return $arr;
}

function getSelect($arr)
{
    for($i=0,$len=count($arr);$i<$len-1;$i++)
    {
        $p=$i;
        for($k=$i+1;$k<$len;$k++)
        {
            if($arr[$p]>$arr[$k])
            {
                $p=$k;
            }
        }
        if($p!=$i)
        {
            $temp=$arr[$p];
            $arr[$p]=$arr[$i];
            $arr[$i]=$temp;
        }
    }
    return $arr;
}

function getInsert($arr)
{
    for($i=1,$len=count($arr);$i<$len;$i++)
    {
        $temp=$arr[$i];
        for($k=$i-1;$k>=0;$k--)
        {
            if($arr[$k]>$temp)
            {
                $arr[$k+1]=$arr[$k];
                $arr[$k]=$temp;
            }else{
                break;
            }
        }
    }
    return $arr;
}

function getQuick($arr)
{
    $len=count($arr);
    if($len<=1)return $arr;
    $base_num=$arr[0];
    $left_array=array();
    $right_array=array();
    for($i=1;$i<$len;$i++)
    {
        if($arr[$i]<$base_num)
        {
            $left_array[]=$arr[$i];
        }else{
            $right_array[]=$arr[$i];
        }
    }

    $left_array=getQuick($left_array);
    $right_array=getQuick($right_array);

    return array_merge($left_array,array($base_num),$right_array);
}
