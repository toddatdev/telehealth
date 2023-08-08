<?php

/**
 * Class ArticleSeeder.
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
 * Class ArticleSeeder
 */
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert(
            [
                [
                    'title' => 'Alcohol may be less harmful for people over 50',
                    'slug'  => 'alcohol-may-be-less-harmful-for-people-over-50',
                    'author_id'  => 1,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569220037-012.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '1',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'These common drugs may increase dementia risk',
                    'slug'  => 'these-common-drugs-may-increase-dementia-risk',
                    'author_id'  => 2,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569246568-img-01.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => '6 innovations from Future Healthcare 2019',
                    'slug'  => '6-innovations-from-future-healthcare-2019',
                    'author_id'  => 5,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569246980-Untitled-1_0005_Layer-3.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Is high blood pressure always bad?',
                    'slug'  => 'is-high-blood-pressure-always-bad',
                    'author_id'  => 6,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569246869-bloogs-1.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '1',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Hypertension treatment may slow down Alzheimer\'s progression',
                    'slug'  => 'hypertension-treatment-may-slow-down-alzheimers-progression',
                    'author_id'  => 7,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569246934-Untitled-1_0003_Layer-5.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Intermittent fasting boosts health by strengthening daily rhythms',
                    'slug'  => 'intermittent-fasting-boosts-health-by-strengthening-daily-rhythms',
                    'author_id'  => 7,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569246934-Untitled-1_0003_Layer-5.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '1',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Processed foods lead to weight gain, but it\'s about more than calories',
                    'slug'  => 'processed-foods-lead-to-weight-gain-but-its-about-more-than-calories',
                    'author_id'  => 8,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569247064-Untitled-1_0006_Layer-2.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Study reveals fiber we should eat to prevent disease',
                    'slug'  => 'study-reveals-how-much-fiber-we-should-eat-to-prevent-disease',
                    'author_id'  => 9,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569247133-bloogs-5.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'These diets and supplements may not really protect the heart',
                    'slug'  => 'these-diets-and-supplements-may-not-really-protect-the-heart',
                    'author_id'  => 10,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569247162-bloogs-7.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Common food additive may impact gut bacteria, increase anxiety',
                    'slug'  => 'common-food-additive-may-impact-gut-bacteria-increase-anxiety',
                    'author_id'  => 11,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569247191-bloogs-8.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Plant based diet may reduce cardiovascular death risk by 32%',
                    'slug'  => 'plant-based-diet-may-reduce-cardiovascular-death-risk-by-32',
                    'author_id'  => 11,
                    'tags'  => null,
                    'views'  => null,
                    'likes'  => null,
                    'description'  => '<div class=" dc-para99">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed utem peiatis undesieu omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaqueiu ipsaquae abes illo inventore veritatisetm quasitea architecto beatae vitae dictaed quia consequuntur magni dolores eos quist ratione ceatem sequei nesciunt. Neque porro quam est qui dolorem ipsum quia dolor sitem amet consectetur adipisci velit sed quianon quam eius modi tempora incidunt ut labore etneise dolore magnam aliquam quaerat.</p>
                    <div class="d-flex justify-content-around mx-auto dc-99-section flex-column flex-sm-row">
                    <div class="align-self-center">&nbsp;</div>
                    <div class="dc-99-content align-self-center pt-sm-0"><em>&rdquo; Adipisicing elit, sed dote eiusmod tempor olak magna aliqua okaeine mikaru itniesce lokate ibsiam.&rdquo;</em></div>
                    </div>
                    <div class="dc-para-content">
                    <p class="dc-para">ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiate nulla pariatur teur sint occaecat cupidatat ainon proident sunt in culpa qui.</p>
                    </div>
                    </div>
                    </div>
                    <div class=" dc-section dc-py-15">
                    <figure class="m-0 dc-water-woman"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-02-1.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em>As per current survey perspiciatis unde omnis iste natus error sit voluptatem.</em></div>
                    </div>
                    <div class="dc-content">
                    <div>
                    <p class="dc-para dc-para2">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row">
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-03.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    <div class="dc-content align-self-center dc-p-flex dc-flex ">
                    <div class="">
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="d-flex dc-py-15 flex-column flex-xl-row ">
                    <div class="dc-content align-self-center order-last order-xl-first dc-flex dc-p-flex2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsaae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-pt-21">
                    <p class="dc-para mb-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consecteture adipisci velit, sed quia non numquam eius modi.</p>
                    </div>
                    </div>
                    <div class="dc-section">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-04.jpg" alt="Image Description" /></figure>
                    <div class="dc-section-content text-center"><em class="d-block">As per current survey perspiciatis.</em></div>
                    </div>
                    </div>
                    <div class="dc-py-para">
                    <p class="dc-para m-0">Excepteur sint eccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut pspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illo inventore veritatis et qaenuasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="dc-video dc-py-15">
                    <figure class="m-0"><img src="http://amentotech.com/projects/doctreat/wp-content/uploads/2019/09/img-01-1.jpg" alt="image description" /></figure>
                    </div>
                    <div class="dc-content dc-my2">
                    <div>
                    <p class="dc-para">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aiam eaque ipsa quae ab illoam inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit asper aut odit aut fugit occaecat cupidatat non proident, sunt in culpa qui.</p>
                    </div>
                    <ul>
                    <li>Nemo enim ipsam voluptatem quia</li>
                    <li>Adipisci velit, sed quia non numquam eius modi tempora</li>
                    <li>Eaque ipsa quae ab illo inventore veritatis et quasi architecto</li>
                    <li>Qui dolorem ipsum quia dolor sit amet</li>
                    </ul>
                    <div class="dc-para-padding">
                    <p class="dc-para m-0">Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi quaerat voluptatem.</p>
                    </div>
                    </div>',
                    'image' => '1569058787-Untitled-1_0006_Layer-2.jpg',
                    'excerpt' => 'Excepteur sint occaecat cupidatat non proident, su',
                    'is_featured' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
