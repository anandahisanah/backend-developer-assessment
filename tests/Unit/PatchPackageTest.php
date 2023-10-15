<?php

namespace Tests\Unit;

use App\Models\Package;
use Tests\TestCase;

class PatchPackageTest extends TestCase
{
    public function test_update_transaction_state_at_package(): void
    {
        $data = [
            // column
            'transaction_state' => 'UNPAID',
        ];

        // find package
        $package = Package::first();

        // update package
        $package->update($data);

        $updated_package = Package::find($package->id);

        $this->assertInstanceOf(Package::class, $updated_package);
        $this->assertEquals($data['transaction_state'], $updated_package->transaction_state);
    }
}
