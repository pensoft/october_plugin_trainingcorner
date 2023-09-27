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
     *
     * @return array
     */
    public function pluginDetails()
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
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {

        return [
            'Pensoft\TrainingCorner\Components\TrainingCorner' => 'TrainingCorner',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'pensoft.trainingcorner.some_permission' => [
                'tab' => 'TrainingCorner',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        // return []; // Remove this line to activate

        return [
            'trainingcorner' => [
                'label'       => 'TrainingCorner',
                'url'         => Backend::url('pensoft/trainingcorner/training'),
                'icon'        => 'icon-leaf',
                'permissions' => ['pensoft.trainingcorner.*'],
                'order'       => 500,
            ],
        ];
    }
}
