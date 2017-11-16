<?php
namespace Shel\NeosBase\ViewHelpers;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;
use Neos\FluidAdaptor\Core\ViewHelper\Exception\InvalidVariableException;
use Shel\NeosBase\Service\ResourceService;

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
     * @Flow\Inject
     * @var ResourceService
     */
    protected $resourceService;

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
        return $this->resourceService->loadResourceContent($path, $resource);
    }
}
