<?php
/**
 * Class ArticleCategorySeeder.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

/**
 * Class ArticleCategorySeeder
 */

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_category')->insert(
            [
                [
                    'article_id' => 1,
                    'category_id' => 1,
                ],
                [
                    'article_id' => 2,
                    'category_id' => 2,
                ],
                [
                    'article_id' => 3,
                    'category_id' => 3,
                ],
                [
                    'article_id' => 4,
                    'category_id' => 4,
                ],
                [
                    'article_id' => 5,
                    'category_id' => 5,
                ],
                [
                    'article_id' => 6,
                    'category_id' => 2,
                ],
                [
                    'article_id' => 7,
                    'category_id' => 3,
                ],
                [
                    'article_id' => 6,
                    'category_id' => 4,
                ],
                [
                    'article_id' => 9,
                    'category_id' => 5,
                ],
                [
                    'article_id' => 10,
                    'category_id' => 1,
                ],
                [
                    'article_id' => 11,
                    'category_id' => 2,
                ],
            ]
        );
    }
}
