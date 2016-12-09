<?php

namespace Wearenext\CMS;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Cloudinary;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Routing\Router;
use Wearenext\CMS\Models\PageType;
use Collective\Html\HtmlBuilder;
use Wearenext\CMS\Support\Html\FormBuilder;

class ServiceProvider extends BaseProvider
{
    public function boot(ViewFactory $view, Router $router, GateContract $gate)
    {
        // Publish database migrations
        $this->publishes([
            $this->relative('/Database/Migrations') => base_path('/database/migrations'),
        ], 'database');
        // Publish resource assets (javascript, css)
        $this->publishes([
            $this->relative('/Resources/assets') => public_path('vendor/cms'),
        ], 'public');
        
        if (!$this->app->routesAreCached()) {
            // Retrive config
            $config = $this->app['config']->get('cms', []);

            // Bootstrap routes
            $router->group($config['group'], function () {
                require $this->relative('/routes.php');
            });
        }
        
        // Bindings for route parameters
        $router->bind('cmsType', function ($value) {
            return PageType::slug($value)->firstOrFail();
        });
        $router->model('cmsPage', '\Wearenext\CMS\Models\Page');
        $router->model('cmsPageType', '\Wearenext\CMS\Models\PageType');
        $router->model('cmsBlock', '\Wearenext\CMS\Models\Block');
        $router->model('cmsUser', config('auth.model'));
        
        // Add views
        $this->loadViewsFrom($this->relative('/Resources/views'), 'cms');
        
        // Translations
        $this->loadTranslationsFrom($this->relative('/Resources/lang'), 'cms');
        
        // Cloudinary creds
        Cloudinary::config($this->app['config']->get('services.cloudinary'));
        
        // Register permissions
        $this->permissions($gate);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'cms.application',
            function ($app) {
                return new Application();
            }
        );

        $this->app->bind(
            'Wearenext\CMS\Contracts\Application',
            function ($app) {
                return $app['cms.application'];
            }
        );
        
        $this->app->bind(
            'Wearenext\CMS\Contracts\RenderableContent',
            function ($app) {
                return $app['cms.application']->currentContent();
            }
        );

        $this->app->singleton('cmshtml', function ($app) {
            return new HtmlBuilder($app['url']);
        });

        $this->app->singleton('cmsform', function ($app) {
            $form = new FormBuilder($app['cmshtml'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });

        // Register Media macros
        HtmlBuilder::macro('media', function (Media $media, $maxWidth, $maxHeight) {
            $attributes = [ 'width' => $maxWidth, 'height' => $maxHeight ];
            return '<div class="image">' .
            Html::image($media->url, $media->title, $attributes) .
            '</div>';
        });

        $this->mergeConfigFrom($this->relative('/config/cms.php'), 'cms');
        $this->mergeConfigFrom($this->relative('/config/services.php'), 'services');
    }

    public function provides()
    {
        return [
            'Wearenext\CMS\Support\Facades\HtmlFacade',
            'Wearenext\CMS\Support\Facades\FormFacade',
            'Wearenext\CMS\Contracts\Application',
            'Wearenext\CMS\Contracts\RenderableContent',
        ];
    }
    
    protected function permissions(GateContract $gate)
    {
        // Preview Page
        $gate->define('cms.page_preview', $this->allows(true));
        // Page Index
        $gate->define('cms.page_index', $this->allows(true));
        // Page Create
        $gate->define('cms.page_create', $this->allows(true));
        // Page Edit
        $gate->define('cms.page_edit', $this->allows(true));
        // Page View (blocks)
        $gate->define('cms.page_view', $this->allows(true));
        // Page Destroy
        $gate->define('cms.page_destroy', $this->allows(false));
        // User Index
        $gate->define('cms.user_index', $this->allows(false));
        // User Create
        $gate->define('cms.user_create', $this->allows(false));
        // User Edit
        $gate->define('cms.user_edit', $this->allows(false));
        // User Destroy
        $gate->define('cms.user_delete', $this->allows(false));
        // User Restore
        $gate->define('cms.user_restore', $this->allows(false));
        // Activity Index
        $gate->define('cms.activity_index', $this->allows(false));
        // Activity Create
        $gate->define('cms.activity_create', $this->allows(false));
        // Activity Edit
        $gate->define('cms.activity_edit', $this->allows(false));
        // Activity Show
        $gate->define('cms.activity_show', $this->allows(false));
        // Activity Update
        $gate->define('cms.activity_update', $this->allows(false));
        // Activity Store
        $gate->define('cms.activity_store', $this->allows(false));
        // Activity Destroy
        $gate->define('cms.activity_destroy', $this->allows(false));
        // Page Publish
        $gate->define('cms.page_publish', $this->allows(false));
        // Page Unpublish
        $gate->define('cms.page_unpublish', $this->allows(false));
        // Page Type Index
        $gate->define('cms.pagetype_index', $this->allows(false));
        // Page Type Create
        $gate->define('cms.pagetype_create', $this->allows(false));
        // Page Type Edit
        $gate->define('cms.pagetype_edit', $this->allows(false));
        // Page Type Destroy
        $gate->define('cms.pagetype_delete', $this->allows(false));
    }
    
    protected function allows($author)
    {
        return function ($user) use ($author) {
            $r = data_get($user, 'cms_role', 'admin');
            switch ($r) {
                case 'admin':
                    return true;
                case 'author':
                    return $author;
            }
            return false;
        };
    }
    
    protected function relative($path)
    {
        return __DIR__ . $path;
    }
}
