<?php
	
	//连接数据库的配置文件
	define('HOST','127.0.0.1');
	define('USER','root');
	define('PASSWORD','1234');
	define('DB_NAME','hxsd');
	define('CHARSET','utf8');
	
	

	class Model{
		
		public $tb_name; //表名
		public $link;	//数据库	
		public $fields;  //查询字段
		public $where; //查询条件
		public $order; //排序条件
		public $limit;  //限制条件
		
		
		
		public function __construct($tb_name){
			//要查询的表名称	
			$this->tb_name=$tb_name;
			//连接数据库
			$this->link=new mysqli(HOST,USER,PASSWORD);
			//设定字符集
			$this->link->set_charset(CHARSET);
			//选择数据库
			$this->link->select_db(DB_NAME);
		}
		
		//增
		public function add($data){
			$keys=array_keys($data);
			$vals=array_values($data);
			
			$keys=implode(",",$keys);
			
			$vals=implode("','",$vals);
			
			$sql="insert into {$this->tb_name} ($keys) values('$vals')";
			
			return $this->query($sql);
		}
		
		//删
		public function del($id){
			return $this->query("delete from {$this->tb_name} where id={$id}");
		}
		
		
		//改
		public function save($data,$id){
			$set="";
			foreach($data as $k=>$v){
				$set.= $k."='".$v."',";
			}
			$set=rtrim($set,",");
			return $this->query("update {$this->tb_name} set $set where id={$id}");
		}


		//查
		public function select(){
			
			//字段
			$f="";
			
			if(empty($this->fields)){
				$f="*";
			}else{
				$f=$this->fields;
			}	
				
			//where
			$w="";
			if(!empty($this->where)){
				$w="where ".$this->where;
			}
			
			//order
			$o="";
			if(!empty($this->order)){
				$o="order by ".$this->order;
			}
			
			//limit
			$l="";
			if(!empty($this->limit)){
				$l="limit ".$this->limit;
			}
			//清空所有查询条件
			$this->fields=null;  //查询字段
			$this->where=null; //查询条件
			$this->order=null; //排序条件
			$this->limit=null;  //限制条件
			
			return $this->query("select {$f} from {$this->tb_name} {$w} {$o} {$l}");
		}
		
		
		//定义字段
		public function field($field_str){
			
			$this->fields=$field_str;
			return $this;
		}
		
		//定义条件
		public function where($where_str){
			$this->where=$where_str;
			return $this;
		}
		
		//定义排序
		public function order($order){
			$this->order=$order;
			return $this;
		}
		
		//定义限制
		public function limit($limit){
			$this->limit=$limit;
			return $this;
		}
		
		//统计总记录数
		public function counts(){
			
			$res=$this->link->query("select * from {$this->tb_name}");
			
			if($res){
				return $res->num_rows;
			}else{
				return false;
			}
		}
		
		
		
		
		//查询sql的方法
		public function query($query){
			$link=$this->link;
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
			return $res;
		}


		//析构方法
		function __destruct(){
			//关闭连接 释放资源		
			$this->link->close();
		}
	}
	





//--------------------------------------------------------------

$res=new Model("students");
//var_dump($res);

//增-------------------------------------------
$arr=[
	"name"=>"zhangsan",
	"sex"=>"m",
	"birthday"=>"2010-10-10",
	"tel"=>"12123123123",
//	"sdf"=>"234234"
];
//var_dump($res->add($arr));



//删-------------------------------------------------
//var_dump($res->del(5));


//改
//$date=[
//	"name"=>"张曼玉",
//	"sex"=>"w"
//];
//var_dump(  $res->save($date,9)   );


//查----------------------------------------------------

$s=$res->field("name,sex,hobby")->where("sex='m'")->order("name")->limit(3)->select();

var_dump($s);

//统计总记录数

var_dump($res->counts());