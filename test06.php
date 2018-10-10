<?php
$arr = [100, 33, 1, 4, 22, 8, 90, 2, 3, 22];

function getMaopao($arr)
{
    for ($i = 0, $len = count($arr); $i < $len; $i++) {
        for ($k = 0; $k < $len - $i - 1; $k++) {
            if ($arr[$k + 1] < $arr[$k])//!!! 注意大小
            {
                $temp = $arr[$k + 1];
                $arr[$k + 1] = $arr[$k];
                $arr[$k] = $temp;
            }
        }
    }
    return $arr;
}

function getSelect($arr)
{
    for ($i = 0, $len = count($arr); $i < $len - 1; $i++)//无需比较最后一个元素
    {
        $p = $i;
        for ($k = $i + 1; $k < $len; $k++) {
            if ($arr[$p] > $arr[$k]) {
                $p = $k;
            }
        }
        if ($p != $i) {
            $temp = $arr[$p];
            $arr[$p] = $arr[$i];
            $arr[$i] = $temp;
        }
    }
    return $arr;
}

function getInsert($arr)
{
    for ($i = 1, $len = count($arr); $i < $len; $i++) {
        $temp = $arr[$i];// 初始为 第二个元素
        for ($k = $i - 1; $k >= 0; $k--) {
            if ($arr[$k] > $temp) {
                $arr[$k + 1] = $arr[$k];
                $arr[$k] = $temp;
            } else {
                break;
            }
        }
    }
    return $arr;
}

function getQuick($arr)
{
    $len = count($arr);
    if ($len <= 1) return $arr; //注意return
    $base_num = $arr[0];
    $left_array = array();
    $right_array = array();
    for ($i = 1; $i < $len; $i++) {
        if ($arr[$i] < $base_num) {
            $left_array[] = $arr[$i];
        } else {
            $right_array[] = $arr[$i];
        }
    }
    $left_array = getQuick($left_array);
    $right_array = getQuick($right_array);
    return array_merge($left_array, array($base_num), $right_array);
}

function getDir($dir)
{
    $handle = opendir($arr);
    while (($file = readdir($handle)) !== false) {
        if ($file == '.' || $file == '..') continue;
        echo $file;
        $path = $dir . '.' . $file;
        if (is_dir($path)) getDir($path);
    }
}

for ($i = 0; true; $i++) {
    if (!isset($str[$i])) break;
}

function rmdirs($dir)
{
    $handle = opendir($dir);
    while (($file = readdir($handle)) !== false) {
        if ($file == '.' || $file == '..') continue;
        $path = $dir . '/' . $file;
        if (is_file($path)) unlink($path);
        if (is_dir($path)) rmdirs($path);
    }
    closedir($handle);
    return rmdir($path);
}

function sizedir($dir)
{
    $size = 0;
    $handle = opendir($dir);
    while (($file = readdir($handle)) !== false) {
        if ($file == '.' || $file == '..') continue;
        $path = $dir . '/' . $file;
        if (is_file($path)) $size += filesize($path);
        if (is_dir($path)) $size += sizedir($path);
    }
    closedir($handle);
    return $size;
}

function copyDir($source, $dest)
{
    if (!file_exists($dest)) mkdir($dest);
    $handle = opendir($source);
    while (($file = readdir($handle)) !== false) {
        if ($file == '.' || $file == '..') continue;
        $source = $source . '/' . $file;
        $dest = $dest . '/' . $file;
        if (is_file($source)) copy($source, $dest);
        if (is_dir($source)) copyDir($source, $dest);
    }
    closedir($handle);
}

function huntFor($arr, $search)
{
    $low = 0;
    $height = count($arr) - 1;
    while ($low <= $height) {
        $mid = floor(($low + $height) / 2);//注意在循环内部 每次循环都会调整mid
        if ($arr[$mid] == $search) {
            return $mid;
        } elseif ($arr[$mid] < $search) {
            $low = $mid + 1;
        } elseif ($arr[$mid] > $search) {
            $height = $mid - 1;
        }
    }
    return 'No Data';
}

var_dump(huntFor(array(2, 4, 33, 55, 66, 77, 88, 100), 55));

function fn($str, $n)
{
    return $n > 1 ? $str . fn($str, $n - 1) : $str;
}

var_dump(fn('abc', 4));

function jump($n)
{
    if ($n <= 0) return 0;
    if ($n == 1) return 1;
    if ($n == 2) return 2;
    return jump($n - 1) + jump($n - 2);
}
//F(N)=F(N-1)+F(N-2);

function jumpLoop($n)
{
    $target = 0;
    $number1=1;
    $number2=1;
    if ($n <= 0) return 0;
    if ($n == 1) return 1;
    if ($n == 2) return 2;
    for($i=3;$i<=$n;$i++)
    {
        $target=$number1+$number2;
        $number1=$number2;
        $number2=$target;
    }
    return $target;
}

try{
    $pdo=new PDO('mysql:host=localhost;dbname=hxsd;charset=utf8;port=3306','root','1234');
    $sql="select a from users where username=:username";
    $stmt=$pdo->prepare($sql);
    $data=[':username'=>$username];
    $stmt->execute($data);
    $ROWS=$stmt->rowCount();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e)
{
    $e->getMessage();
}