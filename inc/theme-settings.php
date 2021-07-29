<?php if ( ! defined( 'ABSPATH' )  ) { die; }
 
$prefix = 'io_get_option';

CSF::createOptions( $prefix, array(
    'framework_title' => 'One Nav <small>V'.wp_get_theme()->get('Version').'</small>',
    'menu_title'      => __('主题设置','csf'),
    'menu_slug'       => 'theme_settings',
    'menu_position'   => 59,
    'ajax_save'       => false,
    'show_bar_menu'   => false,
    'theme'           => 'dark',
    'show_search'     => true,
    'footer_text'     => esc_html__('运行在', 'io_setting' ).'： WordPress '. get_bloginfo('version') .' / PHP '. PHP_VERSION,
    'footer_credit'   => '感谢您使用 <a href="https://www.iowen.cn/" target="_blank">一为</a>的WordPress主题',
));

// 所有文章分类ID
function get_cats_id(){  
    if( ! is_admin() ) { return; }
    $cats_id = '';
    $categories = get_categories(array('hide_empty' => 0)); 
    foreach ($categories as $cat) {
        $cats_id .= '<span style="margin-right: 15px;">'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</span>';
    } 
    return $cats_id;
}
// 获取自定义文章父分类
if(!function_exists('get_all_taxonomy')){
	function get_all_taxonomy(){  
        if( ! is_admin() ) { return; }
        $term_query = new WP_Term_Query( array(
            'taxonomy'   =>  array('favorites','apps'),
            'hide_empty' => false,
        ));
        $customize = array(); 
        if ( ! empty( $term_query->terms ) ) {
            foreach ( $term_query ->terms as $term ) { 
                if($term->parent == 0)
                    $customize["id_".$term->term_id] = $term->name;
            }
        }  
        return $customize;
    }
}
// 获取热搜列表
if(!function_exists('get_all_topsearch')){
	function get_all_topsearch(){  
        //if( ! is_admin() ) { return; }
        $topsearch = array(
            'baidu_topsearch'           => '百度热点',
            'weibo_topsearch'           => '微博热搜',
            'zhihu_topsearch'           => '知乎排行榜',
            'weread_topsearch'          => '微信读书',
            'sspai_topsearch'           => '少数派',
            '52pojie_topsearch'         => '吾爱破解',
            '36kr_topsearch'            => '36氪',
            'bilibili_topsearch'        => '哔哩哔哩',
            'lssdjt_topsearch'          => '历史上的今天',
            'douban_topsearch'          => '豆瓣小组',
            'smzdm_select'              => '什么值得买',
            'weixin_news'               => '微信热榜',
            'weixin_hotword'            => '微信热搜词',
            'weixin_amusing'            => '微信搞笑',
            'weixin_gossip'             => '微信八卦精',
            'weixin_financial'          => '微信财经迷',
            'dsb_news'                  => '电商报',
        );
        return $topsearch;
    }
}

// 获取效果列表
if(!function_exists('get_all_fx_bg')){
	function get_all_fx_bg(){  
        $fxbg = array();
        for($i=0;$i<=17;$i++){
            if($i==0)
                $fxbg[$i] = $i;
            else
                $fxbg[sprintf("%02d", $i)] = $i;
        }
        return $fxbg;
    }
}
//
// 开始使用
//
CSF::createSection( $prefix, array(
    'title'        => __('开始使用','io_setting'),
    'icon'         => 'fa fa-shopping-cart',
    'fields'       => array(
        array(
            'type'    => 'notice',
            'style'   => 'warning',
            'content' => '<li style="font-size:18px;color: red">'.__('先保存一遍主题设置选项，否则可能会报错（点右上“保存”按钮）','i_theme').'</li>',
        ),
        array(
            'id'      => 'theme_key',
            'type'    => 'text',
            'title'   => __('主题激活码','io_setting'),
            'after'   => '<br>'.__('请先使用订单激活码<a href="//www.iotheme.cn/user?try=reg" target="_blank" title="注册域名">注册域名</a>。 如果没有购买，请访问<a href="//www.iotheme.cn/store/onenav.html" target="_blank" title="购买主题">iTheme</a>购买。','io_setting'),
        ),
        array(
            'id'      => 'iowen_key',
            'type'    => 'text',
            'title'   => __('一为 API 在线服务激活码','io_setting'),
            'after'   => '<br>'.__('留空不影响主题使用，如需要以下服务必须填。<br>此 key 用于<br>1、添加网址时自动获取网址标题、关键字等信息<br>2、热搜榜、新闻源等卡片数据获取<br>','io_setting').'<br>iowen 在线服务为订阅服务，购买主题免费赠送一年，请先使用订单激活码<a href="//www.iotheme.cn/user?try=reg" target="_blank" title="注册域名">注册域名</a>。 如果没有购买或者过期，请访问<a href="//www.iotheme.cn/store/iowenapi.html" target="_blank" title="购买服务">iTheme</a>购买。',
        ),
        array(
            'id'      => 'update_theme',
            'type'    => 'switcher',
            'title'   => __('检测主题更新','io_setting'),
            'default' => true,
        ),
        array(
            'id'      => 'update_beta',
            'type'    => 'switcher',
            'title'   => __('体验Beta版','io_setting'),
            'label'   => __('Beta版及测试版，可体验最新功能，同时也会各种bug。','io_setting'),
            'default' => false,
        ),
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => '<p>---> <a href="https://www.iotheme.cn/one-nav-zhutishouce.html" target="_blank">使用手册</a> <---</p>',
        ),
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => '<p>---> 下载 <a href="https://www.iotheme.cn/one-nav-yidaohangyanshishujushiyongjiaocheng.html" target="_blank">演示数据</a> <---</p>',
        ),
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => '
            <p>首次安装检查如下设置：</p>
            <ul style="list-style:decimal;padding-left:15px">
                <li>404问题请检查服务器伪静态规则和wp固定链接格式，推荐“/%post_id%.html”。<a href="https://www.iowen.cn/wordpress-version-webstack/#in3" target="_blank">伪静态设置方法</a></li>
                <li>首次启用主题必须保存一遍主题选项才能打开首页，否则可能会报错。</li>
                <li style="color: red">启用主题前请禁用所有插件，以免插件冲突。</li>
            </ul>
            <p>主题使用注意事项：</p>
            <ul style="list-style:decimal;padding-left:15px">
                <li>请先查看：<a href="https://www.iowen.cn/your-first-website" target="_blank">主题使用教程</a></li>
                <li>菜单图标设置请查看主题使用说明和群公共。</li>
                <li>先创建网址分类，然后这添加网址。</li>
                <li>分类最多两级，且第一级不要添加内容。</li>
                <li style="color: red">更新主题后请重新保存主题设置。</li>
                <li>投搞、博客等页面请新建页面然后选择对应的页面模板。</li>
                <li>阿里图标 Iconfont：<a href="https://www.iowen.cn/webstack-pro-navigation-theme-iconfont/" target="_blank">使用方法</a></li>
                <li>侧栏菜单设置方法：<a href="https://www.iowen.cn/webstack-pro-theme-main-menu-setting-description/" target="_blank" style="color: red">必看</a></li>
            </ul>',
        ),
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => '<p>推荐插件：</p>
            <ul style="list-style:decimal;padding-left:15px">
                <li>自动将文章、分类、标签的地址转化为拼音，<a href="https://wordpress.org/plugins/so-pinyin-slugs/" target="_blank">获取插件</a></li>
                <li>对象缓存插件 Memcached， <a href="https://www.baidu.com/s?wd=wordpress%20Memcached" target="_blank">使用方法</a></li>
                <li>XML Sitemap插件，<a href="https://wordpress.org/plugins/xml-sitemap-feed/" target="_blank">获取插件</a></li>
                <li style="color: red">如果不会操作，可以都不用哦 --. 不影响使用</li>
            </ul>',
        ),
    )
));
//
// 图标设置
//
CSF::createSection( $prefix, array(
  'title'        => __('图标设置','io_setting'),
  'icon'         => 'fa fa-star',
  'description'  => __('网站LOGO和Favicon设置','io_setting'),
  'fields'       => array(
    array(
        'id'        => 'logo_normal',
        'type'      => 'media',
        'title'     => 'Logo',
        'add_title' => __('上传','io_setting'),
        'after'     => '<p class="cs-text-muted">'.__('建议高80px，长小于360px','io_setting'),
        'default'   => array(
            'url'       => get_theme_file_uri( '/images/logo@2x.png'),
            'thumbnail' => get_theme_file_uri( '/images/logo@2x.png'),
        ),
    ),
    array(
        'id'        => 'logo_normal_light',
        'type'      => 'media',
        'title'     => __('亮色主题Logo','io_setting'),
        'add_title' => __('上传','io_setting'),
        'after'     => '<p class="cs-text-muted">'.__('建议高80px，长小于360px','io_setting'),
        'default'   => array(
            'url'       => get_theme_file_uri('/images/logo_l@2x.png'),
            'thumbnail' => get_theme_file_uri('/images/logo_l@2x.png'),
        ),
    ),
    array(
        'id'        => 'logo_small',
        'type'      => 'media',
        'title'     => __('方形 Logo','io_setting'),
        'add_title' => __('上传','io_setting'),
        'after'     => '<p class="cs-text-muted">'.__('建议 80x80','io_setting'),
        'default'   => array(
            'url'       => get_theme_file_uri('/images/logo-collapsed@2x.png'),
            'thumbnail' => get_theme_file_uri('/images/logo-collapsed@2x.png'),
        ),
    ),
    array(
        'id'        => 'logo_small_light',
        'type'      => 'media',
        'title'     => __('亮色主题方形 Logo','io_setting'),
        'add_title' => __('上传','io_setting'),
        'after'     => '<p class="cs-text-muted">'.__('建议 80x80','io_setting'),
        'default'   => array(
            'url'       => get_theme_file_uri('/images/logo-dark_collapsed@2x.png'),
            'thumbnail' => get_theme_file_uri('/images/logo-dark_collapsed@2x.png'),
        ),
    ),
    array(
        'id'        => 'favicon',
        'type'      => 'media',
        'title'     => __('上传 Favicon','io_setting'),
        'add_title' => __('上传','io_setting'),
        'default'   => array(
            'url'       => get_theme_file_uri('/images/favicon.png'),
            'thumbnail' => get_theme_file_uri('/images/favicon.png'),
        ),
    ),
    array(
        'id'        => 'apple_icon',
        'type'      => 'media',
        'title'     => __('上传 apple_icon','io_setting'),
        'add_title' => __('上传','io_setting'),
        'default'   => array(
            'url'       => get_theme_file_uri('/images/app-ico.png'),
            'thumbnail' => get_theme_file_uri('/images/app-ico.png'),
        ),
    ),
  )
));

