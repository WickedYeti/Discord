<?php
/**
 * This file is part of the Discord package.
 *
 * Copyright Aymeric Assier <aymeric.assier@gmail.com>
 *
 * For the full copyright and license information, please view the `licence`
 * file that was distributed with this source code.
 */
namespace Discord\Box\Markdown\Tag;

use Discord\Box\Markdown\Tag;

class TitleTag extends Tag
{

    /**
     * Transform md to html tag
     * @param string $text
     * @return string
     */
    public function transform($text)
    {
        // h1
        $text = preg_replace('/(\s|^)# (.+)/', '$1<h1>$2</h1>$3', $text);
        $text = preg_replace('/(.+)\n(={2,})\n/', "<h1>$1</h1>\n\n", $text);

        // h2
        $text = preg_replace('/(\s|^)## (.+)/', '$1<h2>$2</h2>$3', $text);
        $text = preg_replace('/(.+)\n(-{2,})\n/', "<h2>$1</h2>\n\n", $text);

        // h3
        $text = preg_replace('/(\s|^)### (.+)/', '$1<h3>$2</h3>$3', $text);

        // h4
        $text = preg_replace('/(\s|^)#### (.+)/', '$1<h4>$2</h4>$3', $text);

        // h4
        $text = preg_replace('/(\s|^)##### (.+)/', '$1<h5>$2</h5>$3', $text);

        // h4
        $text = preg_replace('/(\s|^)##### (.+)/', '$1<h6>$2</h6>$3', $text);

        return $text;
    }

}