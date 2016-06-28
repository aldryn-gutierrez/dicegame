<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dice;

class DiceTest extends TestCase
{
    public function testRoll()
    {
    	$dice = new Dice();
        $faces = $dice->getFaces();

    	$results = [];
    	# Run multiple iteration to ensure accuracy
    	for ($iteration =1; $iteration < 3 ; $iteration++) { 
    		$randomFace = $dice->roll();
    		$isValidFace = (in_array($randomFace, $faces));

    		$results[] = $isValidFace;
    	}
 	
 		# Get the Unique result whether the face is valid
 		# Should return one distinct result
        $uniquedResult = array_unique($results);
        $this->assertEquals(1, count($uniquedResult));

        # Should assert that all are valid face
        $this->assertEquals(true, $uniquedResult[0]);
    }
}
