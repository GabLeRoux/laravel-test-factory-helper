<?php

namespace Mpociot\LaravelTestFactoryHelper\Testing;

use Mpociot\LaravelTestFactoryHelper\Role;
use Mpociot\LaravelTestFactoryHelper\Contracts\Repositories\RoleRepository;

class CommandsTest extends AbstractTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->migrate([
            $this->stubsPath('database/migrations'),
            $this->resourcePath('migrations'),
        ]);
        $this->seed([
            'UserTableSeeder',
            'RoleTableSeeder',
        ]);
    }
    /**
     * {@inheritdoc}
     * @return array
     */
    public function getPackageProviders($app)
    {
        return [
            'Artesaos\Defender\Providers\DefenderServiceProvider',
            'Orchestra\Database\ConsoleServiceProvider',
        ];
    }
    /**
     * Creating a Permission.
     */
    public function testCommandShouldMakeAPermission()
    {
        $this->artisan('defender:make:permission', ['name' => 'a.permission', 'readableName' => 'A permission.']);
        $this->assertDatabaseHas(
            config('defender.permission_table', 'permissions'),
            [
                'name' => 'a.permission',
                'readable_name' => 'A permission.',
            ]
        );
    }
}

