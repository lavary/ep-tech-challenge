<?php

use App\User;
use App\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

final class IndexTest extends TestCase
{
	use RefreshDatabase;

	public function test_a_user_can_only_see_their_clients(): void
	{
		$jim = factory(User::class)->create();
		$bob = factory(User::class)->create();

		$jimsClient = factory(Client::class)->create(['user_id' => $jim->id]);
		$bobsClient = factory(Client::class)->create(['user_id' => $bob->id]);

		$this->actingAs($jim);

		$response = $this->get('/clients');

		$response->assertStatus(200);
		$response->assertViewHas('clients', fn($clients) => $clients->contains($jimsClient));
		$response->assertViewHas('clients', fn($clients) => !$clients->contains($bobsClient));

		$this->actingAs($bob);

		$response = $this->get('/clients');

		$response->assertStatus(200);
		$response->assertViewHas('clients', fn($clients) => $clients->contains($bobsClient));
		$response->assertViewHas('clients', fn($clients) => !$clients->contains($jimsClient));
	}
}
