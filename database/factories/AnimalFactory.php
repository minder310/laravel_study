<?php
// 製作假資料的頁面。
namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
// 宣告使用Animal這個model。
use App\Models\Animal;
// str是laravel內建的字串功能。可以處裡很多字串的功能。
use Illuminate\Support\Str;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Animal::class;
    public function definition()
    {
        
        return [
            //numberBetween是隨機產生1~3數字的功能。
            'type_id' => $this->faker->numberBetween(1,3),
            //name是隨機產生名字的功能。
            'name' => $this->faker->name(),
            //date是隨機產生日期的功能。
            'birthday' => $this->faker->date(),
            //city是隨機產生城市的功能。
            'area' => $this->faker->city(),
            //boolean是隨機產生布林值的功能。
            'fix' => $this->faker->boolean(),
            //text是隨機產生文字的功能。
            'descripiton' => $this->faker->text(),
            //text是隨機產生文字的功能。
            'personality' => $this->faker->text(),
            //隨機綁定user_id的資料。
            'user_id' => User::all()->random()->id,
        ];
    }
}
