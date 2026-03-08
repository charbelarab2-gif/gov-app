<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Office;
class DevSeeder extends Seeder
{
   public function run(): void
   {
       $municipality = Municipality::firstOrCreate(
           ['id' => 1],
           ['name' => 'Main Municipality']
       );
       Office::firstOrCreate(
           ['id' => 1],
           [
               'municipality_id' => $municipality->id,
               'name' => 'Main Office',
               'email' => 'office@test.com',
               'phone' => null,
               'address' => null,
               'is_active' => true,
           ]
       );
   }
}