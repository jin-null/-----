<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    private $path;

    function _initialize()
    {
        $this->path = I("get.path") ? I("get.path") : getcwd()."/Public";
    }

    function index()
    {
        $dir = dir_info($this->path);
        $this->assign("dir", $dir);
        $this->display();
    }
}