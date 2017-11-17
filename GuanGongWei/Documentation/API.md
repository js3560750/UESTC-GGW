# 用户界面API

> 定义网站部署于site_url
> 测试用site_url = http://www.wenyangsama.cn/UESTC-GuanGongWei/

## 查看某一类别的所有文章
> 通过url访问 : site_url/article/[options]?page=1
```
options = [
    工作动态:work，
    通知公告:notice，
    学习园地:learn，
    五老风采:old，
    健康指南:health，
    资料下载:download，
    特色活动:feature，
    关工掠影:photos
]
```

> 返回的数据
```
{
    data:
    {
        list:{
          {
            ar_id, //文章唯一标识号
            title, //文章标题
            time,  //发布时间
            top,   //是否置顶，是为1，否为0
            view   //文章具体的网址
          }
          ...
        }
        nextPage: 上一页地址,若已经是第一页,则没有这项
        prePage:  下一页地址,若已经是最后一页,则没有这项
    }
    errorCode:0
}
```
## 查看某一特定下载内容
> 通过url访问 : site_url/view/[ar_id]
> 返回的数据
```
{
    data:{
        list:{
          {
            name, 文件名
            url 文件资源地址
          }
          ...
        }
        pre_article:{ //上一篇文章,若已经是第一,则该项为0
            url,   //网址
            title  //标题
        }, 
        next_article:{ //下一篇文章,若已经在底,则该项为0
            url,   //网址
            title  //标题
        }
    }
    errorCode:0
}
```

## 查看某一特定文章
> 通过url访问 : site_url/view/[ar_id]

> 返回的数据
```
{
    data:{
        ar_id,
        title, //文章标题
        time,  //发布时间
        content, //内容
        source, //来源
        admin, //管理员名称
        click, //点击量
        pre_article:{ //上一篇文章,若已经是第一,则该项为0
            url,   //网址
            title  //标题
        }, 
        next_article:{ //下一篇文章,若已经在底,则该项为0
            url,   //网址
            title  //标题
        }
    }
    errorCode:0
}
```