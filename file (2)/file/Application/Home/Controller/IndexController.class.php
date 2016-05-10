<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    private $path;

    function _initialize()
    {
        C('URL_MODEL', "0");
        C('URL_HTML_SUFFIX', "");
        $path = I("get.path") ? I("get.path") : getcwd() . "/Public";
        $this->path = $path;
        $this->assign("path", $path);
    }

    function index()
    {
        $dir = dir_info($this->path);
        $this->assign("dir", $dir);
        $this->display();
    }

    //编辑文本
    function edit()
    {
        $this->title = basename($this->path);
        $this->content = file_get_contents($this->path);
        $this->display();
    }

    function update()
    {

        $title = I("post.title");
        $path = $this->path;
        if($title != dirname($this->path)) {
            $path = dirname($this->path) . "/" . $title;
            rename($this->path, $path);
        }

        $content = I("post.content");
        file_put_contents($path, $content);
        $this->redirect(U("edit", "path=$path"));
    }

    //显示图片
    function show()
    {
        $explode_path = explode("/Public", $this->path);
        $img_src = "/Public".$explode_path[1];
        $this->assign("img_src", $img_src);
        $this->display();
    }

}