<?php
function run()
{
    $old_content=file_get_contents('./hello.txt');
    $new_content='Hello World!'."\n".$old_content;
    file_put_contents('./hello.txt',$new_content);
}

//run();

function getDir($dir)
{
    $handle=opendir($dir);
    while( ($file=readdir($handle))!== false)
    {
        if($file != '.' && $file != '..')
        {
            $path=$dir.'/'.$file;
            echo $file.'<br/>';;
            if( is_dir($path)) getDir($path);
        }
    }
}

getDir('./demo');

for($i=0;true;$i++)
{
    if(!isset($str[$i]))
    {
        break;
    }
}

function arr_merge()
{
    $arrays=func_get_args();
    $return=[];
    foreach($arrays as $array)
    {
        if(is_array($array))
        {
            foreach($array as $val)
            {
                $return[]=$val;
            }
        }
    }
    return $return;
}