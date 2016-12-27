<?php
namespace Shel\NeosBase\ViewHelpers;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use Neos\FluidAdaptor\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * A view helper for rendering a simple tag with an array of attributes
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <snb:tag attributes="{attributes}">
 *   <p>More content</p>
 * </snb:tag>
 * </code>
 */
class TagViewHelper extends AbstractTagBasedViewHelper
{

    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
    }

    /**
     * @param string|array $attributes List of attributes as key/value pairs or a string like ' class="foo" id="bar"'
     * @param string $tag The name of the tag that should be wrapped around the content. By default this is a <div>
     * @return string The rendered tag and it's content
     */
    public function render($attributes = [], $tag = 'div')
    {
        $this->tag->setTagName($tag);
        $this->tag->setContent($this->renderChildren());
        return $this->renderTag($attributes);
    }

    /**
     * Renders and returns the tag
     *
     * @param string|array $attributes
     * @return string
     */
    public function renderTag($attributes = [])
    {
        if (empty($this->tag->getTagName())) {
            return '';
        }

        $output = '<' . $this->tag->getTagName();

        if (is_array($attributes)) {
            $this->tag->addAttributes($attributes);
        } else {
            $output .= $attributes;
        }

        foreach ($this->tag->getAttributes() as $attributeName => $attributeValue) {
            $output .= ' ' . $attributeName . '="' . $attributeValue . '"';
        }

        if ($this->tag->hasContent()) {
            $output .= '>' . $this->tag->getContent(). '</' . $this->tag->getTagName() . '>';
        } else {
            $output .= ' />';
        }

        return $output;
    }
}