//
// 主题颜色
//
CSF::createSection( $prefix, array(
    'title'        => __('颜色效果','io_setting'),
    'icon'         => 'fa fa-tachometer',
    'fields'       => array( 
        array(
            'id'      => 'theme_mode',
            'type'    => 'radio',
            'title'   => __('颜色主题','io_setting'),
            'default' => 'io-grey-mode',
            'inline'  => true,
            'options' => array(
                'io-black-mode'  => __('暗色','io_setting'),
                'io-white-mode'  => __('黑白','io_setting'),
                'io-grey-mode'   => __('亮灰','io_setting'),
            ),
			'after'   => __('如果在前台通过“主题切换开关”手动切换主题，此设置无效，或者清除浏览器cookie才能生效','io_setting')
        ),
        array(
            'id'      => 'home_width',
            'type'    => 'switcher',
            'title'   => __('自定义首页内容宽度','io_setting'),
            'default' => false,
            'class'   => 'new',
        ),
        array(
            'id'      => 'h_width',
            'type'    => 'slider',
            'title'   => ' ┗━━ '.'宽度',
            'class'   => 'new',
            'min'     => 1320,
            'max'     => 2000,
            'step'    => 10,
            'unit'    => 'px',
            'default' => 1900,
            'dependency' => array( 'home_width', '==', true )
        ),
        array(
            'id'      => 'loading_fx',
            'type'    => 'switcher',
            'title'   => __('全屏加载效果','io_setting'),
            'default' => false,
        ),
        array(
            'id'        => 'loading_type',
            'type'      => 'image_select',
            'title'     => __('加载效果','io_setting'),
            'options'   => array(
                'rand'  => get_theme_file_uri('/images/loading/load0.png'),
                '1'     => get_theme_file_uri('/images/loading/load1.png'),
                '2'     => get_theme_file_uri('/images/loading/load2.png'),
                '3'     => get_theme_file_uri('/images/loading/load3.png'),
                '4'     => get_theme_file_uri('/images/loading/load4.png'),
                '5'     => get_theme_file_uri('/images/loading/load5.png'),
                '6'     => get_theme_file_uri('/images/loading/load6.png'),
                '7'     => get_theme_file_uri('/images/loading/load7.png'),
            ),
            'default'   => '1',
            'class'     => '',
			'subtitle'  => __('包括go跳转页,go跳转页不受上面开关影响','io_setting'),
        ),
        array(
            'id'        => 'login_ico',
            'type'      => 'media',
            'title'     => __('登录页图片','io_setting'),
            'add_title' => __('上传','io_setting'),
            'default'   => array(
                'url'       => get_theme_file_uri('/images/login.jpg'),
                'thumbnail' => get_theme_file_uri('/images/login.jpg'),
            ),
        ),
        array(
            'id'        => 'login_color',
            'type'      => 'color_group',
            'title'     => '登录页背景色',
            'class'     => 'new',
            'options'   => array(
                'color-l'   => '左边',
                'color-r'   => '右边',
            ),
            'default'   => array(
                'color-l'   => '#2b1136',
                'color-r'   => '#f1404b',
            ),
        ),
        array(
            'id'      => 'custom_color',
            'type'    => 'switcher',
            'title'   => __('自定义颜色','io_setting'),
            'default' => false,
        ),
        array(
            'id'        => 'bnt_c',
            'type'      => 'color_group',
            'title'     => '按钮颜色',
            'options'   => array(
              'color'   => '默认颜色',
              'color-t' => '默认文字颜色',
              'hover'   => 'hover 颜色',
              'hover-t' => 'hover 文字颜色',
            ),
            'default'   => array(
              'color'   => '#f1404b',
              'color-t' => '#ffffff',
              'hover'   => '#14171B',
              'hover-t' => '#ffffff',
            ),
            'dependency' => array( 'custom_color', '==', true )
        ),
        array(
            'id'      => 'link_c',
            'type'    => 'link_color',
            'title'   => '文章 a 链接颜色',
            'default' => array(
              'color' => '#f1404b',
              'hover' => '#f9275f',
            ),
            'dependency' => array( 'custom_color', '==', true )
        ),
        array(
            'id'      => 'card_a_c',
            'type'    => 'color',
            'title'   => '卡片链接高亮',
            'default' => '#f1404b',
            'dependency' => array( 'custom_color', '==', true )
        ),
        array(
            'id'      => 'piece_c',
            'type'    => 'color',
            'title'   => '高亮色块',
            'default' => '#f1404b',
            'dependency' => array( 'custom_color', '==', true )
        ),
    )
  ));
  
  
