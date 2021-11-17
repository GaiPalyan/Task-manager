<?php

namespace Tests;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use function Tests\Feature\make;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    protected Model|Collection $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = make(User::class)->create();
    }
}
