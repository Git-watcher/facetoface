<?php
/**
 * Created by PhpStorm.
 * User: theSvwatchers
 * Date: 2018/9/12
 * Time: 18:58
 */
//斐波那契数列
function jump($n)
{
    if ($n <= 0) return 0;
    if ($n == 1) return 1;
    if ($n == 2) return 2;
    return jump($n - 1) + jump($n - 2);
}

//var_dump(jump(3));
//斐波那契数列 循环
function jumpFloor($n) {
    $target = 0;
    $number1 = 1;
    $number2 = 2;
    if ($n <= 0) return 0;
    if ($n == 1) return 1;
    if ($n == 2) return 2;
    for ( $i = 3;$i <= $n;++$i) {
        $target = $number1 + $number2;
        $number1 = $number2;
        $number2 = $target;
    }
    return $target;
}
//var_dump(jumpFloor(3));

//递归阶乘
function run($a){
    if($a==0){
        return 1;
    }else{
        return $a*run($a-1);
    }
}
//var_dump(run(4));

//循环阶乘
function loop($a){
    $c=1;
    for($i=1; $i<=$a;$i++)
    {
        $c=$c*$i;
    }
    return $c;
}
//var_dump(loop(10));

//递归回文
function huiwen(int $n)
{
    echo $n.'<br/>';
    if($n>1)
    {
        huiwen($n-1);
    }
    echo $n;
}
huiwen(5);

function run($str,$n)
{
    return $n>1 ? $str.run($str,$n-1):$str;
}

//var_dump(run('abc',5)) ;

function jiecheng($n)
{
    return $n>1? $n*=jiecheng($n-1):$n;
}

//var_dump(jiecheng(10));
