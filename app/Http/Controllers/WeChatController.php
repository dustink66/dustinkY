<?php
namespace App\Http\Controllers;

use EasyWeChat\OfficialAccount\Application;
use EasyWeChat\Kernel\Form\File;
use EasyWeChat\Kernel\Form\Form;
use Illuminate\Support\Facades\Request;

class WeChatController extends Controller {

    protected $app;

    public function __construct()
    {
        $this->app = app('easywechat.official_account');
    }

    public function serve() {
        $server = $this->app->getServer();
        $server->addEventListener('subscribe', function($message, \Closure $next) {
            return '感谢您关注 尘墨成!';
        });
        return $server->serve();
    }

    public function getQRCode(Request $request)
    {
        $qrCode = $this->app->getServer()->qrcode;
        $result = $qrCode->temporary('123456', 2592000);
        $url = $qrCode->url($result['ticket']);
        echo $url;
    }

    public function draft() {
        $api = $this->app->getClient();
        $options =
            [
                'articles' => [
                    [
                        'title' =>  '群晖通过DOCKER安装观影神器EMBY',
                        'author'    =>  '尘墨成',
                        'content'   =>  '<section id="nice" data-tool="mdnice编辑器" data-website="https://www.mdnice.com" style="font-size: 16px; color: black; padding: 0 10px; line-height: 1.6; word-spacing: 0px; letter-spacing: 0px; word-break: break-word; word-wrap: break-word; text-align: left; counter-reset: counterh1 counterh2 counterh3; font-family: Optima-Regular, Optima, PingFangSC-light, PingFangTC-light, Cambria, Cochin, Georgia, Times, serif;"><p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">在Docker容器中安装Emby媒体服务器可以为群晖用户提供一种便捷的方式来管理和流式传输媒体内容。此外，开启硬件解码功能则能进一步提升媒体播放的流畅度和性能。以下是如何在群晖上通过Docker安装Emby并开启硬件解码的详细步骤。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">首先，确保你的群晖系统已经安装了Container Manager（即Docker，以下简称Docker）。如果还没有安装Docker，可以通过群晖的套件中心进行安装。打开群晖的套件中心，搜索并安装Docker。</p>
<h1 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 24px; line-height: 28px; border-bottom: 1px solid rgb(37,132,181);"><span style="background: rgb(37,132,181); color: white; counter-increment: counterh1; padding: 2px 8px;">Part1</span><span class="prefix" style="display: none;"></span><span class="content" style="color: rgb(37,132,181); margin-left: 8px; font-size: 20px;">镜像下载</span><span class="suffix"></span></h1>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">接下来，打开Docker应用。在左侧的导航栏中，选择“注册表”。在搜索框中输入“emby”，然后选择“lovechen/embyserver”。点击“下载”开始下载Emby镜像。
<img src="https://files.mdnice.com/user/56642/ca52fba7-75cc-43d7-9703-79a676dacf2c.jpg" alt style="display: block; margin: 0 auto; max-width: 100%;"></p>
<h1 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 24px; line-height: 28px; border-bottom: 1px solid rgb(37,132,181);"><span style="background: rgb(37,132,181); color: white; counter-increment: counterh1; padding: 2px 8px;">Part2</span><span class="prefix" style="display: none;"></span><span class="content" style="color: rgb(37,132,181); margin-left: 8px; font-size: 20px;">创建容器</span><span class="suffix"></span></h1>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">1</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">常规设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">一旦下载完成，选择“映像”标签，找到并选择刚刚下载的Emby映像。右键点击“运行”按钮启动容器创建。如下图显示容器名称设置为“emby”，勾选“启用自动重新启动”，然后点击“下一步”进入高级设置。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">2</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">高级设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">在“高级设置”中，你可以配置容器的端口映射和其他设置。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">3</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">端口设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">由于我的群晖系统中的8096和8920端口已被jellyfin占用，因此我将emby容器的8096端口映射为8097，而8920端口则映射为8921。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">4</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">储存空间设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">在点击“添加文件夹”按钮后，一个弹出窗口会出现。接着，我们选择“docker”文件夹，并在弹出窗口的左上角点击“创建文件夹”按钮。然后，输入“emby”并点击确定。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">同样地，在“emby”目录下，我们也可以创建一个名为“config”的文件夹。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">完整的目录映射规则如上图所示：</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">将“/docker/emby/config”路径映射为“/config”路径；</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">将“/media_center/media”路径映射为“/media”路径。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">5</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">环境设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">需要将环境设置中的UID、GID和GIDLIST均设置为“0”。然后，点击“下一步”按钮。接下来，需要检查容器设置是否正确。最后，只需点击“完成”按钮，即可成功创建容器。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">创建完成后，容器将开始运行。现在你可以通过访问你的群晖主机的IP地址和设置的端口号来访问Emby媒体服务器了。</p>
<h1 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 24px; line-height: 28px; border-bottom: 1px solid rgb(37,132,181);"><span style="background: rgb(37,132,181); color: white; counter-increment: counterh1; padding: 2px 8px;">Part3</span><span class="prefix" style="display: none;"></span><span class="content" style="color: rgb(37,132,181); margin-left: 8px; font-size: 20px;">Emby初始化设置</span><span class="suffix"></span></h1>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">首次访问Emby的登录页面时，系统会引导你进行媒体服务器的初始配置。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">6</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">显示语言设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">在Emby界面中，语言设置是非常重要的一个环节，它直接影响到用户的使用体验。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">7</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">设置账号密码</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">界面语言设置完成后，你将进入下一页面，需要输入管理员账户和密码。在创建管理员账户时，你需要输入用户名和密码，并再次确认密码。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">8</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">媒体库设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">完成账户创建后，系统将引导你进入Emby的媒体库设置页面。在此页面，你可以添加媒体文件至媒体库，以便在媒体服务器上共享和播放。由于我们需要配合MoviePilot使用，因此媒体库设置这部分内容我们将直接跳过。有关媒体库设置的详细信息，请参阅名为《群晖搭建全自动化影音中心解决方案》的文章，这篇文章将进行详细的讲解。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">9</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">媒体信息语言设置</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">此处设置的语言和国家/地区是不同的。刚才设置的语言是用于网页界面显示的语言，而此处设置的语言则是指媒体库在刮削电影、电视等节目信息时所收集的语言。这意味着，根据不同的语言设置，媒体库在收集节目信息时会考虑到不同地区和国家的语言需求。因此，正确设置语言和国家/地区，可以确保媒体库能够全面地收集和提供相关节目信息。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">当你在使用Emby媒体服务器时，为了获得最佳的用户体验，对媒体信息语言进行适当的设置是至关重要的。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">在Emby中，媒体信息语言设置主要涉及两个方面：元数据和字幕。元数据是关于媒体文件的信息，如标题、艺术家、专辑、年份等。字幕则是指显示在视频上的文字，如歌词和电影字幕。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">10</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">远程访问</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">如果你想在家庭以外的网络环境下使用Emby，请确保勾选相应的选项。</p>
<h2 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 22px;"><span class="prefix" style="display: inline-block;"><span style="counter-increment: counterh2; color: rgb(159,205,208); border-bottom: 4px solid rgb(159,205,208); font-size: 18px; padding: 2px 4px;">11</span></span><span class="content" style="font-size: 18px; border-bottom: 4px solid rgb(37,132,181); padding: 2px 4px; color: rgb(37,132,181);">设置完成</span><span class="suffix"></span></h2>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">在完成初始化配置后，只需轻轻一点“完成”按钮，您将立刻转至登陆界面。在此处，请输入之前设置的账号密码，顺利完成登陆。</p>
<h1 data-tool="mdnice编辑器" style="margin-top: 30px; margin-bottom: 15px; padding: 0px; font-weight: bold; color: black; font-size: 24px; line-height: 28px; border-bottom: 1px solid rgb(37,132,181);"><span style="background: rgb(37,132,181); color: white; counter-increment: counterh1; padding: 2px 8px;">Part4</span><span class="prefix" style="display: none;"></span><span class="content" style="color: rgb(37,132,181); margin-left: 8px; font-size: 20px;">总结</span><span class="suffix"></span></h1>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">要开启硬件解码，需要进入Emby的设置。在浏览器中打开Emby界面，选择“设置”。在左侧导航栏中，展开“服务器”选项，选择“硬件编码器”。在这里，确保硬件编码器已经启用。</p>
<p data-tool="mdnice编辑器" style="font-size: 16px; padding-top: 8px; padding-bottom: 8px; margin: 0; line-height: 26px; color: black;">这样，你就成功地在群晖上通过Docker安装了Emby并开启了硬件解码功能。现在你可以将媒体文件添加到Emby库中，并通过多种设备流式传输媒体内容，同时享受硬件解码带来的高性能播放体验。</p>
</section>',
                        'content_source_url'    =>  'https://www.dustinky.com/posts/synology-docker-install-emby',
                        'thumb_media_id'    =>  'dII37YEws03Ycnl2xhsBZjHZH7hPxhH08FyXQ27WihfiAnDnkMqTlyf2uC37op_K',
                        'need_open_comment' =>  0,
                        'only_fans_can_comment' =>  0
                    ]
                ],
            ];

        return $api->postJson('cgi-bin/draft/add', $options);
    }

    public function upload()
    {
        $api = $this->app->getClient();
        $contents = file_get_contents('https://static.dustinky.com/images/92ed00e696a27c0001ea8beb1870c92a.jpg');
        $options = Form::create(
            [
                'type'  => 'image',
                'media' => File::withContents($contents, 'image.jpg'), // 注意：请指定文件名
            ]
        )->toArray();

        return $api->post('cgi-bin/material/add_material', $options);
    }

    public function alist()
    {
        $api = $this->app->getClient();
        return $api->post('/cgi-bin/material/batchget_material', [
            'json' => [
                "type" => 'image',
                "offset"    =>  0,
                "count" =>  20
            ]
        ]);
    }

    public function publish()
    {
        $api = $this->app->getClient();

        return $api->post('cgi-bin/freepublish/submit', [
            'json' => [
                "media_id" => 'dII37YEws03Ycnl2xhsBZk46cdCw3bqC4ByfxVEBODjLt5shsNIZVVuFtle6xN1v',
            ]
        ]);
    }
}
?>
