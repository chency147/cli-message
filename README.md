# Cli Message
Let your php output in command line colorful.

## 效果预览
![样例](/image/demo.gif)
![支持的颜色](/image/supportColors.jpg)

## 要求
- PHP >= 5.4

## 使用方法
### 安装
`composer require "chency147/cli-message"`

### 使用示例
```$PHP
$style = new Style();
$style->setForegroundColor(Style::COLOR_GREEN) // 定义颜色为绿色
      ->setBold() // 设置加粗
      ->setUnderLine(); // 设置显示下划线
$message = new Message();
$message->setStyle($style); // 给消息设定样式
$message->setContent('哈哈哈！'); // 设置消息内容
echo $message, PHP_EOL; // 重写了__toString方法，消息对象可直接作为字符串使用

// 也可以用getContentWithStyle方法来获取处理后的字符串进行输出
echo $message->getContentWithStyle(), PHP_EOL;

$anotherStyle = new Style();
$anotherStyle->setForegroundColor(Style::COLOR_RED);
echo $message->getContentWithStyle($anotherStyle, PHP_EOL);
```
### 颜色说明
- 颜色由0到255的整数来控制，可参照效果预览中的颜色表来选择自己所需的颜色；

## 协议
本项目使用MIT协议。
