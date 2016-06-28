<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\DiceCup;
use App\Models\Dice;

class DiceCupTest extends TestCase
{
    public function testPeekAtAllDice()
    {
        $diceCount = 6;
        $diceCup = new DiceCup($diceCount);

        $diceContent = $diceCup->peekAtAllDice();
        $this->assertEquals($diceCount, $diceContent->count());
    }

    public function testIsNotEmptyCup()
    {
        $diceCup = new DiceCup(6);
        $this->assertFalse($diceCup->isEmptyCup());
    }

    public function testIsEmptyCup()
    {
        $diceCup = new DiceCup(0);
        $this->assertTrue($diceCup->isEmptyCup());
    }

    public function testGetAllDice()
    {
        $diceCount = 6;
        $diceCup = new DiceCup($diceCount);

        $allDice = $diceCup->getAllDice();

        $this->assertEquals($diceCount, $allDice->count());
        $this->assertTrue($diceCup->isEmptyCup());
    }

    public function testAddMultipleDice()
    {
        $diceCount = 6;
        $diceCup = new DiceCup($diceCount);

        $newTwoDice = collect([new Dice(), new Dice()]);

        $allDice = $diceCup->peekAtAllDice();
        $this->assertEquals($diceCount, $allDice->count());

        $expectedCount = $newTwoDice->count() + $diceCount;

        $diceCup->addMultipleDice($newTwoDice);
        $allDice = $diceCup->peekAtAllDice();

        $this->assertEquals($expectedCount, $allDice->count());
    }

    public function testFillDice()
    {
        $diceCountToAdd = 6;
        $diceCup = new DiceCup(0);

        $diceCup->fillDice($diceCountToAdd);

        $allDice = $diceCup->peekAtAllDice();   
        $this->assertEquals($diceCountToAdd, $allDice->count());     
    }

    public function testAddDice()
    {
        $diceCup = new DiceCup(0);
        $diceCup->addDice(new Dice());

        $allDice = $diceCup->peekAtAllDice();   
        $this->assertEquals(1, $allDice->count());
    }
}