//
// 基础设置
//
CSF::createSection( $prefix, array(
    'title'  => __('基础设置','io_setting'),
    'icon'   => 'fa fa-th-large',
    'fields' => array(
        array(
            'id'      => 'min_nav',
            'type'    => 'switcher',
            'title'   => __('mini 侧边栏','io_setting'),
            'label'   => __('默认使用 Mini 侧边栏，开启前请设置好菜单项图标','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'nav_top_mobile',
            'type'    => 'text',
            'title'   => __('移动设备顶部菜单名称','io_setting'),
            'after'   => __('大屏顶部菜单在移动设备上显示到侧边栏菜单，-->留空则不显示<--','io_setting'),
            'default' => '站点推荐',
            'class'   => '',
        ),
        array(
            'id'      => 'bing_cache',
            'type'    => 'switcher',
            'title'   => __('必应背景图片本地缓存','io_setting'),
            'label'   => __('文明获取，避免每次都访问 bing 服务器','io_setting'),
            'class'   => 'new',
            'default' => true,
        ),
        array(
            'id'      => 'sites_sortable',
            'type'    => 'switcher',
            'title'   => __('网址拖拽排序','io_setting'),
            'label'   => __('在后台网址列表使用拖拽排序,请同时选择“首页网址分类排序”为“自定义排序字段”','io_setting'),
            'after'   => '<br>'.__('如果想继续使用老版的排序字段，请关闭此功能','io_setting'),
            'class'   => '',
            'default' => true,
        ),
        array(
            'id'      => 'user_center',
            'type'    => 'switcher',
            'title'   => __('启用用户中心','io_setting'),
            'label'   => __('同时启用个性化登录页','io_setting'),
            'class'   => '',
            'default' => true,
        ),
        array(
            'type'    => 'submessage',
            'style'   => 'danger',
            'content' => '┗━━━━━┗━━━━━┗━━━━ 启用和禁用用户中心后需重新保存固定链接',
        ),
        array(
            'id'      => 'nav_login',
            'type'    => 'switcher',
            'title'   => __('顶部登陆按钮','io_setting'),
            'default' => false,
        ),
        array(
            'id'        => 'sticky_tag',
            'type'      => 'fieldset',
            'title'     => __('置顶标签','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'switcher',
                    'type'  => 'switcher',
                    'title' => __('显示','io_setting'),
                ),
                array(
                    'id'    => 'name',
                    'type'  => 'text',
                    'title' => __('显示内容','io_setting'),
                ),
            ),
            'default'        => array(
                'switcher'    => false,
                'name'        => 'T',
            ),
        ),
        array(
            'id'        => 'new_tag',
            'type'      => 'fieldset',
            'title'     => __('NEW 标签','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'switcher',
                    'type'  => 'switcher',
                    'title' => __('显示','io_setting'),
                ),
                array(
                    'id'    => 'name',
                    'type'  => 'text',
                    'title' => __('显示内容','io_setting'),
                ),
                array(
                    'id'    => 'date',
                    'type'  => 'spinner',
                    'title' => __('时间','io_setting'),
                    'after' => __('几天内的内容标记为新内容','io_setting'),
                    'unit'  => '天',
                    'step'  => 1,
                ),
            ),
            'default'        => array(
                'switcher'    => false,
                'name'        => 'N',
                'date'        => 7,
            ),
        ),
        array(
            'id'      => 'is_nofollow',
            'type'    => 'switcher',
            'title'   => __('网址块添加nofollow','io_setting'),
            'after'   => __('详情页开启则不添加','io_setting'),
            'default' => true,
        ),
        array(
            'id'      => 'details_page',
            'type'    => 'switcher',
            'title'   => __('详情页','io_setting'),
            'subtitle'=> __('启用网址详情页','io_setting'),
            'label'   => __('关闭状态为网址块直接跳转到目标网址。','io_setting'),
            'after'   => __('<strong>“公众号”</strong>和<strong>“下载资源”</strong>默认开启详情页，不受此选项限制。','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'url_rank',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('爱站权重','io_setting'),
            'label'   => __('详情页显示爱站权重','io_setting'),
            'default' => true,
            'class'   => '',
            'dependency' => array( 'details_page', '==', true )
        ),
        array(
            'id'      => 'sites_preview',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('网址预览','io_setting'),
            'label'   => __('显示目标网址预览，如api服务失效，请关闭。','io_setting'),
            'default' => false,
            'class'   => '',
            'dependency' => array( 'details_page', '==', true )
        ),
        array(
            'id'      => 'togo',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('直达按钮','io_setting'),
            'label'   => __('网址块显示直达按钮','io_setting'),
            'default' => true,
            'dependency' => array( 'details_page', '==', true )
        ),
        array(
            'id'      => 'show_speed',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('显示网址链接速度(死链)','io_setting'),
            'label'   => __('在网址详情页显示目标网址的链接速度、国家或地区等信息','io_setting'),
            'after'   => __('为网址失效状态提供数据来源<br>前台 JS 检测，不影响服务器性能','io_setting'),
            'default' => false,
            'dependency' => array( 'details_page', '==', true )
        ),
        array(
            'id'      => 'failure_valve',
            'type'    => 'spinner',
            'title'   => ' ┗━━ '.__('网址失效状态(死链)','io_setting'),
            'after'   => __('详情页检测链接失败几次后提示管理员检测网址有效性<br>0为关闭提示','io_setting'),
            'default' => 0,
            'dependency' => array( 'details_page|show_speed', '==|==', 'true|true' )
        ),
        array(
            'id'      => 'new_window',
            'type'    => 'switcher',
            'title'   => __('新标签中打开内链','io_setting'),
            'label'   => __('站点所有内部链接在新标签中打开','io_setting'),
            'default' => true,
        ),
        array(
            'id'      => 'post_views',
            'type'    => 'switcher',
            'title'   => __('访问统计','io_setting'),
            'label'   => __('启用前先禁用WP-PostViews插件，因为主题已经集成WP-PostViews插件,或者关掉选项安装WP-PostViews插件','io_setting'),
            'after'   =>  '<br><br>如果开启没显示数字，去后台 <a href="'.home_url().'/wp-admin/options-general.php?page=views_options" >“设置 > 浏览计数”</a> 选项里 “恢复默认” 并保存', 
            'default' => false,
        ),
        array(
            'id'      => 'views_n',
            'type'    => 'text',
            'title'   => ' ┗━━ '.__('访问基数','io_setting'),
            'after'   => '<br>'.__('随机访问基数，取值范围：(0~10)*访问基数<br>设置大于0的整数启用，会导致访问统计虚假，酌情开启，关闭请填0','io_setting'),
            'default' => 0,
            'dependency' => array( 'post_views', '==', true )
        ),
        array(
            'id'      => 'views_r',
            'type'    => 'text',
            'title'   => ' ┗━━ '.__('访问随机计数','io_setting'),
            'after'   => '<br>'.__('访问一次随机增加访问次数，比如访问一次，增加5次<br>取值范围：(1~10)*访问随机数<br>设置大于0的数字启用，可以是小数，如：0.5，但小于0.5会导致取0值<br>会导致访问统计虚假，酌情开启，关闭请填0','io_setting'),
            'default' => 0,
            'dependency' => array( 'post_views', '==', true )
        ),
        array(
            'id'      => 'like_n',
            'type'    => 'text',
            'title'   => __('点赞基数','io_setting'),
            'after'   => '<br>'.__('随机点赞基数，取值范围：(0~10)*点赞基数<br>设置大于0的整数启用，会导致点赞统计虚假，酌情开启，关闭请填0','io_setting'),
            'default' => 0,
        ),
        array(
            'id'      => 'is_go',
            'type'    => 'switcher',
            'title'   => __('内链跳转(go跳转)','io_setting'),
            'label'   => __('站点所有外链跳转，效果：http://您的域名/go/?url=外链','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'exclude_links', 
            'type'    => 'textarea',
            'title'   => __('go跳转白名单','io_setting'),
            'subtitle'=> __('go跳转和正文nofollow白名单','io_setting'),
            'after'   => __('一行一个地址，注意不要有空格。<br>需要包含http(s)://<br>iowen.cn和www.iowen.cn为不同的网址<br>此设置同时用于 nofollow 的排除。','io_setting'),
        ),
        array(
            'id'      => 'save_image',
            'type'    => 'switcher',
            'title'   => __('本地化外链图片','io_setting'),
            'label'   => __('自动存储外链图片到本地服务器','io_setting'),
            'after'   => __('只支持经典编辑器<br><strong>注：</strong>使用古腾堡(区块)编辑器的请不要开启，否则无法保存文章','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'lazyload',
            'type'    => 'switcher',
            'title'   => __('图标懒加载','io_setting'),
            'label'   => __('所有图片懒加载','io_setting'),
            'default' => true,
        ),
    )
));

//
// 首页设置
//
CSF::createSection( $prefix, array(
    'title'        => __('首页设置','io_setting'),
    'icon'         => 'fa fa-home',
    'fields'       => array(  
        array(
            'id'      => 'po_prompt',
            'type'    => 'radio',
            'title'   => __('网址块弹窗提示','io_setting'),
            'desc'    => __('网址块默认的弹窗提示内容','io_setting'),
            'default' => 'url',
            'inline'  => true,
            'options' => array(
                'null'      => __('无','io_setting'),
                'url'       => __('链接','io_setting'),
                'summary'   => __('简介','io_setting'),
                'qr'        => __('二维码','io_setting'),
            ),
            'after'   => __('如果网址添加了自定义二维码，此设置无效','io_setting'),
        ),
        array(
            'id'         => 'columns',
            'type'       => 'radio',
            'title'      => __('网址列数','io_setting'),
            'subtitle'   => __('网址块列表一行显示的个数','io_setting'),
            'default'    => '6',
            'inline'     => true,
            'options'    => array(
                '2'  => '2',
                '3'  => '3',
                '4'  => '4',
                '6'  => '6',
                '10' => '10'
            ),
            'after'      => '只对网址有效。',
        ),
        array(
            'id'      => 'two_columns',
            'type'    => 'switcher',
            'title'   => __('小屏显示两列','io_setting'),
            'label'   => __('手机等小屏幕显示两列。只支持默认网址卡片(中号卡片样式)','io_setting'),
            'default' => false,
        ),
        array(
            'id'        => 'card_n',
            'type'      => 'fieldset',
            'title'     => __('在首页分类下显示的内容数量','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'favorites',
                    'type'  => 'spinner',
                    'title' => __('网址数量','io_setting'),
                    'step'       => 1,
                ),
                array(
                    'id'    => 'apps',
                    'type'  => 'spinner',
                    'title' => __('App 数量','io_setting'),
                    'step'       => 1,
                ),
                array(
                    'id'    => 'books',
                    'type'  => 'spinner',
                    'title' => __('书籍数量','io_setting'),
                    'step'       => 1,
                ),
                array(
                    'id'    => 'category',
                    'type'  => 'spinner',
                    'title' => __('文章数量','io_setting'),
                    'step'       => 1,
                ),
            ),
            'default'        => array(
                'favorites'   => 20,
                'apps'        => 16,
                'books'       => 16,
                'category'    => 16,
            ),
            'after'      => '填写需要显示的数量。<br>-1 为显示分类下所有网址<br>&nbsp;0 为根据<a href="'.home_url().'/wp-admin/options-reading.php">系统设置数量显示</a>',
        ),
        array(
            'id'      => 'show_sticky',
            'type'    => 'switcher',
            'title'   => __('置顶内容前置','io_setting'),
            'label'   => __('首页置顶的内容显示在前面','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'category_sticky',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('分类&归档页置顶内容前置','io_setting'),
            'default' => false,
            'class'   => '',
            'dependency' => array( 'show_sticky', '==', true )
        ),
        array(
            'id'        => 'home_sort',
            'type'      => 'fieldset',
            'title'     => __('首页分类排序','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'favorites',
                    'type'  => 'radio',
                    'title' => __('网址排序','io_setting'),
                    'inline'     => true,
                    'options'    => array(
                        '_sites_order'  => '自定义排序字段',
                        'ID'            => 'ID',
                        'modified'      => '修改日期',
                        'date'          => '创建日期',
                        'views'         => '查看次数',
                    ),
                ),
                array(
                    'id'    => 'apps',
                    'type'  => 'radio',
                    'title' => __('APP 排序','io_setting'),
                    'inline'     => true,
                    'options'    => array(
                        'ID'            => 'ID',
                        'modified'      => '修改日期',
                        'date'          => '创建日期',
                        'views'         => '查看次数',
                        '_down_count'   => '下载次数',
                    ),
                ),
                array(
                    'id'    => 'books',
                    'type'  => 'radio',
                    'title' => __('书籍排序','io_setting'),
                    'inline'     => true,
                    'options'    => array(
                        'ID'            => 'ID',
                        'modified'      => '修改日期',
                        'date'          => '创建日期',
                        'views'         => '查看次数',
                    ),
                ),
                array(
                    'id'    => 'category',
                    'type'  => 'radio',
                    'title' => __('文章排序','io_setting'),
                    'inline'     => true,
                    'options'    => array(
                        'ID'            => 'ID',
                        'modified'      => '修改日期',
                        'date'          => '创建日期',
                        'views'         => '查看次数',
                    ),
                ),
            ),
            'default'        => array(
                'favorites'   => '_sites_order',
                'apps'        => 'modified',
                'books'       => 'modified',
                'category'    => 'date',
            ),
            'after'   => '<p style="color: red">'.__('启用“查看次数”“下载次数”等排序方法请开启相关统计，如果对象没有相关数据，则不会显示。','io_setting').'</p>',
        ),
        array(
            'id'      => 'show_bulletin',
            'type'    => 'switcher',
            'title'   => __('启用公告','io_setting'),
            'label'   => __('启用自定义文章类型“公告”，启用后刷新页面','io_setting'),
            'default' => false,
        ),
        array(
            'id'         => 'bulletin',
            'type'       => 'switcher',
            'title'      => ' ┗━━ '.__('显示公告','io_setting'),
            'label'      => __('在首页顶部显示公告','io_setting'),
            'default'    => true,
            'dependency' => array( 'show_bulletin', '==', true )
        ),
        array(
            'id'         => 'bulletin_n',
            'type'       => 'spinner',
            'title'      => ' ┗━━ '.__('公告数量','io_setting'),
            'after'      => __('需要显示的公告篇数','io_setting'),
            'max'        => 10,
            'min'        => 1,
            'step'       => 1,
            'default'    => 2,
            'dependency' => array( 'bulletin|show_bulletin', '==|==', 'true|true' )
        ),
		array(
            'id'             => 'all_bull',
            'type'           => 'select',
            'title'          => ' ┗━━ '.__('公告归档页','io_setting'),
            'after'    	   => __(' 如果没有，新建页面，选择“所有公告”模板并保存。','io_setting'),
            'options'        => 'pages',
            'query_args'     => array(
                'posts_per_page'  => -1,
            ),
            'placeholder'    => __('选择公告归档页面', 'io_setting'),
            'dependency'     => array( 'bulletin|show_bulletin', '==|==', 'true|true' )
        ),
        array(
            'id'      => 'search_position',
            'type'    => 'checkbox',
            'title'   => __('搜索位置','io_setting'),
            'default' => 'home',
            'inline'  => true,
            'options' => array(
                'home'      => __('默认位置','io_setting'),
                'top'       => __('头部','io_setting'),
                'tool'      => __('页脚小工具','io_setting'),
            ), 
            'after'      => __('默认位置在首页内容前面和分类内容前面显示搜索框','io_setting'),
        ),
        array(
            'id'         => 'baidu_hot_words',
            'type'       => 'radio',
            'title'      => __('搜索词补全','io_setting'),
            'default'    => 'baidu',
            'inline'     => true,
            'options'    => array(
                'null'    => '无',
                'baidu'   => '百度',
                'google'  => 'Google',
            ),
            'after'      => '选择搜索框词补全源，选无则不补全。',
        ),
        array(
            'id'        => 'search_skin',
            'type'      => 'fieldset',
            'title'     => ' ┗━━ '.__('搜索样式','io_setting'),
            'fields'    => array(
                array(
                    'id'         => 'search_big',
                    'type'       => 'switcher',
                    'title'      => __('big 搜索','io_setting'),
                    'label'      => __('关掉将启用简洁模式','io_setting'),
                    'default'    => true,
                ),
                array(
                    'id'         => 'big_title',
                    'type'       => 'text',
                    'title'      => __('大字标题','io_setting'),
                    'after'      => '<br>'.__('留空不显示','io_setting'), 
                    'class'   => '', 
                    'dependency' => array( 'search_big', '==', true )
                ),
                array(
                    'id'      => 'big_skin',
                    'type'    => 'radio',
                    'title'   => __('背景模式','io_setting'),
                    'default' => 'css-color',
                    'inline'  => true,
                    'options' => array(
                        'no-bg'         => __('无背景','io_setting'),
                        'css-color'     => __('颜色','io_setting'),
                        'css-img'       => __('自定义图片','io_setting'),
                        'css-bing'      => __('bing 每日图片','io_setting'),
                        'canvas-fx'     => __('canvas 特效','io_setting'),
                    ),
                    'dependency' => array( 'search_big', '==', true )
                ),
                array(
                    'id'        => 'search_color',
                    'type'      => 'color_group',
                    'title'     => 'Color Group',
                    'options'   => array(
                        'color-1' => 'Color 1',
                        'color-2' => 'Color 2',
                        'color-3' => 'Color 3',
                    ),
                    'default'   => array(
                        'color-1' => '#ff3a2b',
                        'color-2' => '#ed17de',
                        'color-3' => '#f4275e',
                    ),
                    'dependency' => array( 'search_big|big_skin', '==|==', 'true|css-color' )
                ),
                array(
                    'id'        => 'search_img',
                    'type'      => 'media',
                    'title'     => '背景图片',
                    'add_title' => __('上传','io_setting'),
                    'dependency' => array( 'search_big|big_skin', '==|==', 'true|css-img' )
                ),
                array(
                    'id'      => 'canvas_id',
                    'type'    => 'radio',
                    'title'   => __('canvas 样式','io_setting'),
                    'default' => '0',
                    'inline'  => true,
                    'options' => get_all_fx_bg(),
                    'dependency' => array( 'search_big|big_skin', '==|==', 'true|canvas-fx' )
                ),
                array(
                    'id'         => 'bg_gradual',
                    'type'       => 'switcher',
                    'title'      => __('背景渐变','io_setting'),
                    'default'    => false,
                    'dependency' => array( 'search_big|big_skin', '==|!=', 'true|no-bg' )
                ),
                array(
                    'id'         => 'post_top',
                    'type'       => 'switcher',
                    'title'      => __('文章轮播上移','io_setting'),
                    'default'    => true,
                    'dependency' => array( 'search_big', '==', true )
                ),
            ),
            'dependency' => array( 'search_position', 'any', 'home' )
        ),
        array(
            'id'             => 'hot_list_id2',
            'type'           => 'sorter',
            'title'          => __('热搜热点小工具','io_setting'),
            'class'          => 'topsearch',
            //'default'        => array( 
            //    'disabled'     => array(
            //        'baidu_topsearch'       => '百度热点',
            //        'weibo_topsearch'       => '微博热搜',
            //        'zhihu_topsearch'       => '知乎排行榜',
            //        'weread_topsearch'      => '微信读书',
            //        'sspai_topsearch'       => '少数派',
            //        '52pojie_topsearch'     => '吾爱破解',
            //        '36kr_topsearch'        => '36氪',
            //        'bilibili_topsearch'    => '哔哩哔哩',
            //        'lssdjt_topsearch'      => '历史上的今天',
            //        'douban_topsearch'      => '豆瓣小组',
            //        'smzdm_select'          => '什么值得买',
            //        'weixin_news_topsearch' => '微信热榜',
            //    ),
            //),
            'enabled_title'  => __('启用','io_setting'),
            'disabled_title' => __('隐藏', 'io_setting'),
            'before'         => __('需到开始使用中填写key（--->拖动<---），最多显示5个','io_setting').'<br>',
        ),
        array(
            'id'         => 'hot_iframe',
            'type'       => 'switcher',
            'title'      => __('热搜热点站内 iframe 加载','io_setting'),
            'label'      => __('如果开启了此选项链接还是在新窗口打开，说明对方不支持 iframe 嵌套','io_setting'),
            'default'    => false,
        ),
        array(
            'id'         => 'customize_card',
            'type'       => 'switcher',
            'title'      => __('自定义网址（我的导航）','io_setting'),
            'label'      => __('显示游客自定义网址模块，允许游客自己添加网址和记录最近点击，数据保存于游客电脑。','io_setting'),
            'default'    => true,
        ),
        array(
            'id'         => 'customize_d_n',
            'type'       => 'text',
            'title'      => ' ┗━━ '.__('预设网址（我的导航）','io_setting'),
            'after'      => '<br>'.__('自定义网址模块添加预设网址，显示位置：<br>1、首页“我的导航”模块预设网址<br>2、“mini 书签页”快速导航列表<br><br>例：1,22,33,44 用英语逗号分开（填文章ID）','io_setting'), 
        ),
        array(
            'id'         => 'customize_show',
            'type'       => 'switcher',
            'title'      => ' ┗━━ '.__('始终显示预设网址','io_setting'),
            'label'      => __('开启用户中心后仍然显示预设网址','io_setting'), 
            'default'    => true,
            'dependency' => array( 'customize_card', '==', true )
        ),
        array(
            'id'         => 'customize_count',
            'type'       => 'spinner',
            'title'      => ' ┗━━ '.__('最多分类','io_setting'),
            'after'      => '<br>'.__('最多显示多少用户自定义网址分类，0 为全部显示','io_setting'), 
            'step'       => 1,
            'default'    => 8,
            'class'      => 'new',
            'dependency' => array( 'customize_card', '==', true )
        ),
		array(
			'id'         => 'customize_n',
			'type'       => 'spinner',
			'title'      => ' ┗━━ '.__('最近点击','io_setting'),
            'after'      => __('最近点击网址记录的最大数量','io_setting'),
            'max'        => 50,
            'min'        => 1,
            'step'       => 1,
            'default'    => 10,
            'dependency' => array( 'customize_card', '==', true )
		),
        array(
            'id'         => 'hot_card',
            'type'       => 'switcher',
            'title'      => __('首页热门网址','io_setting'),
            'label'      => __('首页显示热门网址模块，需开启访问统计，并产生了访问和点赞数据','io_setting'),
            'default'    => false,
        ),
        array(
            'id'             => 'hot_menu_1',
            'type'           => 'sorter',
            'title'          => ' ┗━━  '.__('热门菜单排序','io_setting'),
            'default'        => array(
                'enabled'      => array(
                    'sites-views'       => '热门网址',
                    'sites-_like_count' => '大家喜欢',
                    'sites-date'        => '最新网址',
                ),
                'disabled'     => array(
                    'app-views'        => '热门 App',
                    'app-_like_count'  => '最爱 App',
                    'app-date'         => '最新 App',
                    'app-_down_count'  => '下载最多 APP',
                    'book-views'       => '热门书籍',
                    'book-_like_count' => '最爱书籍',
                    'book-date'        => '最新书籍',
                ),
            ),
            'enabled_title'  => __('启用','io_setting'),
            'disabled_title' => __('隐藏', 'io_setting'),
            'dependency' => array( 'hot_card', '==', true )
        ),
        array(
            'id'         => 'hot_card_mini',
            'type'       => 'switcher',
            'title'      => ' ┗━━  '.__('mini网址块','io_setting'),
            'label'      => __('显示热门网址启用mini网址块，只对网址有效','io_setting'),
            'default'    => false,
            'dependency' => array( 'hot_card', '==', true )
        ),
		array(
			'id'         => 'hot_n',
			'type'       => 'spinner',
			'title'      => ' ┗━━ '.__('热门数量','io_setting'),
            'max'        => 50,
            'min'        => 1,
            'step'       => 1,
            'default'    => 10,
            'dependency' => array( 'hot_card', '==', true )
		),
        array(
            'id'      => 'same_ico',
            'type'    => 'switcher',
            'title'   => __('统一图标','io_setting'),
            'label'   => __('首页侧边栏和内容标题统一图标','io_setting'),
            'default' => false,
            'class'   => '',
        ),
        array(
            'id'      => 'tab_type',
            'type'    => 'switcher',
            'title'   => __('tab(选项卡)模式','io_setting'),
            'label'   => __('首页使用标签模式展示2级收藏网址','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'tab_ajax',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('tab模式 ajax 加载','io_setting'),
            'label'   => __('降低首次载入时间，但切换tab时有一定延时','io_setting'),
            'default' => true,
            'dependency' => array( 'tab_type', '==', true )
        ),
        array(
            'id'      => 'tab_p_n',
            'type'    => 'switcher',
            'title'   => __('父级名称','io_setting'),
            'label'   => __('网址块分类名前面显示父级分类名称','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'show_friendlink',
            'type'    => 'switcher',
            'title'   => __('启用友链','io_setting'),
            'label'   => __('启用自定义文章类型“链接(友情链接)”，启用后需刷新页面','io_setting'),
            'default' => false,
        ),
        array(
            'id'         => 'links',
            'type'       => 'switcher',
            'title'      => ' ┗━━ '.__('友情链接','io_setting'),
            'label'      => __('在首页底部添加友情链接','io_setting'),
            'default'    => true,
            'dependency' => array( 'show_friendlink', '==', true )
        ),
        array(
            'id'          => 'home_links',
            'type'        => 'checkbox',
            'title'       => ' ┗━━ '.__('首页显示分类','io_setting'),
            'after'       => __('不选则全部显示。','io_setting'),
            'inline'      => true,
            'options'     => 'categories',
            'query_args'  => array(
              'taxonomy'  => 'link_category',
            ),
            'dependency'  => array( 'show_friendlink|links', '==|==', 'true|true' )
        ),
        array(
            'id'          => 'links_pages',
            'type'        => 'select',
            'title'       => ' ┗━━ '.__('友情链接归档页','io_setting'),
            'after'       => __(' 如果没有，新建页面，选择“友情链接”模板并保存。','io_setting'),
            'options'     => 'pages',
            'query_args'  => array(
              'posts_per_page'  => -1,
            ),
            'placeholder' => __('选择友情链接归档页面', 'io_setting'),
            'dependency'  => array( 'show_friendlink|links', '==|==', 'true|true' )
        ),
    )
));
//
// 内容设置
//
CSF::createSection( $prefix, array(
    'id'    => 'srticle_settings',
    'title' => __('内容设置','io_setting'),
    'icon'  => 'fa fa-file-text',
));
//
// 文章
//
CSF::createSection( $prefix, array(
    'parent'   => 'srticle_settings',
    'title'    => __('文章','io_setting'),
    'icon'     => 'fa fa-sitemap',
    'fields'   => array(  
        array(
            'id'         => 'article_module',
            'type'       => 'switcher',
            'title'      => __('首页显示文章模块','io_setting'),
            'label'      => __('头部启用文章模块','io_setting'),
            'default'    => false,
        ),
		array(
			'id'         => 'article_n',
			'type'       => 'spinner',
			'title'      => ' ┗━━ '.__('幻灯片数量','io_setting'),
            'max'        => 10,
            'min'        => 1,
            'step'       => 1,
            'default'    => 5,
            'after'      => __('显示置顶的文章，请把需要显示的文章置顶。','io_setting'),
            'dependency' => array( 'article_module', '==', true )
		),
        array(
            'id'          => 'two_article',
            'type'        => 'text',
            'title'       => ' ┗━━ '.__('两篇文章','io_setting'),
            'after'    	  => '<br>'.__('自定义文章模块中间的两篇文章，留空则随机展示。<br>填写两个文章id，用英语逗号分开，如：11,100','io_setting'),
            'dependency'  => array( 'article_module', '==', true ),
        ),
		array(
          'id'             => 'blog_pages',
          'type'           => 'select',
          'title'          => ' ┗━━ '.__('博客页面','io_setting'),
		  'after'    	   => __(' 如果没有，新建页面，选择“博客页面”模板并保存。<br>用于最新资讯旁边的“所有”按钮。','io_setting'),
          'options'        => 'pages',
          'query_args'     => array(
            'posts_per_page'  => -1,
          ),
		  'placeholder'    => __('选择一个页面', 'io_setting'),
		  'dependency'     => array( 'article_module', '==', true )
        ),
        array(
            'id'          => 'article_not_in',
            'type'        => 'text',
            'title'       => ' ┗━━ '.__('资讯列表排除分类','io_setting'),
            'after'    	  => '<br>'.__('填写分类id，用英语逗号分开，如：11,100<br>文章分类id列表：','io_setting').get_cats_id(),
            'dependency'  => array( 'article_module', '==', true ),
        ),
        array(
            'id'        => 'post_card_mode',
            'type'      => 'image_select',
            'title'     => __('文章卡片样式','io_setting'),
            'options'   => array(
                'card'    => get_theme_file_uri('/images/op-app-c-card.jpg'),
                'default' => get_theme_file_uri('/images/op-app-c-def.jpg'),
            ),
            'default'   => 'default',
        ),
    )
));
//
// 网址设置
//
CSF::createSection( $prefix, array(
    'parent'   => 'srticle_settings',
    'title'    => __('网址设置','io_setting'),
    'icon'     => 'fa fa-sitemap',
    'fields'   => array(  
        array(
            'id'        => 'site_card_mode',
            'type'      => 'image_select',
            'title'     => __('网址卡片样式','io_setting'),
            'options'   => array(
              'max'     => get_theme_file_uri('/images/op-site-c-max.jpg'),
              'default' => get_theme_file_uri('/images/op-site-c-def.jpg'),
              'min'     => get_theme_file_uri('/images/op-site-c-min.jpg'),
            ),
            'default'   => 'default',
			'after'   => __('选择首页网址块显示风格：大、中、小','io_setting'),
        ),
        array(
            'id'        => 'site_archive_n',
            'type'      => 'number',
            'title'     => __('网址分类页显示数量','io_setting'),
            'default'   => 30,
            'after'     => '填写需要显示的数量。<br>填写 0 为根据<a href="'.home_url().'/wp-admin/options-reading.php">系统设置数量显示</a>',
        ),
        array(
            'id'         => 'no_ico',
            'type'       => 'switcher',
            'title'      => __('无图标模式','io_setting'),
            'default'    => false,
        ),
    )
));
//
// app设置
//
CSF::createSection( $prefix, array(
    'parent'   => 'srticle_settings',
    'title'    => __('app设置','io_setting'),
    'icon'     => 'fa fa-shopping-bag',
    'fields'   => array( 
        array(
            'id'        => 'app_card_mode',
            'type'      => 'image_select',
            'title'     => __('app 卡片样式','io_setting'),
            'options'   => array(
              'card'    => get_theme_file_uri('/images/op-app-c-card.jpg'),
              'default' => get_theme_file_uri('/images/op-app-c-def.jpg'),
            ),
            'default'   => 'default',
			'after'   => __('选择首页app块显示风格','io_setting')
        ), 
        array(
            'id'        => 'app_archive_n',
            'type'      => 'number',
            'title'     => __('App 分类页显示数量','io_setting'),
            'default'   => 30,
            'after'     => '填写需要显示的数量。<br>填写 0 为根据<a href="'.home_url().'/wp-admin/options-reading.php">系统设置数量显示</a>',
        ),
        //array(
        //    'id'        => 'default_app_screen',
        //    'type'      => 'media',
        //    'title'     => __('app 默认截图','io_setting'),
        //    'add_title' => __('添加','io_setting'),
        //    'after'     => __('app截图为空时显示这项设置的内容','io_setting'),
        //    'default'   => array(
        //        'url'       => get_theme_file_uri('/screenshot.jpg'),
        //        'thumbnail' => get_theme_file_uri('/screenshot.jpg'),
        //    ),
        //),
    )
));
//
// 书籍设置
//
CSF::createSection( $prefix, array(
    'parent'   => 'srticle_settings',
    'title'    => __('书籍设置','io_setting'),
    'icon'     => 'fa fa-book',
    'fields'   => array(  
        array(
            'id'        => 'book_archive_n',
            'type'      => 'number',
            'title'     => __('书籍分类页显示数量','io_setting'),
            'default'   => 20,
            'after'     => '填写需要显示的数量。<br>填写 0 为根据<a href="'.home_url().'/wp-admin/options-reading.php">系统设置数量显示</a>',
        ),
    )
));

//
// 页脚设置
//
CSF::createSection( $prefix, array(
    'title'    => __('页脚设置','io_setting'),
    'icon'     => 'fa fa-caret-square-o-down',
    'fields'   => array( 
        array(
            'id'     => 'icp',
            'type'   => 'text',
            'title'  => __('备案号','io_setting'), 
            'subtitle'   => __('此选项“自定义页脚版权”非空则禁用','io_setting'),
            'dependency'  => array( 'footer_copyright', '==', '', '', 'visible' ),
        ),
        array(
            'id'     => 'police_icp',
            'type'   => 'text',
            'title'  => __('公安备案号','io_setting'), 
            'subtitle'   => __('此选项“自定义页脚版权”非空则禁用','io_setting'),
            'dependency'  => array( 'footer_copyright', '==', '', '', 'visible' ),
            'class'     => 'new'
        ),

        array(
            'id'          => 'footer_copyright',
            'type'        => 'wp_editor',
            'title'       => __('自定义页脚版权','io_setting'),
            'height'      => '100px',
            'sanitize'    => false,
        ),

        array(
            'id'            => 'footer_statistics',
            'type'          => 'wp_editor',
            'title'         => __('统计代码','io_setting'),
            'tinymce'       => false,
            'quicktags'     => true,
            'media_buttons' => false,
            'height'        => '100px',
            'sanitize'      => false,
            'after'         => '显示在页脚的统计代码，如需要添加到 &lt;/head&gt; 前，请到“添加代码”中添加。',
        ),

        array(
            'id'          => 'down_statement',
            'type'        => 'wp_editor',
            'title'       => __('下载页版权声明','io_setting'),
            'default'     => __('本站大部分下载资源收集于网络，只做学习和交流使用，版权归原作者所有。若您需要使用非免费的软件或服务，请购买正版授权并合法使用。本站发布的内容若侵犯到您的权益，请联系站长删除，我们将及时处理。','io_setting'),
            'height'      => '100px',
            'sanitize'    => false,
        ),
    )
));

//
// SEO设置
//
CSF::createSection( $prefix, array(
    'title'       => __('SEO设置','io_setting'),
    'icon'        => 'fa fa-paw',
    'description' => __('主题seo获取规则：<br>标题：页面、文章的标题<br>关键词：默认获取文章的标签，如果没有，则为标题加网址名称<br>描叙：默认获取文章简介','io_setting'),
    'fields'      => array(
        array(
            'id'     => 'seo_home_keywords',
            'type'   => 'text',
            'title'  => __('首页关键词','io_setting'),
            'after'  => '<br>'. __('其他页面如果获取不到关键词，默认调取此设置','io_setting'),
        ),
        array(
            'id'     => 'seo_home_desc',
            'type'   => 'textarea',
            'title'  => __('首页描述','io_setting'),
            'after'  => '<br>'. __('其他页面如果获取不到描述，默认调取此设置','io_setting'),
        ),
        array(
            'id'        => 'og_img',
            'type'      => 'media',
            'title'     => __('og 标签默认图片','io_setting'),
            'add_title' => __('上传','io_setting'),
            'after'     => __('QQ、微信分享时显示的缩略图<br>主题会默认获取文章、网址等内容的图片，但是如果内容没有图片，则获取此设置','io_setting'),
            'default'   => array(
                'url'       => get_theme_file_uri('/screenshot.jpg'),
                'thumbnail' => get_theme_file_uri('/screenshot.jpg'),
            ),
        ),
        array(
            'id'        => 'baidu_submit',
            'type'      => 'fieldset',
            'title'     => __('百度主动推送','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'switcher',
                    'type'  => 'switcher',
                    'title' => __('开启','io_setting'),
                ),	
				array(
					'id'       => 'token_p',
					'type'     => 'text',
					'title'    => __('推送token值','io_setting'),
					'after'    => '<br>'.__('输入百度主动推送token值','io_setting'),
					'dependency'   => array( 'switcher', '==', 'true' )
				), 
            ),
            'default'        => array(
                'switcher'    => false,
            ),
        ),
        array(
            'id'        => 'baidu_xzh',
            'type'      => 'fieldset',
            'title'     => __('百度熊掌号推送','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'switcher',
                    'type'  => 'switcher',
                    'title' => __('开启','io_setting'),
                ),
				array(
					'id'       => 'xzh_id',
					'title'    => __('熊掌号 appid','io_setting'),
					'type'     => 'text',
					'dependency'   => array( 'switcher', '==', 'true' )
				),
				array(
					'id'       => 'xzh_token',
					'title'    => __('熊掌号 token','io_setting'),
					'type'     => 'text',
					'dependency'   => array( 'switcher', '==', 'true' )
				),
            ),
            'default'        => array(
                'switcher'    => false,
            ),
        ),
        array(
            'id'          => 'sites_default_content',
            'type'        => 'switcher',
            'title'       => __('网址详情页默认内容开关','io_setting'),
            'desc'        => __('内容可在主题文件夹里的 templates\content-site.php 底部修改','io_setting'),
            'class'       => 'new',
        ),
        array(
            'id'        => 'tag_c',
            'type'      => 'fieldset',
            'title'     => __('自动为文章中的关键词添加链接','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'switcher',
                    'type'  => 'switcher',
                    'title' => __('开启','io_setting'),
                ),
				array(
					'id'         => 'chain_n',
					'title'      => __('链接数量','io_setting'),
					'default'    => '1',
					'type'       => 'number',
					'desc'       => __('一篇文章中同一个标签最多自动链接几次，建议不大于2','io_setting'),
					'dependency' => array( 'switcher', '==', 'true' ),
                ),
            ),
            'default'        => array(
                'switcher'    => true,
            ),
        ),                 
        array(
            'id'      => 'seo_linker',
            'type'    => 'text',
            'title'   => __('连接符','io_setting'),
            'after'   => '<br>'. __('一般用“-”“|”，如果需要左右留空，请自己左右留空格。','io_setting'),
            'default' => ' | ',
        ),
        array(
            'id'         => 'rewrites_types',
            'type'       => 'button_set',
            'title'      => __('固定链接模式','io_setting'),
            'subtitle'   => '<span style="color:#f00">'.__('设置后需重新保存一次固定链接','io_setting').'</span>',
            'options'    =>  array(
                'post_id'  => '/%post_id%/',
                'postname' => '/%postname%/',
            ),
            'default'    => 'post_id'
        ),
        array(
            'id'         => 'rewrites_end',
            'type'       => 'switcher',
            'title'      => __('html 结尾','io_setting'),
            'subtitle'   => '<span style="color:#f00">'.__('设置后需重新保存一次固定链接','io_setting').'</span>',
            'label'      => __('如：http://www.w.com/123.html','io_setting'),
            'default'    => true,
            'dependency'  => array( 'rewrites_types', '==', 'postname' ),
        ),
        array(
            'id'        => 'sites_rewrite',
            'type'      => 'fieldset',
            'title'     => '网址文章固定链接前缀',
            'subtitle'   => '<span style="color:#f00">'.__('设置后需重新保存一次固定链接','io_setting').'</span>',
            'fields'    => array(
                array(
                    'id'    => 'post',
                    'type'  => 'text',
                    'title' => '网址',
                ),
                array(
                    'id'    => 'taxonomy',
                    'type'  => 'text',
                    'title' => '网址分类',
                ),
                array(
                    'id'    => 'tag',
                    'type'  => 'text',
                    'title' => '网址标签',
                ),
            ),
            'default'        => array(
                'post'        => 'sites',
                'taxonomy'    => 'favorites',
                'tag'         => 'sitetag',
            ),
            'after'     => __('设置后需重新保存一次固定链接','io_setting'),
        ),
        array(
            'id'        => 'app_rewrite',
            'type'      => 'fieldset',
            'title'     => 'app文章固定链接前缀',
            'subtitle'   => '<span style="color:#f00">'.__('设置后需重新保存一次固定链接','io_setting').'</span>',
            'fields'    => array(
                array(
                    'id'    => 'post',
                    'type'  => 'text',
                    'title' => 'app',
                ),
                array(
                    'id'    => 'taxonomy',
                    'type'  => 'text',
                    'title' => 'app分类',
                ),
                array(
                    'id'    => 'tag',
                    'type'  => 'text',
                    'title' => 'app标签',
                ),
            ),
            'default'        => array(
                'post'        => 'app',
                'taxonomy'    => 'apps',
                'tag'         => 'apptag',
            ),
            'after'     => __('设置后需重新保存一次固定链接','io_setting'),
        ),
        array(
            'id'        => 'book_rewrite',
            'type'      => 'fieldset',
            'title'     => '书籍文章固定链接前缀',
            'subtitle'   => '<span style="color:#f00">'.__('设置后需重新保存一次固定链接','io_setting').'</span>',
            'fields'    => array(
                array(
                    'id'    => 'post',
                    'type'  => 'text',
                    'title' => '书籍',
                ),
                array(
                    'id'    => 'taxonomy',
                    'type'  => 'text',
                    'title' => '书籍分类',
                ),
                array(
                    'id'    => 'tag',
                    'type'  => 'text',
                    'title' => '书籍标签',
                ),
            ),
            'default'        => array(
                'post'        => 'book',
                'taxonomy'    => 'books',
                'tag'         => 'booktag',
            ),
            'after'     => __('设置后需重新保存一次固定链接','io_setting'),
        ),
    )
));
 
