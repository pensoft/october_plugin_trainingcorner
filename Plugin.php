<?php namespace Pensoft\TrainingCorner;

use Backend;
use System\Classes\PluginBase;

/**
 * TrainingCorner Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'TrainingCorner',
            'description' => 'No description provided yet...',
            'author'      => 'Pensoft',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     */
    public function registerComponents(): array
    {

        return [
            \Pensoft\TrainingCorner\Components\TrainingCorner::class => 'TrainingCorner',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'pensoft.trainingcorner.access' => [
                'tab' => 'Training Corner',
                'label' => 'Manage training corner'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        // return []; // Remove this line to activate

        return [
            'trainingcorner' => [
                'label'       => 'TrainingCorner',
                'url'         => Backend::url('pensoft/trainingcorner/training'),
                'icon'        => 'icon-leaf',
                'permissions' => ['pensoft.trainingcorner.*'],
                'order'       => 500,
                'sideMenu' => [
                    'training' => [
                        'label'       => 'Training',
                        'url'         => Backend::url('pensoft/trainingcorner/training'),
                        'icon'        => 'icon-list',
                        'permissions' => ['pensoft.trainingcorner.*'],
                    ],
                ],
            ],
        ];
    }
}
