<?php

/**
 * Class ForumQuestionSeeder.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class ForumQuestionSeeder
 */
class ForumQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forums')->insert(
            [
                [
                    'question_title' => 'My stool smells extremely foul, almost rancid. What could be wrong?',
                    'slug'  => 'my-stool-smells-extremely-foul-almost-rancid-what-could-be-wrong',
                    'speciality_id'  => 3,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Symptoms of indigestion',
                    'slug'  => 'symptoms-of-indigestion',
                    'speciality_id'  => 1,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Intestinal Amoeba - What is my responsibility in limiting the risk of spreading it to others?',
                    'slug'  => 'intestinal-amoeba-what-is-my-responsibility-in-limiting-the-risk-of-spreading-it-to-others',
                    'speciality_id'  => 2,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Constipation - Magnesium Citrate',
                    'slug'  => 'constipation-magnesium-citrate',
                    'speciality_id'  => 4,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'For those who have used Mag Cigrate',
                    'slug'  => 'for-those-who-have-used-mag-cigrate',
                    'speciality_id'  => 3,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Blood in poop? What is it most likely?',
                    'slug'  => 'blood-in-poop-what-is-it-most-likely',
                    'speciality_id'  => 5,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Stomach problems for 3 months without any known cause (and getting desperate)',
                    'slug'  => 'stomach-problems-for-3-months-without-any-known-cause-and-getting-desperate',
                    'speciality_id'  => 6,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Should I see a doctor? Please help',
                    'slug'  => 'should-i-see-a-doctor-please-help',
                    'speciality_id'  => 4,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'My name is Donnamarie, I\'ve had gastroparesis for about 13 years, constipation too.',
                    'slug'  => 'my-name-is-donnamarie-ive-had-gastroparesis-for-about-13-years-constipation-too',
                    'speciality_id'  => 4,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'How do I get my doctor to take me seriously?',
                    'slug'  => 'how-do-i-get-my-doctor-to-take-me-seriously',
                    'speciality_id'  => 4,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'question_title' => 'Back Pain causing Anxiety',
                    'slug'  => 'back-pain-causing-anxiety',
                    'speciality_id'  => 8,
                    'question_description'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborume Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
