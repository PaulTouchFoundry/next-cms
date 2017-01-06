<?php

use Orchestra\Testbench\TestCase;
use Wearenext\CMS\Models\User;

abstract class BaseTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--path' => '../../../../src/Database/Migrations',
        ]);
    }
    
    protected function getApplicationProviders($app)
    {
        return [
            Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
            Illuminate\Auth\AuthServiceProvider::class,
            Illuminate\Broadcasting\BroadcastServiceProvider::class,
            Illuminate\Bus\BusServiceProvider::class,
            Illuminate\Cache\CacheServiceProvider::class,
            Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
            Illuminate\Routing\ControllerServiceProvider::class,
            Illuminate\Cookie\CookieServiceProvider::class,
            Illuminate\Database\DatabaseServiceProvider::class,
            Illuminate\Encryption\EncryptionServiceProvider::class,
            Illuminate\Filesystem\FilesystemServiceProvider::class,
            Illuminate\Foundation\Providers\FoundationServiceProvider::class,
            Illuminate\Hashing\HashServiceProvider::class,
            Illuminate\Mail\MailServiceProvider::class,
            Illuminate\Pagination\PaginationServiceProvider::class,
            Illuminate\Pipeline\PipelineServiceProvider::class,
            Illuminate\Queue\QueueServiceProvider::class,
            Illuminate\Redis\RedisServiceProvider::class,
            Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
            Illuminate\Session\SessionServiceProvider::class,
            Illuminate\Translation\TranslationServiceProvider::class,
            Illuminate\Validation\ValidationServiceProvider::class,
            Illuminate\View\ViewServiceProvider::class,
            Wearenext\CMS\ServiceProvider::class,
        ];
    }
    
    protected function getApplicationAliases($app)
    {
        return [
            'Schema'    => Illuminate\Support\Facades\Schema::class,
            'Route'     => Illuminate\Support\Facades\Route::class,
            'View'      => Illuminate\Support\Facades\View::class,
            'CMSHtml'   => Wearenext\CMS\Support\Facades\HtmlFacade::class,
            'CMSForm'   => Wearenext\CMS\Support\Facades\FormFacade::class,
        ];
    }
    
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'mysql',
            'host'      => 'localhost',
            'database'  => 'testing',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]);
        
        $app['config']->set('auth.driver', 'eloquent');
        $app['config']->set('auth.model', User::class);
        $app['config']->set('auth.table', 'users');
        $app['config']->set('auth.password.email', 'emails.password');
        $app['config']->set('auth.password.table', 'password_resets');
        $app['config']->set('auth.password.expire', 60);
        $app['config']->set('cms.auth.middleware', null);
    }
}
