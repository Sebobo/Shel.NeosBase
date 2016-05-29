<?php

namespace Shel\NeosBase\Application;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use TYPO3\Surf\Application\TYPO3\Flow;
use TYPO3\Surf\Domain\Model\Workflow;
use TYPO3\Surf\Domain\Model\Deployment;

/**
 * Neos application template.
 */
class NeosApplication extends Flow
{
    /**
     * @var bool
     */
    private $webopCacheResetActive;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * Constructor.
     * @param string $name
     * @param string $baseUrl
     * @param bool $webopCacheResetActive
     */
    public function __construct($name = 'Neos', $baseUrl = '', $webopCacheResetActive = false)
    {
        parent::__construct($name);

        $this->options = array_merge($this->options, [
            'updateMethod' => null,
            'keepReleases' => 3,
            'packageMethod' => 'git',
            'transferMethod' => 'rsync',
        ]);
        $this->webopCacheResetActive = $webopCacheResetActive;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Register tasks for this application.
     *
     * @param Workflow $workflow
     * @param Deployment $deployment
     */
    public function registerTasks(Workflow $workflow, Deployment $deployment)
    {
        parent::registerTasks($workflow, $deployment);

        $this->setVersion('3.0');

        // Define tasks
        $workflow
            ->defineTask('app:optimizeAutoloader', 'typo3.surf:localShell',[
                'command' => sprintf('cd {workspacePath} && %s dump-autoload --optimize', escapeshellcmd('composer')),
            ])
            ->defineTask('typo3.surf:shell:unsetResourceLinks', 'typo3.surf:shell',[
                'command' => 'cd {releasePath} && rm -rf Web/_Resources/Persistent && rm -rf Web/_Resources/Static',
            ])
            ->defineTask('typo3.surf:shell:clearCaches', 'typo3.surf:shell',[
                'command' => 'cd {releasePath} && FLOW_CONTEXT=' . $this->getContext() . ' ./flow flow:cache:flush'
            ])
        ;

        // Add tasks to stages
        $workflow
            ->afterTask('typo3.surf:composer:localinstall', ['app:optimizeAutoloader'])
            ->beforeStage('finalize', ['typo3.surf:shell:unsetResourceLinks'], $this)
            ->beforeStage('migrate', ['typo3.surf:shell:clearCaches'], $this)
            ->afterStage('transfer', 'typo3.surf:typo3:flow:copyconfiguration')
        ;

        if ($this->webopCacheResetActive) {
            $workflow
                ->beforeStage('transfer', 'typo3.surf:php:webopcacheresetcreatescript')
                ->afterStage('switch', 'typo3.surf:php:webopcacheresetexecute')
            ;
        }

        // Configure deployment
        $deployment
            ->onInitialize(function () use ($workflow) {
                $workflow
                    ->setTaskOptions('typo3.surf:generic:createDirectories', [
                        'directories' => [
                            'shared/Data/Web/_Resources',
                        ]
                    ]);

                if ($this->webopCacheResetActive) {
                    $workflow->setTaskOptions('typo3.surf:php:webopcacheresetexecute', ['baseUrl' => $this->baseUrl]);
                }
            })
        ;
    }
}
