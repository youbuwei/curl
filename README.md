使用Curl实现特定数据抓取
# Demo #
<a href="http://youbuwei.github.com/Curl/" target="_blank">前往项目主页</a>

# 介绍 #

这是一个使用Curl实现页面数据的抓取的小工具。
示例中已经实现了对天猫，京东商城商品的名称，价格，图片的抓取。
你可以添加更多的规则以实现对其他网站的数据抓取

# 文件解释 #

dataParse.php 为核心类，封装了功能实现的业务逻辑，其中对于天猫数据有特别的处理，请留意。
curlGet.php 为数据抓取类，无需改动即可使用。
parse_data.php 将所有正则表达式全部以数组的形式写在这里。如果你需要其他网站的数据，可以将新的正则表达式补在后面即可。
index.php 这个不用解释。

# 用法 #

首先你需要包含 dataParse.php 类。比如
`include_once 'dataParse.php' 
这里只是个例子，使用时请确保文件路径正确！

随后就可以实例化 dataParse 类，并调用collect 方法。比如
`$find = new dataParse;
`if($_POST){
`    $url = $_POST['url'];
`    if($result=$find->collect($url)){
`        return $result;
`     } else {
`         return false;
`      }
` }
你也可以修改 dataParse 类 ， 在构造函数中直接调用collect方法，并修改相应的参数。
这样就能在实例化的时候写更少的代码。

最后在parse_data.php中添加你需要的正则表达式即可。
你需要特别留意你所需抓取页面的编码方式，以免带来不必要的麻烦。

# 注意 #

这个项目之前很长的一段时间没有维护，部分网站的抓取规则可能有变动，请使用时先仔细检查。
欢迎你参与到这个小项目的维护中来！
