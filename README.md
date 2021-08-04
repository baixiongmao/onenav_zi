# 介绍
本项目是[OneNav](https://www.iotheme.cn/?aff=100057)（v3.0731）子主题

本主题是免费项目，请勿用于贩卖销售

## 功能

1. 主题后台增加另外的代码添加框

   位置

   ```
   添加代码-->添加顶部代码
   ```

   代码

   ```php
   <?php echo io_get_option('header_html');?>
   ```

   详情截图

   ![添加顶部代码截图](img/2021_08_02_1.png)

   在此代码框输入页面结构，样式请添加在主题`自定义样式css代码`框内

   注意

   ```
   内容在用户未登录时显示，用户登陆后不加载，适用于添加提示用户登录代码
   ```

2. 更多功能待增加

## 功能代码示例

## 添加提示登录代码

#### 添加顶部代码

```php
<div class="bottom-fixed-tips" id="dv">
				<div class="bottom-fixed-tips-container">
					<i class="iconfont icon-huojian"></i>
					<div class="bottom-fixed-tips-text">一键登录，云同步你的书签！</div>
					<a href="/login/" target="_blank" class="bottom-fixed-tips-btn bottom-fixed-tips-login">立即登录</a>
					<a id="btn"  class="iconfont icon-close bottom-fixed-tips-close"></a>
				</div>
			</div>
```

#### 自定义样式css代码

```css
.bottom-fixed-tips{position:fixed;box-sizing:border-box;width:100%;bottom:0;background-color:black;background-repeat:no-repeat;background-size:cover;background-position:center;z-index:99999}.bottom-fixed-tips-container{width:92%;max-width:1300px;margin:0 auto;text-align:center;font-size:0;padding:12px 0;overflow:hidden;position:relative}.bottom-fixed-tips .icon-huojian{color:#fff;font-size:24px;display:inline-block;height:32px;line-height:32px;vertical-align:middle}.iconfont{font-family:"iconfont" !important;font-size:16px;font-style:normal;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.bottom-fixed-tips .bottom-fixed-tips-text{display:inline-block;color:#fff;font-size:18px;font-weight:700;vertical-align:middle;margin-left:8px}.bottom-fixed-tips .bottom-fixed-tips-btn{display:inline-block;height:32px;width:90px;background-color:#1d74f5;color:#fff;vertical-align:middle;margin-left:16px;border-radius:4px;line-height:32px;text-align:center;font-size:16px}.bottom-fixed-tips .bottom-fixed-tips-close{position:absolute;right:0;top:12px;font-size:20px;color:rgba(255,255,255,.7);cursor:pointer}*{-webkit-tap-highlight-color:transparent;-webkit-appearance:none}
```

#### 底部(footer)自定义 js 代码

```
<script type="text/javascript">function my(a){return document.getElementById(a)}my("btn").onclick=function(){my("dv").style.display="none"}</script>
```

