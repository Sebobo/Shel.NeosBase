<?php

namespace Shel\NeosBase\Service;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Neos\FluidAdaptor\Core\ViewHelper\Exception\InvalidVariableException;

/**
 * Implementation class for embedding svgs in fusion
 * @Flow\Scope("singleton")
 */
class ResourceService
{
    /**
     * Loads the content of a resource and returns it as string
     *
     * @param string $path
     * @param string|null $resource
     * @return string Content of the resource
     * @throws InvalidVariableException
     */
    public function loadResourceContent($path, $resource = null)
    {
        $data = '';
        if ($resource !== null && $resource !== '') {
            $dataStream = $resource->getStream();

            if ($dataStream) {
                $data = $dataStream->read($dataStream->getSize());
            }
        } else {
            if ($path === null) {
                throw new InvalidVariableException('You have to either define a path or resource.', 1510769411);
            }

            $data = file_get_contents($path);
        }
        return $data;
    }
}
