<?php
/*
将传入的数据加工成带prePage等格式的形式
count:数据库中的总条目数
pageNow：当前所在的页
limit：每一页的条数
list:要加工的带查询结果list的数组,像下边这样，传入的是引用！！！！！
    $list=[
        'list'=>[
            [....],
            [.....]
        ]
    ];
*/
if ( ! function_exists('dividePage') )
{
    function dividePage($count, $pageNow, $limit, $list){
        $list['pageSum']=ceil($count/$limit);
        $list['page']=$pageNow;
        $url=$_SERVER['REQUEST_URI'];   //此时带get参数
        $qMark = strpos($url, '?');     //问号的位置
        $pageLocation = strpos($url, 'page');   //page这个参数的位置
        if($pageLocation){  //带page参数，直接正则替换数字
            //设置上一页链接
            if ($pageNow > 1) {
                $list['prePage']=preg_replace('/page=\d+/', 'page='.($pageNow-1), $url);
            }
            //下一页链接
            if($list['pageSum']>0 && $pageNow < $list['pageSum']){
                $list['nextPage']=preg_replace('/page=\d+/', 'page='.($pageNow+1), $url);
            }
            //跳转的链接,需要移除page这个get参数
            if(strpos($url, '?page=')){ //page在最开头
                if(strpos($url, '&')){      //page后边还有参数
                    $list['go']=preg_replace('/page=\d+&/','',$url);
                } else {
                    $list['go']=preg_replace('/\?page=\d+/','',$url);
                }
            } else { //page在中间或者最后
                $list['go']=preg_replace('/&page=\d+$/', '', $url);
            }
        } else {    //不带page参数后
            if($qMark){ //带有get参数
                $newUrl=$url.'&';  //加上&
            } else {
                $newUrl=$url.'?';  //加上问号
            }
            if ($pageNow > 1) {
                $list['prePage']=$newUrl.'page='.($pageNow-1);
            }
            //下一页链接
            if($list['pageSum']>0 && $pageNow < $list['pageSum']){
                $list['nextPage']=$newUrl.'page='.($pageNow+1);
            }
            $list['go']=$url;
        }
        return $list;
    }
}