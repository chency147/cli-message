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

class Style
{
    /** @var int|null 前景色 */
    protected $foregroundColor = null;
    /** @var int|null 背景色 */
    protected $backgroundColor = null;
    /** @var boolean 是否闪烁 */
    protected $blink = false;
    /** @var boolean 是否加粗 */
    protected $bold = false;
    /** @var boolean 是否加下划线 */
    protected $underLine = false;
    /** @var boolean 是否加删除线 */
    protected $strikeThrough = false;
    /** @var boolean 是否设置威胁体 */
    protected $italic = false;

    /** @var int 颜色最小值 */
    const COLOR_MIN = 0;
    /** @var int 颜色最大值 */
    const COLOR_MAX = 255;

    /** @var int 颜色 - 黑色 */
    const COLOR_BLACK = 0;
    /** @var int 颜色 - 红色 */
    const COLOR_RED = 52;
    /** @var int 颜色 - 绿色 */
    const COLOR_GREEN = 2;
    /** @var int 颜色 - 黄色 */
    const COLOR_YELLOW = 3;
    /** @var int 颜色 - 蓝色 */
    const COLOR_BLUE = 4;
    /** @var int 颜色 - 品红色 */
    const COLOR_MAGENTA = 5;
    /** @var int 颜色 - 青色 */
    const COLOR_CYAN = 6;
    /** @var int 颜色 - 银色 */
    const COLOR_SLIVER = 7;
    /** @var int 颜色 - 灰色 */
    const COLOR_GRAY = 8;
    /** @var int 颜色 - 亮红色 */
    const COLOR_LIGHT_RED = 196;
    /** @var int 颜色 - 亮绿色 */
    const COLOR_LIGHT_GREEN = 10;
    /** @var int 颜色 - 亮黄色 */
    const COLOR_LIGHT_YELLOW = 11;
    /** @var int 颜色 - 亮蓝色 */
    const COLOR_LIGHT_BLUE = 12;
    /** @var int 颜色 - 亮品红色 */
    const COLOR_LIGHT_MAGENTA = 13;
    /** @var int 颜色 - 亮青色 */
    const COLOR_LIGHT_CYAN = 14;
    /** @var int 颜色 - 白色 */
    const COLOR_WHITE = 15;

    /**
     * 设置前景色
     *
     * @param  int $color 颜色
     * @return self
     */
    public function setForegroundColor($color)
    {
        $color = \intval($color);
        if ($color >= self::COLOR_MIN && $color >= self::COLOR_MIN) {
            $this->foregroundColor = $color;
        }
        return $this;
    }

    /**
     * 获取前景色
     *
     * @return null|string
     */
    public function getForegroundColor()
    {
        return $this->foregroundColor;
    }

    /**
     * 重置前景色
     *
     * @return self
     */
    public function resetForegroundColor()
    {
        $this->foregroundColor = null;
        return $this;
    }

    /**
     * 设置背景色
     *
     * @param  int $color 颜色
     * @return self
     */
    public function setBackgroundColor($color)
    {
        $color = \intval($color);
        if ($color >= self::COLOR_MIN && $color >= self::COLOR_MIN) {
            $this->backgroundColor = $color;
        }
        return $this;
    }

    /**
     * 获取背景色
     *
     * @return int|null
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * 重置背景色
     *
     * @return self
     */
    public function resetBackgroundColor()
    {
        $this->backgroundColor = null;
        return $this;
    }

    /**
     * 设置闪烁
     *
     * @return self
     */
    public function setBlink()
    {
        $this->blink = true;
        return $this;
    }

    /**
     * 取消闪烁
     *
     * @return self
     */
    public function unsetBlink()
    {
        $this->blink = false;
        return $this;
    }

    /**
     * 是否闪烁
     *
     * @return bool
     */
    public function isBlink()
    {
        return $this->blink;
    }

    /**
     * 设置加粗
     *
     * @return self
     */
    public function setBold()
    {
        $this->bold = true;
        return $this;
    }

    /**
     * 取消加粗
     *
     * @return self
     */
    public function unsetBold()
    {
        $this->bold = false;
        return $this;
    }

    /**
     * 是否加粗
     *
     * @return bool
     */
    public function isBold()
    {
        return $this->bold;
    }

    /**
     * 设置下划线
     *
     * @return self
     */
    public function setUnderLine()
    {
        $this->underLine = true;
        return $this;
    }

    /**
     * 取消下划线
     *
     * @return self
     */
    public function unsetUnderLine()
    {
        $this->underLine = false;
        return $this;
    }

    /**
     * 是否有设置下划线
     *
     * @return bool
     */
    public function hasUnderLine()
    {
        return $this->underLine;
    }

    /**
     * 设置删除线
     *
     * @return self
     */
    public function setStrikeThrough()
    {
        $this->strikeThrough = true;
        return $this;
    }

    /**
     * 取消删除线
     *
     * @return self
     */
    public function unsetStrikeThrough()
    {
        $this->strikeThrough = false;
        return $this;
    }

    /**
     * 是否设置了删除线
     *
     * @return bool
     */
    public function hasStrikeThrough()
    {
        return $this->strikeThrough;
    }

    /**
     * 设置斜体
     *
     * @return self
     */
    public function setItalic()
    {
        $this->italic = true;
        return $this;
    }

    /**
     * 取消斜体
     *
     * @return self
     */
    public function unsetItalic()
    {
        $this->italic = false;
        return $this;
    }

    /**
     * 是否为斜体
     *
     * @return bool
     */
    public function isItalic()
    {
        return $this->italic;
    }

    /**
     * 禁止子类将clone方法私有化
     */
    public function __clone()
    {
    }
}