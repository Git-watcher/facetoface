<?php

ini_set("display_errors","On");
error_reporting(E_ALL);

class TestCase
{
    private static $returnValue=array();
    public static function testcaseIsset($obj)
    {
        $result='';
        $result.=isset($obj)?'1':'0';
        $result.=$obj?'2':'0';
        $result.=empty($obj)? '3':'0';
        self::$returnValue[]=$result;
    }

    public function getTestCaseResult()
    {
        return print_r(self::$returnValue);
    }

}
define('CONSTANTR',hash('sha256',time()));
$definedCons=CONSTANTR;
$$definedCons=array(
    'testCase_A'=>array(),
    'testCase_B'=>'',
    'testCase_C'=>'0',
    'testCase_D'=>'1',
    'testCase_E'=>0,
    'testCase_F'=>1,
    'testCase_G'=>new stdClass(),
);
extract($$definedCons);
foreach($$definedCons as $key=>&$value)
{
    TestCase::testcaseIsset($$key);
    unset($value);
}
var_dump(TestCase::getTestCaseResult(),$$definedCons);

/*
 * Array ( [0] => 103 [1] => 103 [2] => 103 [3] => 120 [4] => 103 [5] => 120 [6] => 120 )
D:\wamp64\www\info\test08.php:41:boolean true
D:\wamp64\www\info\test08.php:41:
array (size=7)
  'testCase_A' =>
    array (size=0)
      empty
  'testCase_B' => string '' (length=0)
  'testCase_C' => string '0' (length=1)
  'testCase_D' => string '1' (length=1)
  'testCase_E' => int 0
  'testCase_F' => int 1
  'testCase_G' =>
    object(stdClass)[1]
 */