<?php
//多维数组
$group=[
  "class01"=>[
        "one"=>['a','b','c'],
        "two"=>['d','e','f']
    ],

  "class02" =>[
      "three"=>['g','h','k'],
      "four"=>['i','j','l']
    ]
];
//回调函数
function run($a,$fn)
{
    if($a>1){
        $fn($a);
    }
    return true;
}

function play($b)
{
    echo ++$b;
}

//run(10,'play');

//日期
//var_dump(strtotime('2018-10-1 12:10:10'));

//路径
var_dump(basename('./abc/efg/index.php'));
var_dump(dirname('./abc/efg/index.php'));
var_dump(pathinfo('./abc/efg/index.php'));

//定义目录
$path = "../info";
//打开目录
$res = opendir($path);
//读取目录中的文件（每次调用，读取一个）
while (($file = readdir($res)) != false){//注意括号
    echo pathinfo($file,PATHINFO_BASENAME).'<br/>' ;
}
//关闭目录
closedir($res);

//var_dump(stat('../info'));//文件或目录详细信息

//var_dump($_SERVER);

//文件上传保存临时路径
//move_uploaded_file($tmp_file,$new_file);


//文件下载
//header("Content-type: ");
//header("Accept-Ranges: bytes");
//header("Accept-Length:".$filesize );
//header("Content-Disposition: attachment; filename=".$name);
//readfile($file);

