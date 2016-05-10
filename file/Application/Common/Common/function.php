<?php

//遍历目录
function dir_info($path)
{
    $result = [];
    $handle = opendir($path);
    while ($file = readdir($handle)) {
        $array = [];
        if (substr($file, 0, 1) == ".") {
            continue;
        }

        $array["name"] = $file;
        $array["type"] = filetype($path . "/" . $file);
        $array["size"] = filesize($path . "/" . $file);
        $array["ctime"] = filectime($path . "/" . $file);
        $array["mtime"] = filemtime($path . "/" . $file);
        $result[] = $array;
    }
    closedir($handle);
    return $result;
}


// 文件类型
function get_file_type($fileName)
{
    $type = "";

    //通过filetype()函数返回的文件类型做为选择的条件
    switch (filetype($fileName)) {
        case 'file':
            $type .= "普通文件";
            break;
        case 'dir':
            $type .= "目录文件";
            break;
        case 'block':
            $type .= "块设备文件";
            break;
        case 'char':
            $type .= "字符设备文件";
            break;
        case 'fifo':
            $type .= "命名管道文件";
            break;
        case 'link':
            $type .= "符号链接";
            break;
        case 'unknown':
            $type .= "末知类型";
            break;
        default:
            $type .= "没有检测到类型";
    }

    //返回转换后的类型
    return $type;
}

//计算文件大小
function get_file_size($bytes) {
//如果提供的字节数大于等于2的40次方，则条件成立
if ($bytes >= pow(2, 40)) {
    //将字节大小转换为同等的T大小
    $return = round($bytes / pow(1024, 4), 2);

    //单位为TB
    $suffix = "TB";

    //如果提供的字节数大于等于2的30次方，则条件成立
} elseif ($bytes >= pow(2, 30)) {
    //将字节大小转换为同等的G大小
    $return = round($bytes / pow(1024, 3), 2);

    //单位为GB
    $suffix = "GB";

    //如果提供的字节数大于等于2的20次方，则条件成立
} elseif ($bytes >= pow(2, 20)) {
    //将字节大小转换为同等的M大小
    $return = round($bytes / pow(1024, 2), 2);

    //单位为MB
    $suffix = "MB";

    //如果提供的字节数大于等于2的10次方，则条件成立
} elseif ($bytes >= pow(2, 10)) {

    //将字节大小转换为同等的K大小
    $return = round($bytes / pow(1024, 1), 2);

    //单位为KB
    $suffix = "KB";

    //否则提供的字节数小于2的10次方，则条件成立
} else {
    //字节大小单位不变
    $return = $bytes;
    //单位为Byte
    $suffix = "Byte";
}
//返回合适的文件大小和单位
return $return . " " . $suffix;
}