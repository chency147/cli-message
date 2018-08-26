<?php
/*
 * This file is part of cli-message.
 *
 * (c) Rick Chen <313797922@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chency147\CliMessage;

class Message
{

    /** @var string 内容 */
    protected $content = '';

    /** @var string 转义前缀 */
    const ESCAPE_BEGIN = "\033[";
    /** @var string 转义后缀 */
    const ESCAPE_END = "\033[0m";

    /** @var string 处理后的前缀 */
    protected $prefix = '';
    /** @var string 处理后的后缀 */
    protected $suffix = self::ESCAPE_END;

    /** @var Style 样式 */
    protected $style = null;

    /** @var array 预设消息 */
    protected static $defaultMessage = [];

    /** @var bool 判断是否支持样式输出 */
    protected static $isSupport = null;

    /**
     * 获取带样式的内容
     *
     * @param null|Style $style 样式
     * @param string $suffix 后缀
     * @return string 处理后的字符串
     */
    public function getContentWithStyle($style = null, $suffix = '')
    {
        if (!$style instanceof Style) {
            $style = $this->style;
        }
        if (self::isSupport() && $style instanceof Style) {
            $prefix = '';
            /* 处理前景色 */
            $foregroundColor = $style->getForegroundColor();
            if (null !== $foregroundColor) {
                $prefix .= ";38;5;{$foregroundColor}";
            }
            /* 处理背景色 */
            $backgroundColor = $style->getBackgroundColor();
            if (null !== $backgroundColor) {
                $prefix .= ";48;5;{$backgroundColor}";
            }
            /* 处理闪烁  */
            if ($style->isBlink()) {
                $prefix .= ';5';
            }
            /* 处理加粗  */
            if ($style->isBold()) {
                $prefix .= ';1';
            }
            /* 处理下划线  */
            if ($style->hasUnderLine()) {
                $prefix .= ';4';
            }
            /* 处理删除线  */
            if ($style->hasStrikeThrough()) {
                $prefix .= ';9';
            }
            /* 处理斜体 */
            if ($style->isItalic()) {
                $prefix .= ';3';
            }
            if ($prefix !== '') {
                $this->prefix = self::ESCAPE_BEGIN . $prefix . 'm';
                return $this->prefix . $this->content . $this->suffix . $suffix;
            }
        }
        return $this->content . $suffix;
    }

    /**
     * 重写__toString方法，使实例可以当作字符串使用
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getContentWithStyle();
    }

    /**
     * 设置样式
     *
     * @param Style $style 样式
     * @return self
     */
    public function setStyle($style)
    {
        if ($style instanceof Style) {
            $this->style = clone $style;
        }
        return $this;
    }

    /**
     * 获取样式
     *
     * @return null|Style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * 抹除样式
     *
     * @return self
     */
    public function unsetStyle()
    {
        $this->style = null;
        return $this;
    }

    /**
     * 设置内容
     *
     * @param  string $content 内容
     * @return self
     */
    public function setContent($content)
    {
        $this->content = (string)$content;
        return $this;
    }

    /**
     * 获取内容
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 错误输出
     *
     * @param string $content
     * @param string $suffix
     */
    public static function ERROR($content, $suffix = PHP_EOL)
    {
        if (!isset(self::$defaultMessage['error']) || !self::$defaultMessage['error'] instanceof self) {
            $message = new self();
            $style = new Style();
            $style->setForegroundColor(Style::COLOR_LIGHT_RED)->setBold();
            $message->setStyle($style);
            self::$defaultMessage['error'] = $message;
        }
        self::$defaultMessage['error']->setContent($content);
        echo self::$defaultMessage['error'], $suffix;
    }

    /**
     * 成功输出
     *
     * @param string $content
     * @param string $suffix
     */
    public static function success($content, $suffix = PHP_EOL)
    {
        if (!isset(self::$defaultMessage['success']) || !self::$defaultMessage['success'] instanceof self) {
            $message = new self();
            $style = new Style();
            $style->setForegroundColor(Style::COLOR_LIGHT_GREEN)->setBold();
            $message->setStyle($style);
            self::$defaultMessage['success'] = $message;
        }
        self::$defaultMessage['success']->setContent($content);
        echo self::$defaultMessage['success'], $suffix;
    }

    /**
     * 警告输出
     *
     * @param string $content
     * @param string $suffix
     */
    public static function warning($content, $suffix = PHP_EOL)
    {
        if (!isset(self::$defaultMessage['warning']) || !self::$defaultMessage['warning'] instanceof self) {
            $message = new self();
            $style = new Style();
            $style->setForegroundColor(202);
            $message->setStyle($style);
            self::$defaultMessage['warning'] = $message;
        }
        self::$defaultMessage['warning']->setContent($content);
        echo self::$defaultMessage['warning'], $suffix;
    }

    /**
     * 通知输出
     *
     * @param string $content
     * @param string $suffix
     */
    public static function notice($content, $suffix = PHP_EOL)
    {
        if (!isset(self::$defaultMessage['notice']) || !self::$defaultMessage['notice'] instanceof self) {
            $message = new self();
            $style = new Style();
            $style->setBold();
            $message->setStyle($style);
            self::$defaultMessage['notice'] = $message;
        }
        self::$defaultMessage['notice']->setContent($content);
        echo self::$defaultMessage['notice'], $suffix;
    }

    /**
     * 普通输出
     *
     * @param string $content
     * @param string $suffix
     */
    public static function info($content, $suffix = PHP_EOL)
    {
        if (!isset(self::$defaultMessage['info']) || !self::$defaultMessage['info'] instanceof self) {
            $message = new self();
            $message->unsetStyle();
            self::$defaultMessage['info'] = $message;
        }
        self::$defaultMessage['info']->setContent($content);
        echo self::$defaultMessage['info'], $suffix;
    }

    /**
     * 判断是否支持样式输出
     *
     * @return bool
     */
    public static function isSupport()
    {
        if (self::$isSupport === null) {
            self::$isSupport = DIRECTORY_SEPARATOR == '\\' ?
                (false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI')) :
                (function_exists('posix_isatty') && posix_isatty(1));
        }
        return self::$isSupport;
    }
}
