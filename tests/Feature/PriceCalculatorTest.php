<?php 
namespace Tests\Unit;

use PHPUnit\Framework\TestCase; // Standard PHPUnit class
use App\Services\PriceCalculator;

class PriceCalculatorTest extends TestCase
{
    public function test_it_calculates_vat_correctly(): void
    {
        // 1. Arrange: Setup the data
        $calculator = new PriceCalculator();
        $netPrice = 100;

        // 2. Act: Run the logic
        $total = $calculator->addVat($netPrice);

        // 3. Assert: Check the result
        $this->assertEquals(120, $total);
    }
}

?>