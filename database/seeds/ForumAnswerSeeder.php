<?php

/**
 * Class ForumAnswerSeeder.
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
 * Class ForumAnswerSeeder
 */
class ForumAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_forum')->insert(
            [
                // Question-Answers
                [
                    'user_id' => 21,
                    'forum_id'  => 1,
                    'type'  => 'question',
                    'answer'  => null,
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 2,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 5,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 6,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 7,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 3,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 12,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 13,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 14,
                    'forum_id'  => 1,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Question-Answers
                [
                    'user_id' => 21,
                    'forum_id'  => 2,
                    'type'  => 'question',
                    'answer'  => null,
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 8,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 9,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor amet consectetur adipisicing elit eiuim sete eiu tempor incididunt.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 10,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 11,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 15,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 16,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor amet consectetur adipisicing elit eiuim sete eiu tempor incididunt.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 17,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 18,
                    'forum_id'  => 2,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Question-Answers
                [
                    'user_id' => 22,
                    'forum_id'  => 3,
                    'type'  => 'question',
                    'answer'  => null,
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 2,
                    'forum_id'  => 3,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 5,
                    'forum_id'  => 3,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor amet consectetur adipisicing elit eiuim sete eiu tempor incididunt.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 6,
                    'forum_id'  => 3,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 7,
                    'forum_id'  => 3,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 19,
                    'forum_id'  => 3,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 20,
                    'forum_id'  => 3,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor amet consectetur adipisicing elit eiuim sete eiu tempor incididunt.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Question-Answers
                [
                    'user_id' => 23,
                    'forum_id'  => 4,
                    'type'  => 'question',
                    'answer'  => null,
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 2,
                    'forum_id'  => 4,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 5,
                    'forum_id'  => 4,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor amet consectetur adipisicing elit eiuim sete eiu tempor incididunt.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 6,
                    'forum_id'  => 4,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 7,
                    'forum_id'  => 4,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Question-Answers
                [
                    'user_id' => 24,
                    'forum_id'  => 5,
                    'type'  => 'question',
                    'answer'  => null,
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 2,
                    'forum_id'  => 5,
                    'type'  => 'answer',
                    'answer'  => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for will uncover many web sites still in their infancy.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 5,
                    'forum_id'  => 5,
                    'type'  => 'answer',
                    'answer'  => 'Lorem ipsum dolor amet consectetur adipisicing elit eiuim sete eiu tempor incididunt.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 6,
                    'forum_id'  => 5,
                    'type'  => 'answer',
                    'answer'  => 'Amet consectetur adipisicing eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 7,
                    'forum_id'  => 5,
                    'type'  => 'answer',
                    'answer'  => 'Eliteiuim sete eiu tempor incidit utoreas etnalom dolore maena aliqua udiminimate veniam quis norud exercita ullamco laboris nisi aliquip commodo consequat duis aute irure.',
                    'liked'  => null,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
