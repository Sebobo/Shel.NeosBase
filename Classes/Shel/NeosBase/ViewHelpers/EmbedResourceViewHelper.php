<?php
namespace Shel\NeosBase\ViewHelpers;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\ResourceManagement\PersistentResource;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\Fluid\Core\ViewHelper\Exception as ViewHelperException;
use TYPO3\Fluid\Core\ViewHelper\Exception\InvalidVariableException;

/**
 * A view helper for embedding file content into the page.
 * Especially useful for svg files.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <snb:embedResource path="resource://DifferentPackage/Public/gfx/SomeImage.svg"/>
 * </code>
 */
class EmbedResourceViewHelper extends AbstractViewHelper
{
    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /**
     * Render the URI to the resource. The filename is used from child content.
     *
     * @param string $path The location of the resource, can be either a path relative to the Public resource directory of the package or a resource://... URI
     * @param Resource $resource If specified, this resource object is used instead of the path and package information
     * @return string The content of the specified file
     * @throws InvalidVariableException
     */
    public function render($path = null, Resource $resource = null)
    {
        $data = '';
        if ($resource !== null) {
            $dataStream = $resource->getStream();

            if ($dataStream) {
                $data = $dataStream->read($dataStream->getSize());
            }
        } else {
            if ($path === null) {
                throw new InvalidVariableException('The ResourceViewHelper did neither contain a valuable "resource" nor "path" argument.', 1457673112);
            }

            $data = file_get_contents($path);
        }
        return $data;
    }
}
