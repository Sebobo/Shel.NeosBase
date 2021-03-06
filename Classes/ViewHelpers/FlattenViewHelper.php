<?php
namespace Shel\NeosBase\ViewHelpers;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;
use Neos\FluidAdaptor\Core\ViewHelper\Exception as ViewHelperException;

/**
 * A view helper for flattening a variable be it array or string
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <snb:flatten value="{value}"/>
 * </code>
 */
class FlattenViewHelper extends AbstractViewHelper
{
    /**
     * @var boolean
     */
    protected $escapeOutput = true;

    /**
     * @param mixed $value
     * @return string The flattened variable
     */
    public function render($value = '')
    {
        $result = $value;
        if (is_array($value)) {
            $result = join(', ', $value);
        }
        return $result . '';
    }
}
