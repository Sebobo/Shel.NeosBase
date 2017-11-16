<?php

namespace Shel\NeosBase\FusionObjects;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Neos\FluidAdaptor\Core\ViewHelper\Exception\InvalidVariableException;
use Neos\Fusion\FusionObjects\AbstractFusionObject;
use Shel\NeosBase\Service\ResourceService;

/**
 * Implementation class for embedding svgs in fusion
 */
class EmbeddedSvgImplementation extends AbstractFusionObject
{
    /**
     * @Flow\Inject
     * @var ResourceService
     */
    protected $resourceService;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->fusionValue('path');
    }

    /**
     * @return Resource
     */
    public function getResource()
    {
        return $this->fusionValue('resource');
    }

    /**
     * Evaluate this Fusion object and return the result
     * @return string
     * @throws InvalidVariableException
     */
    public function evaluate()
    {
        return $this->resourceService->loadResourceContent($this->getPath(), $this->getResource());
    }
}
