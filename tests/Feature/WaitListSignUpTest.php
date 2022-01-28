<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\WaitLister;

class WaitListSignUpTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test sign up validation error
     *
     * @return void
     */
    public function testSignUpValidationError()
    {
        $response = $this->json('POST', '/api/waitlist/sign-up', []);

        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "fullname" => [
                    "The fullname field is required."
                ],
                "email" => [
                    "The email field is required."
                ],
                "type" => [
                    "The type field is required."
                ]
            ]
        ]);
    }

    /**
     * Test sign up validation error for waitlister type
     *
     * @return void
     */
    public function testWaitListerTypeError()
    {
        $fullname = $this->faker->name();
        $email = $this->faker->unique()->safeEmail;
        $type = 'investo';


        $response = $this->json('POST', '/api/waitlist/sign-up', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type
        ]);

        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "type" => [
                    "The selected type is invalid."
                ]
            ]
        ]);
    }

    /**
     * Test asset description is required for asset lister
     *
     * @return void
     */
    public function testAssetDescriptionRequiredForAssetLister()
    {
        $fullname = $this->faker->name();
        $email = $this->faker->unique()->safeEmail;
        $type = 'asset_lister';

        $response = $this->json('POST', '/api/waitlist/sign-up', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type
        ]);

        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "asset_description" => [
                    "The asset description field is required when type is asset_lister."
                ]
            ]
        ]);
    }

    /**
     * Test email already exist
     *
     * @return void
     */
    public function testEmailAlreadyExist()
    {
        $fullname = $this->faker->name();
        $email = 'fola@gmail.com';
        $type = 'investor';

        $response = $this->json('POST', '/api/waitlist/sign-up', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type
        ]);

        $email = 'fola@gmail.com';

        $response = $this->json('POST', '/api/waitlist/sign-up', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type
        ]);

        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "email" => [
                    'The email has already been taken.'
                ]
            ]
        ]);
    }

    /**
     * Test sign up investor
     *
     * @return void
     */
    public function testSignUpInvestor()
    {
        $fullname = $this->faker->name();
        $email = $this->faker->unique()->safeEmail;
        $type = 'investor';


        $response = $this->json('POST', '/api/waitlist/sign-up', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type
        ]);

        $response->assertJson([
            "success" => true,
            "message" => "You are added to the waitlist"
        ]);

        $this->assertDatabaseHas('wait_listers', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type
        ]);
    }

    /**
     * Test sign up asset lister
     *
     * @return void
     */
    public function testSignUpAssetLister()
    {
        $fullname = $this->faker->name();
        $email = $this->faker->unique()->safeEmail;
        $type = 'asset_lister';
        $asset_description = $this->faker->sentence(500);


        $response = $this->json('POST', '/api/waitlist/sign-up', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type,
            'asset_description' => $asset_description
        ]);

        $response->assertJson([
            "success" => true,
            "message" => "You are added to the waitlist"
        ]);

        $this->assertDatabaseHas('wait_listers', [
            'fullname' => $fullname,
            'email' => $email,
            'type' => $type,
            'asset_description' => $asset_description
        ]);
    }
}