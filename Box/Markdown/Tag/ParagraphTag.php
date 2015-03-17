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

class ParagraphTag extends Tag
{

    /**
     * Transform md to html tag
     * @param string $text
     * @return string
     */
    public function transform($text)
    {
        // split
        $tab = preg_split('/\n{2,}/', $text, -1, PREG_SPLIT_NO_EMPTY);

        // make p when subtext starts not with "<"
        foreach($tab as $key => $subtext) {
            if(!preg_match('/^ *</', $subtext)) {
                $tab[$key] = '<p>' . $subtext . '</p>';
            }
        }

        return implode("\n\n", $tab);
    }

}