//
// 其他功能
//
CSF::createSection( $prefix, array(
    'title'  => __('其他功能','io_setting'),
    'icon'   => 'fa fa-flask',
    'fields' => array(
        array(
            'id'      => 'weather',
            'type'    => 'switcher',
            'title'   => __('天气','io_setting'),
            'label'   => __('显示天气小工具','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'weather_location',
            'type'    => 'radio',
            'title'   => __('天气位置','io_setting'),
            'default' => __('footer','io_setting'),
            'inline'  => true,
            'options' => array(
                'header'  => __('头部', 'io_setting'),
                'footer'  => __('右下小工具', 'io_setting'),
            ),
            'dependency' => array( 'weather', '==', true )
        ),
        array(
            'id'      => 'hitokoto',
            'type'    => 'switcher',
            'title'   => __('一言', 'io_setting'),
            'label'   => __('右上角显示一言', 'io_setting'),
            'default' => false,
        ),
        array(
            'id'         => 'is_iconfont',
            'type'       => 'switcher',
            'title'      => __('阿里图标', 'io_setting'),
            'label'      => __('fa 和阿里图标二选一，为轻量化资源，不能共用。', 'io_setting'),
            'default'    => false,
        ),
        array(
            'id'         => 'fa_cdn',
            'type'       => 'switcher',
            'title'      => ' ┗━━ '.__('fontawesome CDN', 'io_setting'),
            'label'      => __('fa图标库使用CDN，cdn地址修改请在 inc\register.php 文件里修改。默认 CDN 由 www.jsdelivr.com 提供', 'io_setting'),
            'default'    => false,
            'dependency' => array( 'is_iconfont', '==', false )
        ),
        array(
            'id'         => 'iconfont_url',  
            'type'       => 'text',
            'title'      => ' ┗━━ '.__('阿里图标库地址', 'io_setting'),
            'desc'       => '输入图标库在线链接，图标库地址：<a href="https://www.iconfont.cn/" target="_blank">--></a><br>教程地址：<a href="https://www.iowen.cn/webstack-pro-navigation-theme-iconfont/" target="_blank">--></a>',
            'dependency' => array( 'is_iconfont', '==', true )
        ),
        array(
            'id'      => 'is_publish',
            'type'    => 'switcher',
            'title'   => __('投稿直接发布', 'io_setting'),
            'label'   => __('游客投稿的“网址”不需要审核直接发布', 'io_setting'),
            'default' => false,
        ),
        array(
            'id'          => 'tougao_category',
            'type'        => 'select',
            'title'       => ' ┗━━ '.__('游客投稿分类', 'io_setting'),
            'after'       => '<br>'.__('不审核直接发布到指定分类，如果设置此项，前台投稿页的分类选择将失效。', 'io_setting'),
            'placeholder' => __('选择分类','io_setting'),
            'options'     => 'categories',
            'query_args'  => array(
                'taxonomy'    => array('favorites','apps'),
            ),
            'dependency'  => array( 'is_publish', '==', true )
        ),
        array(
            'id'         => 'publish_img_size',
			'type'       => 'spinner',
            'title'      => __('投稿图标大小', 'io_setting'),
            'after'      => __('默认64kb','io_setting'),
            'max'        => 128,
            'min'        => 16,
            'step'       => 2,
            'unit'       => 'kb',
            'default'    => 64,
        ),
        array(
            'type'    => 'submessage',
            'style'   => 'danger',
            'content' => __('邮件发信服务设置，如果你不需要评论邮件通知等功能，可不设置。<p>国内一般使用 SMTP 服务，<a href="https://www.iowen.cn/wordpress-mail-smtp-code/" target="_blank">设置方法</a></p>','io_setting'),
        ),
        
		array(
			'id'      => 'i_default_mailer',
			'type'    => 'radio',
			'title'   => 'SMTP/PHPMailer',
			'default' => 'php',
            'inline'  => true,
			'options' => array(
        		'php'   => 'PHP',
        		'smtp'  => 'SMTP'
        	),
			'after'    => __('使用SMTP或PHPMail作为默认邮件发送方式','io_setting'),
		),
		array(
			'id'         => 'i_smtp_host',
			'type'       => 'text',
			'title'      => __('SMTP 主机','io_setting'),
			'after'      => __('<br>您的 SMTP 服务主机','io_setting'),
			'dependency' => array( 'i_default_mailer', '==', 'smtp' )
		), 
		array(
			'id'         => 'i_smtp_port',
			'type'       => 'text',
			'title'      => __('SMTP 端口','io_setting'),
			'after'      => __('<br>您的 SMTP 服务端口','io_setting'),
			'default'    => 465,
			'dependency' => array( 'i_default_mailer', '==', 'smtp' )
		), 
		array(
			'id'       => 'i_smtp_secure',
			'type'     => 'radio',
			'title'    => __('SMTP 安全','io_setting'),
			'after'    => __('<br>您的 SMTP 服务器安全协议','io_setting'),
			'default'  => 'ssl',
            'inline'   => true,
			'options'  => array(
        		'auto'   => 'Auto',
        		'ssl'    => 'SSL',
        		'tls'    => 'TLS',
        		'none'   => 'None'
			),
			'dependency'   => array( 'i_default_mailer', '==', 'smtp' )
		), 
		array(
			'id'      => 'i_smtp_username',
			'type'    => 'text',
			'title'   => __('SMTP 用户名','io_setting'),
			'after'   => __('<br>您的 SMTP 用户名','io_setting'),
			'dependency'   => array( 'i_default_mailer', '==', 'smtp' )
		),  
		array(
			'id'      => 'i_smtp_password',
			'type'    => 'text',
			'title'   => __('SMTP 密码','io_setting'),
			'after'   => __('<br>您的 SMTP 密码','io_setting'),
			'dependency'   => array( 'i_default_mailer', '==', 'smtp' )
		),  
		array(
			'id'      => 'i_smtp_name',
			'type'    => 'text',
			'title'   => __('你的姓名','io_setting'),
			'default' => '一为',
			'after'   => __('<br>你发送的邮件中显示的名称','io_setting'),
			'dependency'   => array( 'i_default_mailer', '==', 'smtp' ), 
		),  
		array(
			'id'         => 'i_mail_custom_sender',
			'type'       => 'text',
			'title'      => __('PHP Mail 发信人姓名','io_setting'),
			'default'    => '一为',
			'after'      => __('<br>使用 PHPMailer 发送邮件的显示名称','io_setting'),
			'dependency' => array( 'i_default_mailer', '==', 'php' )
		),  
		array(
			'id'         => 'i_mail_custom_address',
			'type'       => 'text',
			'title'      => __('PHP Mail 发信人地址','io_setting'),
			'after'      => __('<br>当使用 PHPMailer 发信时可使用自定义的发信人地址','io_setting'),
			'dependency' => array( 'i_default_mailer', '==', 'php' )
        ), 
        
        array(
            'type'    => 'submessage',
            'style'   => 'danger',
            'content' => __('下面的功能尽量不要动，出问题了点击上方“重置部分”重置此页设置','io_setting'),
        ),
        array(
            'id'      => 'ico-source',
            'type'    => 'fieldset',
            'title'   => __('图标源设置','io_setting'),
            'subtitle'   => __('自建图标源api源码地址：','io_setting').'<a href="https://api.iowen.cn/favicon" target="_blank">--></a>',
            'fields'  => array(
                array(
                    'id'      => 'url_format',
                    'type'    => 'switcher',
                    'title'   => __('不包含 http(s)://','io_setting'),
                    'default' => true,
                    'subtitle'    => __('根据图标源 api 要求设置，如果api要求不能包含协议名称，请开启此选项','io_setting'),
                ),
                array(
                    'id'      => 'ico_url',
                    'type'    => 'text',
                    'title'   => __('图标源','io_setting'),
                    'default' => 'https://api.iowen.cn/favicon/',
                    'subtitle'    => __('api 地址','io_setting'),
                ),
                array(
                    'id'      => 'ico_png',
                    'type'    => 'text',
                    'title'   => __('图标源api后缀','io_setting'),
                    'default' => '.png',
                    'subtitle'=> __('如：.png ,请根据api格式要求设置，如不需要请留空','io_setting'),
                ),
            ),
        ),
        array(
            'id'         => 'qr_url',
            'type'       => 'text',
            'title'      => __('二维码api','io_setting'),
            'subtitle'   => __('可用二维码api源地址：','io_setting').'<a href="https://www.iowen.cn/latest-qr-code-api-service-https-available/" target="_blank">--></a>',
            'default'    => '//api.qrserver.com/v1/create-qr-code/?size=$sizex$size&margin=10&data=$url',
            'after'      => '<br>参数：<br>$size 大小 <br>$url  地址 <br>如：s=$size<span style="color: #ff0000;">x</span>$size 、 size=$size 、 width=$size&height=$size<br><br>默认内容：//api.qrserver.com/v1/create-qr-code/?size=$sizex$size&margin=10&data=$url',
        ),
        array(
            'id'         => 'random_head_img',
            'type'       => 'textarea',
            'title'      => __('博客随机头部图片','io_setting'),
            'subtitle'   => __('缩略图、文章页随机图片','io_setting'),
            'after'      => __('一行一个图片地址，注意不要有空格<br>默认内容：','io_setting').'<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/1.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/2.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/3.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/4.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/5.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/6.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/7.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/8.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/9.jpg<br>https://gitee.com/iowen/ioimg/raw/master/screenshots/0.jpg',
            'default'    => 'https://gitee.com/iowen/ioimg/raw/master/screenshots/1.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/2.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/3.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/4.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/5.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/6.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/7.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/8.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/9.jpg'.PHP_EOL.'https://gitee.com/iowen/ioimg/raw/master/screenshots/0.jpg',
        ),
    )
));

//
// 添加代码
//
CSF::createSection( $prefix, array(
    'title'       => '添加代码',
    'icon'        => 'fa fa-code',
    'fields'      => array(
        array(
            'id'       => 'header_html',
            'type'     => 'code_editor',
            'title'    => '添加顶部代码',
            'subtitle' => '显示在网站 &lt;body&gt;里',
            'after'    => '<p class="cs-text-muted">'.__('；不想写说明'),
            'settings' => array(
                'tabSize' => 2,
                'theme'   => 'dracula',
                'mode'    => 'css',
            ),
            'sanitize' => false,
          ),
        array(
            'id'       => 'custom_css',
            'type'     => 'code_editor',
            'title'    => '自定义样式css代码',
            'subtitle' => '显示在网站头部 &lt;head&gt;',
            'after'    => '<p class="cs-text-muted">'.__('自定义 CSS,自定义美化...<br>如：','io_setting').'body .test{color:#ff0000;}<br><span style="color:#f00">'.__('注意：','io_setting').'</span>'.__('不要填写','io_setting').'<strong>&lt;style&gt; &lt;/style&gt;</strong></p>',
            'settings' => array(
                'tabSize' => 2,
                'theme'   => 'mbo',
                'mode'    => 'css',
            ),
            'sanitize' => false,
        ),
        array(
            'id'       => 'code_2_header',
            'type'     => 'code_editor',
            'title'    => '顶部(header)自定义 js 代码',
            'subtitle' => '显示在网站底部',
            'after'    => '<p class="cs-text-muted">'.__('出现在网站顶部 &lt;/head&gt; 前。','io_setting').'<br><span style="color:#f00">'.__('注意：','io_setting').'</span>'.__('必须填写','io_setting').'<strong>&lt;script&gt; &lt;/script&gt;</strong></p>',
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize' => false,
            'class'   => '',
        ),
        array(
            'id'       => 'code_2_footer',
            'type'     => 'code_editor',
            'title'    => '底部(footer)自定义 js 代码',
            'subtitle' => '显示在网站底部',
            'after'    => '<p class="cs-text-muted">'.__('出现在网站底部 body 前。','io_setting').'<br><span style="color:#f00">'.__('注意：','io_setting').'</span>'.__('必须填写','io_setting').'<strong>&lt;script&gt; &lt;/script&gt;</strong></p>',
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize' => false,
        ),
    )
));

//
// 广告位
//
CSF::createSection( $prefix, array(
    'id'    => 'add-ad',
    'title' => __('添加广告','io_setting'),
    'icon'  => 'fa fa-google',
));
//
// 弹窗轮播
//
CSF::createSection( $prefix, array(
    'parent'      => 'add-ad',
    'title'       => __('弹窗轮播','io_setting'),
    'icon'        => 'fas fa-solar-panel',
    'fields'      => array(
        array(
            'id'    => 'enable_popup',
            'type'  => 'switcher',
            'title' => __('启用弹窗','io_setting'),
            'class'     => 'new',
        ),
        array(
            'id'        => 'popup_set',
            'type'      => 'fieldset',
            'title'     => __('全局弹窗','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'delay',
                    'type'  => 'spinner',
                    'title' => __('延时','io_setting'),
                    'after' => __('延时多少秒后显示弹窗','io_setting'),
                    'unit'  => '秒',
                    'step'  => 1,
                ),
                array(
                    'id'    => 'show',
                    'type'  => 'switcher',
                    'title' => __('显示一次','io_setting'),
                    'label' => __('同一个游客id一天只显示一次','io_setting'),
                ),
                array(
                    'id'    => 'logged_show',
                    'type'  => 'switcher',
                    'title' => __('登录用户只显示一次','io_setting'),
                    'label' => __('同一个用户登录有效期只显示一次','io_setting'),
                ),
                array(
                    'id'    => 'update_date',
                    'type'  => 'date',
                    'title' => '┗━━'.__('公告日期','io_setting'),
                    'settings' => array(
                        'dateFormat'      => 'yy-mm-dd',
                        'changeMonth'     => true,
                        'changeYear'      => true, 
                        'showButtonPanel' => true,
                    ),
                    'after' => __('用于登录用户判断是否有更新（不会显示在弹窗里）','io_setting'),
                    'dependency' => array( 'logged_show', '==', 'true' ),
                ),
                array(
                    'id'         => 'title',
                    'type'       => 'text',
                    'title'      => __('标题','io_setting'), 
                    'subtitle'   => __('留空不显示','io_setting'),
                ),
                array(
                    'id'          => 'content',
                    'type'        => 'wp_editor',
                    'title'       => __('弹窗内容','io_setting'),
                    'height'      => '100px',
                    'sanitize'    => false,
                    'after'       => '如果a标签想关闭弹窗，请添加class:  popup-close',
                ),
                array(
                    'id'      => 'width',
                    'type'    => 'slider',
                    'title'   => '宽度',
                    'class'   => 'new',
                    'min'     => 340,
                    'max'     => 1024,
                    'step'    => 10,
                    'unit'    => 'px',
                ),
                array(
                    'id'    => 'valid',
                    'type'  => 'switcher',
                    'title' => __('有效期','io_setting'),
                    'label' => __('设置弹窗有效期','io_setting'),
                ),
                array(
                    'id'    => 'begin_time',
                    'type'  => 'date',
                    'title' => __('开始时间','io_setting'),
                    'settings' => array(
                        'dateFormat'      => 'yy-mm-dd',
                        'changeMonth'     => true,
                        'changeYear'      => true, 
                        'showButtonPanel' => true,
                    ),
                    'dependency' => array( 'valid', '==', 'true' ),
                ), 
                array(
                    'id'    => 'end_time',
                    'type'  => 'date',
                    'title' => __('结束时间','io_setting'),
                    'settings' => array(
                        'dateFormat'      => 'yy-mm-dd',
                        'changeMonth'     => true,
                        'changeYear'      => true, 
                        'showButtonPanel' => true,
                    ),
                    'dependency' => array( 'valid', '==', 'true' ),
                ), 
            ),
            'default'        => array(
                'delay'         => 0,
                'show'          => true,
                'update_date'   => date('Y-m-d'),
                'begin_time'    => date('Y-m-d'),
                'end_time'      => date("Y-m-d", strtotime("+10 day")),
                'width'         => 560,
            ),
            'dependency'  => array( 'enable_popup', '==', 'true', '', 'visible' ),
        ),
        //TODO 待加轮播
    )
));
//
// 首页广告
//
CSF::createSection( $prefix, array(
    'parent'      => 'add-ad',
    'title'       => __('首页广告','io_setting'),
    'icon'        => 'fa fa-google',
    'fields'      => array(
        array(
            'id'      => 'ad_home_s',
            'type'    => 'switcher',
            'title'   => __('首页顶部广告位','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'ad_home_mobile',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '. __('首页顶部广告位在移动端显示','io_setting'),
            'default' => false,
			'dependency' => array( 'ad_home_s', '==', true )
        ),
        array(
            'id'      => 'ad_home_s2',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '. __('首页顶部广告位2','io_setting'),
            'label'   => __('大屏并排显示2个广告位，小屏幕自动隐藏','io_setting'),
            'default' => false,
			'dependency' => array( 'ad_home_s', '==', true )
        ),
        array(
            'id'         => 'ad_home',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('首页顶部广告位内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_home_s', '==', true )
        ),
        array(
            'id'         => 'ad_home2',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('首页顶部广告位2内容','io_setting'),
            'subtitle'   => __('首页顶部第二个广告位的内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_home_s|ad_home_s2', '==|==', 'true|true' )
        ),


        array(
            'id'      => 'ad_home_s_second',
            'type'    => 'switcher',
            'title'   => __('首页网址块上方广告位','io_setting'),
            'label'   => __('网址块上方广告位','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'ad_home_mobile_second',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '. __('在移动端显示','io_setting'),
            'default' => false,
			'dependency' => array( 'ad_home_s_second', '==', true )
        ),
        array(
            'id'      => 'ad_home_s2_second',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '. __('广告位2','io_setting'),
            'label'   => __('大屏并排显示2个广告位，小屏幕自动隐藏','io_setting'),
            'default' => false,
			'dependency' => array( 'ad_home_s_second', '==', true )
        ),
        array(
            'id'         => 'ad_home_second',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('广告位内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_home_s_second', '==', true )
        ),
        array(
            'id'         => 'ad_home2_second',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('广告位2内容','io_setting'),
            'subtitle'   => __('第二个广告位的内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_home_s_second|ad_home_s2_second', '==|==', 'true|true' )
        ),


        array(
            'id'      => 'ad_home_s_link',
            'type'    => 'switcher',
            'title'   => __('友链上方广告位','io_setting'),
            'label'   => __('首页底部友链上方广告位','io_setting'),
            'default' => false,
        ),
        array(
            'id'      => 'ad_home_mobile_link',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '. __('在移动端显示','io_setting'),
            'default' => false,
			'dependency' => array( 'ad_home_s_link', '==', true )
        ),
        array(
            'id'      => 'ad_home_s2_link',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '. __('友链上方广告位2','io_setting'),
            'label'   => __('大屏并排显示2个广告位，小屏幕自动隐藏','io_setting'),
            'default' => false,
			'dependency' => array( 'ad_home_s_link', '==', true )
        ),
        array(
            'id'         => 'ad_home_link',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('友链上方广告位内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_home_s_link', '==', true )
        ),
        array(
            'id'         => 'ad_home2_link',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('友链上方广告位2内容','io_setting'),
            'subtitle'   => __('第二个广告位的内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_home_s_link|ad_home_s2_link', '==|==', 'true|true' )
        ),



        array(
            'id'      => 'ad_footer_s',
            'type'    => 'switcher',
            'title'   => 'footer 广告位',
            'label'   => __('全站 footer 位广告','io_setting'),
            'default' => false,
        ),
        array(
            'id'         => 'ad_footer',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('footer 广告位内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_footer_s', '==', true )
        ),
    )
));
//
// 文章广告
//
CSF::createSection( $prefix, array(
    'parent'      => 'add-ad',
    'title'       => __('文章广告','io_setting'),
    'icon'        => 'fa fa-google',
    'fields'      => array(
        array(
            'id'      => 'ad_right_s',
            'type'    => 'switcher',
            'title'   => __('详情页右边广告位','io_setting'),
            'default' => false,
        ),
        array(
            'id'         => 'ad_right',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('详情页右边广告位内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/screenshot.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_right_s', '==', true )
        ),
        array(
            'id'      => 'ad_app_s',
            'type'    => 'switcher',
            'title'   => __('网址、app正文上方广告位','io_setting'),
            'default' => true,
        ),
        array(
            'id'         => 'ad_app',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ '. __('网址、下载、app详情页正文上方广告位内容','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
			'dependency' => array( 'ad_app_s', '==', true )
        ),
        array(
            'id'         => 'ad_po',
            'type'       => 'code_editor',
            'title'      => __('文章内广告短代码','io_setting'),
            'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'sanitize'   => false,
            'subtitle'   => __('在文章中添加短代码 [ad] 即可调用','io_setting'),
        ),
		array(
			'id'         => 'ad_s_title',
			'title'      => __('正文标题广告位','io_setting'),
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_s_title_c',
			'title'      => ' ┗━━ '. __('输入正文标题广告代码','io_setting'),
			'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
            'sanitize'   => false,
			'dependency' => array( 'ad_s_title', '==', true )
		),
		array(
			'id'         => 'ad_s_b',
			'title'      => __('正文底部广告位','io_setting'),
			'default'    => '0',
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_s_b_c',
			'title'      => ' ┗━━ '. __('输入正文底部广告代码','io_setting'),
			'desc'       => '',
			'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
            'sanitize'   => false,
			'dependency' => array( 'ad_s_b', '==', true )
		),
		array(
			'id'         => 'ad_c',
			'title'      => __('评论上方广告位','io_setting'),
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_c_c',
			'title'      => ' ┗━━ '. __('输入评论上方广告代码','io_setting'),
			'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
            'sanitize'   => false,
			'dependency' => array( 'ad_c', '==', true )
		),
		array(
			'id'         => 'ad_down_popup_s',
			'title'      => __('下载弹窗广告位','io_setting'),
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_down_popup',
			'title'      => ' ┗━━ '. __('下载弹窗广告代码','io_setting'),
			'default'    => '<a href="https://www.iowen.cn/wordpress-version-webstack/" target="_blank"><img src="' . get_theme_file_uri('/images/ad.jpg').'" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
            'sanitize'   => false,
			'dependency' => array( 'ad_down_popup_s', '==', true )
		),
    )
));

//
// 优化设置
//
CSF::createSection( $prefix, array(
    'id'    => 'optimize',
    'title' => __('优化设置','io_setting'),
    'icon'  => 'fa fa-rocket',
));
  
//
// 禁用功能
//
CSF::createSection( $prefix, array(
    'parent'      => 'optimize',
    'title'       => __('禁用功能','io_setting'),
    'icon'        => 'fa fa-wordpress',
    'fields'      => array(

        array(
            'type'    => 'notice',
            'style'   => 'warning',
            'content' => '<li style="font-size:18px;color: red">'.__('如果不了解下面选项的作用，请保持原样！','i_theme').'</li>',
        ),
		array(
			'id'      => 'disable_rest_api',
			'type'    => 'switcher',
			'title'   => __('禁用REST API','io_setting'),
			'label'   => __('禁用REST API、移除wp-json链接（默认关闭，如果你的网站没有做小程序或是APP，建议禁用REST API）','io_setting'),
			'default' => false
		),
 
        
        array(
            'id'      => 'diable_revision',
            'type'    => 'switcher',
            'title'   => __('禁用文章修订功能','io_setting'),
            'label'   => __('禁用文章修订功能，精简 Posts 表数据。','io_setting'),
            'default' => false
        ),
 
        
        array(
            'id'      => 'disable_texturize',
            'type'    => 'switcher',
            'title'   => __('禁用字符转码','io_setting'),
            'label'   => __('禁用字符换成格式化的 HTML 实体功能。','io_setting'),
            'default' => true
        ),

		array(
			'id'      => 'disable_feed',
			'type'    => 'switcher',
			'title'   => __('禁用站点Feed','io_setting'),
			'label'   => __('禁用站点Feed，防止文章快速被采集。','io_setting'),
			'default' => true
		),

        array(
            'id'      => 'disable_trackbacks',
            'type'    => 'switcher',
            'title'   => __('禁用Trackbacks','io_setting'),
            'label'   => __('Trackbacks协议被滥用，会给博客产生大量垃圾留言，建议彻底关闭Trackbacks。','io_setting'),
            'default' => true
        ),

        array(
            'id'      => 'disable_gutenberg',
            'type'    => 'switcher',
            'title'   => __('禁用古腾堡编辑器','io_setting'),
            'label'   => __('禁用Gutenberg编辑器，换回经典编辑器。','io_setting'),
            'default' => true
        ),

        array(
            'id'      => 'disable_xml_rpc',
            'type'    => 'switcher',
            'title'   => ' ┗━━ '.__('禁用XML-RPC','io_setting'),
            'label'   => __('XML-RPC协议用于客户端发布文章，如果你只是在后台发布，可以关闭XML-RPC功能。Gutenberg编辑器需要XML-RPC功能。','io_setting'),
            'default' => false,
			'dependency' => array( 'disable_gutenberg', '==', true )
        ),

        array(
            'id'      => 'disable_privacy',
            'type'    => 'switcher',
            'title'   => __('禁用后台隐私（GDPR）','io_setting'),
            'label'   => __('GDPR（General Data Protection Regulation）是欧洲的通用数据保护条例，WordPress为了适应该法律，在后台设置很多隐私功能，如果只是在国内运营博客，可以移除后台隐私相关的页面。','io_setting'),
            'default' => false
        ),
        array(
            'id'      => 'emoji_switcher',
            'type'    => 'switcher',
            'title'   => __('禁用emoji代码','io_setting'),
            'label'   => __('WordPress 为了兼容在一些比较老旧的浏览器能够显示 Emoji 表情图标，而准备的功能。','io_setting'),
            'default' => true
        ),
        array(
            'id'      => 'disable_autoembed',
            'type'    => 'switcher',
            'title'   => __('禁用Auto Embeds','io_setting'),
            'label'   => __('禁用 Auto Embeds 功能，加快页面解析速度。 Auto Embeds 支持的网站大部分都是国外的网站，建议禁用。','io_setting'),
            'default' => true
        ),
        array(
            'id'      => 'disable_post_embed',
            'type'    => 'switcher',
            'title'   => __('禁用文章Embed','io_setting'),
            'label'   => __('禁用可嵌入其他 WordPress 文章的Embed功能','io_setting'),
            'default' => false
        ),
        array(
            'id'      => 'remove_dns_prefetch',
            'type'    => 'switcher',
            'title'   => __('禁用s.w.org','io_setting'),
            'label'   => __('移除 WordPress 头部加载 DNS 预获取（s.w.org 国内根本无法访问）','io_setting'),
            'default' => false
        ),
    )
));

//
// 优化加速
//
CSF::createSection( $prefix, array(
    'parent'      => 'optimize',
    'title'       => __('优化加速','io_setting'),
    'icon'        => 'fa fa-envira',
    'fields'      => array(

        array(
            'type'    => 'notice',
            'style'   => 'warning',
            'content' => '<li style="font-size:18px;color: red">'.__('如果不了解下面选项的作用，请保持原样！','i_theme').'</li>',
        ),
        //array(
        //    'id'     => 'vpc_ip',
        //    'type'   => 'text',
        //    'title'  => __('解决WordPress 429','io_setting'),
        //    'after'  => '<br>'. __('如果需要，请填写 47.75.163.183:3128 感谢 wbolt 提供的服务器','io_setting'),
        //),
        array(
            'id'      => 'remove_head_links',
            'type'    => 'switcher',
            'title'   => __('移除头部代码','io_setting'),
            'label'   => __('WordPress会在页面的头部输出了一些link和meta标签代码，这些代码没什么作用，并且存在安全隐患，建议移除WordPress页面头部中无关紧要的代码。','io_setting'),
            'default' => true
        ),

        array(
            'id'      => 'remove_admin_bar',
            'type'    => 'switcher',
            'title'   => __('移除admin bar','io_setting'),
            'label'   => __('WordPress用户登陆的情况下会出现Admin Bar，此选项可以帮助你全局移除工具栏，所有人包括管理员都看不到。','io_setting'),
            'default' => true
        ),
		array(
			'id'      => 'ioc_category',
			'type'    => 'switcher',
			'title'   => __('去除分类标志','io_setting'),
			'label'   => __('去除链接中的分类category标志，有利于SEO优化，每次开启或关闭此功能，都需要重新保存一下固定链接！','io_setting'),
			'default' => true
		),
		//array(
		//	'id'      => 'locale',
		//	'type'    => 'switcher',
		//	'title'   => __('前台不加载语言包','io_setting'),
		//	'label'   => __('前台不加载语言包，节省加载语言包所需的0.1-0.5秒。','io_setting'),
		//	'default' => false
		//),

        array(
            'id'      => 'gravatar',
            'type'    => 'select',
            'title'   => 'Gravatar加速',
            'default' => 'geekzu',
            'options' => array(
                'garav'    => __('使用Gravatar默认服务器','io_setting'),
                'v2ex'     => __('使用v2ex镜像加速服务','io_setting'),
                'chinayes' => __('使用wp-china-yes.cn镜像加速服务','io_setting'),
                'geekzu'   => __('使用极客族提供的Gravatar加速服务','io_setting'),
            ),
        ),
		array(
			'id'      => 'remove_help_tabs',
			'type'    => 'switcher',
			'title'   => __('移除帮助按钮','io_setting'),
			'label'   => __('移除后台界面右上角的帮助','io_setting'),
			'default' => false
		),
		array(
			'id'      => 'remove_screen_options',
			'type'    => 'switcher',
			'title'   => __('移除选项按钮','io_setting'),
			'label'   => __('移除后台界面右上角的选项','io_setting'),
			'default' => false
		),
		array(
			'id'      => 'no_admin',
			'type'    => 'switcher',
			'title'   => __('禁用 admin','io_setting'),
			'label'   => __('禁止使用 admin 用户名尝试登录 WordPress。','io_setting'),
			'default' => false
		),
		array(
			'id'      => 'compress_html',
			'type'    => 'switcher',
			'title'   => __('压缩 html 源码','io_setting'),
			'label'   => __('压缩网站源码，提高加载速度。（如果启用发现网站布局错误，请禁用。）','io_setting'),
			'default' => false
		),
    )
));
 
//
// 安全设置
//
CSF::createSection( $prefix, array(
    'title'       => '安全设置',
    'icon'        => 'fa fa-shield',
    'fields'      => array(
        array(
            'id'        => 'io_administrator',
            'type'      => 'fieldset',
            'title'     => '禁止冒充管理员留言',
            'fields'    => array(
                array(
                    'id'         => 'admin_name',
                    'type'       => 'text',
                    'title'      => __('管理员名称','io_setting'),
                ),
                array(
                    'id'         => 'admin_email',
                    'type'       => 'text',
                    'title'      => __('管理员邮箱','io_setting'),
                ),
            ),
            'default'  => array(
                'admin_email'    => get_option( 'admin_email' ),
            ),
        ),
        array(
            'id'        => 'io_comment_set',
            'type'      => 'fieldset',
            'title'     => '评论过滤',
            'fields'    => array(
                array(
                    'id'         => 'no_url',
                    'type'       => 'switcher',
                    'title'      => __('评论禁止链接','io_setting'),
                ),
                array(
                    'id'         => 'no_chinese',
                    'type'       => 'switcher',
                    'title'      => __('评论必须包含汉字','io_setting'),
                ),
            ),
            'default'  => array(
                'no_url'        => true,
                'no_chinese'    => false,
            ),
        ),
        array(
            'id'        => 'io_captcha',
            'type'      => 'fieldset',
            'title'     => '腾讯防水墙',
            'subtitle'  => '<span style="color:#f00">开启后，请认真填写，填错会造成无法登陆后台</span>',
            'fields'    => array(
				array(
					'id'    	=> 'tcaptcha_007',
					'type'      => 'switcher',
					'title'     => __('启用腾讯防水墙','io_setting'),
					'desc'      => __('在登录页、投稿、评论等低添加验证，提升安全性','io_setting'),
				),	
				array(
					'id'    	=> 'appid_007',
					'type'      => 'text',
					'title'     => __('腾讯防水墙 App ID','io_setting'),
					'dependency'=> array( 'tcaptcha_007', '==', 'true' ),
				),	
				array(
					'id'    	=> 'appsecretkey_007',
					'type'      => 'text',
					'title'     => __('腾讯防水墙 App Secret Key','io_setting'),
					'after'     => __('请填写完整，包括后面的**','io_setting'),
					'dependency'=> array( 'tcaptcha_007', '==', 'true' ),
				),	
				array(
					'type'    => 'subheading',
					'content' => __('App ID 申请地址：','io_setting').'<a href="https://cloud.tencent.com/login?s_url=https%3A%2F%2Fconsole.cloud.tencent.com%2Fcaptcha" target="_blank">防水墙</a>',
					'dependency'=> array( 'tcaptcha_007', '==', 'true' ),
				),
				array(
					'id'    	=> 'comment_007',
					'type'      => 'switcher',
					'title'     => __('评论开启验证','io_setting'),
					'dependency'=> array( 'tcaptcha_007', '==', 'true' ),
				),
            ),
            'default'  => array(
                'tcaptcha_007'   => false, 
            ),
        ), 
    )
));

//
// 社交登录
//
CSF::createSection( $prefix, array(
    'title'  => __('社交登录','io_setting'),
    'icon'   => 'fa fa-share-alt-square',
    'fields' => array(
        array(
            'id'         => 'open_qq',
            'type'       => 'switcher',
            'title'      => __('qq登录','io_setting'),
            'label'   => '回调地址：'.get_template_directory_uri().'/inc/auth/qq-callback.php',
            'subtitle'      => '接口申请：https://connect.qq.com', 
        ),
        array(
            'id'        => 'open_qq_key',
            'type'      => 'fieldset',
            'title'     => __('参数设置','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'appid',
					'type'  => 'text', 
                    'title' => 'APPID',
                ),	
				array(
					'id'       => 'appkey',
					'type'     => 'text',
					'title'    => 'APPKEY',
				), 
            ),
			'dependency'   => array( 'open_qq', '==', 'true' ),
        ),
        array(
            'id'         => 'open_weibo',
            'type'       => 'switcher',
            'title'      => __('微博登录','io_setting'),
            'label'      => '回调地址：'.get_template_directory_uri().'/inc/auth/sina-callback.php',
            'subtitle'      => '接口申请：http://open.weibo.com', 
        ),
        array(
            'id'        => 'open_weibo_key',
            'type'      => 'fieldset',
            'title'     => __('参数设置','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'appid',
					'type'  => 'text', 
                    'title' => 'APPID',
                ),	
				array(
					'id'       => 'appkey',
					'type'     => 'text',
					'title'    => 'APPSECRET',
				), 
            ),
			'dependency'   => array( 'open_weibo', '==', 'true' ),
        ),
        array(
            'id'         => 'open_wechat',
            'type'       => 'switcher',
            'title'      => __('微信登录','io_setting'),
            'subtitle'      => '接口申请：https://open.weixin.qq.com', 
        ),
        array(
            'id'        => 'open_wechat_key',
            'type'      => 'fieldset',
            'title'     => __('参数设置','io_setting'),
            'fields'    => array(
                array(
                    'id'    => 'appid',
					'type'  => 'text', 
                    'title' => 'APPID',
                ),	
				array(
					'id'       => 'appkey',
					'type'     => 'text',
					'title'    => 'APPSECRET',
				), 
            ),
			'dependency'   => array( 'open_wechat', '==', 'true' ),
        ),
        array(
            'id'         => 'open_login_url',  
            'type'       => 'text',
            'title'      => __('登录后返回地址', 'io_setting'),
            'desc'       => '登录后返回的地址，一般是首页或者个人中心页',
			'default'    => home_url(),
        ),
    )
));


//
// 备份
//
CSF::createSection( $prefix, array(
    'title'       => __('备份设置','io_setting'),
    'icon'        => 'fa fa-undo',
    'description' => __('仅能保存主题设置，不能保存整站数据。（此操作可能会清除设置数据，请谨慎操作）','io_setting'),
    'fields'      => array( 

        // 备份
        array(
            'type' => 'backup',
        ),
    )
));

