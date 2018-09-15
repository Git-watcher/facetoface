<?php

	//面向过程
//	$link=mysqli_connect("localhost", "root", "1234") or die("连接失败");
//		//设定字符集
//	mysqli_set_charset($link, "utf8");
//		//选择数据库
//	mysqli_select_db($link, "hxsd");
//
//	mysqli_query($link, "select * from students");




	//面向对象  new对象-------------------------------------------------------------------
	
	function mysql_fn($query){
		$link = new mysqli("localhost","root","1234");
		$link->set_charset("utf8");
		$link->select_db("hxsd");
		
		//发送请求
		$result=$link->query($query);
		
		//sql语句的方法
		$methods=explode(' ', $query)[0];
		
		//返回的信息
		$res=[
			"data"=>false,  //状态
			"info"=>"success",	//相关信息  （成功 错误 ）
		];
		
		switch($methods){
			//增
			case "insert":
				if($result){
					$res['data']=$link->insert_id;  //插入成功后，返回新记录的id
				}else{
					$res['data']=false;
					$res["info"]=$link->error;
				}
			break;
			
			//删
			case "delete":
			//改	
			case "update":
				if($result && $link->affected_rows>0){
					$res['data']=true;
				}else if($link->affected_rows==0){
					$res['data']=false;
					$res["info"]="没有匹配到数据！";
				}else{
					$res['data']=false;
					$res["info"]=$link->error;
				}
			break;
			//查
			case "select":
				if($result && $result->num_rows>0){
					while($rows=$result->fetch_assoc()){
						$arr[]=$rows;
					}
					$res['data']=$arr;
					//关闭结果集
					$result->free();
					
				}else if($result && $result->num_rows==0){
					$res['data']=false;
					$res["info"]="0条记录！！";
				}else{
					$res['data']=false;
					$res["info"]=$link->error;
				}
			break;
			default:
				$res['data']=false;
				$res["info"]="不是有效的sql语句！！";
		}
		//关闭连接 释放资源		
		$link->close();
		return $res;
	}
	
	
	
	$res=mysql_fn("select * from students");
	
	var_dump($res);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
