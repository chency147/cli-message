<?php
/*
 * This file is part of cli-message.
 *
 * (c) Rick Chen <313797922@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Chency147\CliMessage\Message;
use Chency147\CliMessage\Style;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$message = new Message();
$style = new Style();
$message->setStyle($style);

/* 打印出所有支持的颜色 */
for ($i = 0; $i < 256; $i++) {
    $message->setContent("{$i}\t")
        ->getStyle()->setBackgroundColor($i);
    echo $message;
    if (($i+1) % 16 === 0) {
        echo PHP_EOL;
    }
}
