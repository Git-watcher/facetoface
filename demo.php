<?php
function run($str,$n)
{
    return $n>1 ? $str.run($str,$n-1):$str;
}

var_dump(run('abc',5)) ;

function jiecheng($n)
{
    return $n>1? $n*jiecheng($n-1):$n;
}

var_dump(jiecheng(10));

var_dump(strtotime('2018'));


