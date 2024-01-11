<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Mgmt\Conveyor;
use Carbon\Carbon;

class SeedConveyors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Conveyor::factory()->count(5)->create();
        // return;

        // Belt Conveyors 
        Conveyor::create([
            'name' => 'Belt Conveyors',
            'modelno' => 'belt-conveyors',
            'image' => 'belt.jpg',
            'desc' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi illo consectetur ipsum explicabo cum fugit facere adipisci molestias mollitia aspernatur eligendi porro, quidem asperiores esse! Harum praesentium esse aspernatur adipisci.',
            
            'application' => '',
            'width' => '',
            'weight' => '',
            'load' => '',
            'speed' => '',
            'movement' => '',
        ]);

        // Foundry Conveyors
        Conveyor::create([
            'name' => 'Foundry Conveyors',
            'modelno' => 'foundry-conveyors',
            'image' => 'foundry.jpg',
            'desc' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi illo consectetur ipsum explicabo cum fugit facere adipisci molestias mollitia aspernatur eligendi porro, quidem asperiores esse! Harum praesentium esse aspernatur adipisci.',
            
            'application' => '',
            'width' => '',
            'weight' => '',
            'load' => '',
            'speed' => '',
            'movement' => '',
        ]);

        // Roller Conveyors
        Conveyor::create([
            'name' => 'Roller Conveyors',
            'modelno' => 'roller-conveyors',
            'image' => 'roller.jpg',
            'desc' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi illo consectetur ipsum explicabo cum fugit facere adipisci molestias mollitia aspernatur eligendi porro, quidem asperiores esse! Harum praesentium esse aspernatur adipisci.',
            
            'application' => '',
            'width' => '50 mm to 2000 mm',
            'weight' => '',
            'load' => '',
            'speed' => '',
            'movement' => '',
        ]);

        // Scrap Chip Handling Conveyor
        Conveyor::create([
            'name' => 'Scrap Chip Handling Conveyor',
            'modelno' => 'scrap-chip-conveyor',
            'image' => 'scrap-chip.jpg',
            'desc' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi illo consectetur ipsum explicabo cum fugit facere adipisci molestias mollitia aspernatur eligendi porro, quidem asperiores esse! Harum praesentium esse aspernatur adipisci.',
            
            'application' => '',
            'width' => '',
            'weight' => '',
            'load' => '',
            'speed' => '',
            'movement' => '',
        ]);

        // Scrap Conveyor
        Conveyor::create([
            'name' => 'Scrap Conveyor',
            'modelno' => 'scrap-conveyor',
            'image' => 'scrap.jpg',
            'desc' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi illo consectetur ipsum explicabo cum fugit facere adipisci molestias mollitia aspernatur eligendi porro, quidem asperiores esse! Harum praesentium esse aspernatur adipisci.',
            
            'application' => '',
            'width' => '',
            'weight' => '',
            'load' => '',
            'speed' => '',
            'movement' => '',
        ]);

        // Slat Conveyor 
        Conveyor::create([
            'name' => 'Slat Conveyor',
            'modelno' => 'slat-conveyor',
            'image' => 'slat.jpg',
            'desc' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi illo consectetur ipsum explicabo cum fugit facere adipisci molestias mollitia aspernatur eligendi porro, quidem asperiores esse! Harum praesentium esse aspernatur adipisci.',
            
            'application' => '',
            'width' => '',
            'weight' => '',
            'load' => '',
            'speed' => '',
            'movement' => '',
        ]);
    }
}
