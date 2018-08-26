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

if (Message::isSupport()) {
    echo 'ANSI: Supported.', PHP_EOL;
} else {
    echo 'ANSI: unsupported!', PHP_EOL;
}

$style = new Style();
$style->setForegroundColor(Style::COLOR_LIGHT_RED)->setBold();
$message = new Message();
$message->setStyle($style);
echo $message->setContent('Hello! I\'m in RED.'), PHP_EOL;
$message->getStyle()->setForegroundColor(Style::COLOR_GREEN);
echo $message->setContent('And I\'m in GREEN.'), PHP_EOL;
$message->getStyle()->setForegroundColor(Style::COLOR_YELLOW);
echo $message->setContent('And I\'m in Yellow.'), PHP_EOL;
$message->getStyle()->setForegroundColor(Style::COLOR_BLUE)->setBackgroundColor(Style::COLOR_WHITE);
echo $message->setContent('And I\'m in BLUE with WHITE background.'), PHP_EOL;
$message->getStyle()->resetForegroundColor()->resetBackgroundColor()->setBlink();
echo $message->setContent('I\'m Blinking.'), PHP_EOL;
$message->getStyle()->unsetBlink()->setItalic()->setUnderLine()->setStrikeThrough();
echo $message->setContent('I\'m italic with underline and strike through.'), PHP_EOL;

Message::error('ERROR MESSAGE');
Message::success('SUCCESS MESSAGE');
Message::warning('WARNING MESSAGE');
Message::notice('NOTICE MESSAGE');
Message::info('INFO MESSAGE');
