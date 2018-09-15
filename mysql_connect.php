<?php
function mysql_fn($query){
    $link=mysqli_connect('localhost', 'root', '1234')or die('Error');

    //设定字符集 非必须
    mysqli_set_charset($link,'utf8');

    //选择数据库
    mysqli_select_db($link, 'hxsd');


    //sql第一个单词 区别方法
    $methods=explode(" ", $query)[0];

    $res=[
        "data"=>false,//状态
        "info"=>"Success",//相关信息
    ];

    //global $link;
    $result=mysqli_query($link, $query);
    //
    switch ($methods) {
        case 'insert':
            if($result){
                $res['data']=mysqli_insert_id($link);//插入成功后 返回插入记录的当前id
            }else{
                $res['data']=false;
                $res['info']=mysqli_error($link);
            }
            break;

        case 'delete'://注意写法！！！

        case 'update':
            if($result && mysqli_affected_rows($link)>0){
                $res['data']=true;
            }else if($result && mysqli_affected_rows($link)==0){
                $res['data']=false;
                $res['info']=" mysqli_affected_rows=0";
            }else{
                $res['data']=false;
                $res['info']=mysqli_error($link);
            }
            break;

        case 'select':
            if($result && mysqli_num_rows($result)>0){
                while ($rows=mysqli_fetch_assoc($result)) {
                    //新数组存储记录
                    $arr[]=$rows;
                }
                $res['data']=$arr;//取结果集 直接赋值数据

                mysqli_free_result($result);//关闭结果集！！！

            }else if(mysqli_num_rows($result)==0){
                $res['data']=false;
                $res['info']=" mysqli_num_rows=0";
            }else{
                $res['data']=false;
                $res['info']=mysqli_error($link);
            }
            break;

        default:
            $res['data']=false;
            $res['info']="注意用户行为:".$methods;
            break;
    }

    mysqli_close($link);//关闭资源
    return $res;

}