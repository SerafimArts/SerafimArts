<?php
use Analogue\ORM\System\Manager;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Domains\User\Group;


/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('ru_RU');

        $this->call(GroupsSeeder::class);
        $this->call(UserSeeder::class);

        die;


        Model::unguarded(function() use ($faker) {

            


            // Users
            User::truncate();
            User::create([ 'name' => 'Serafim', 'email' => 'nesk@xakep.ru',
                'password' => '9526598abc', 'group_id' => 3 ]);

            foreach (range(0, mt_rand(20, 100)) as $i) {
                User::create([
                    'name'          => ($name = $faker->firstName),
                    'email'         => mb_strtolower($faker->email),
                    'password'      => mt_rand(0, 999999) . microtime(),
                    'group_id'      => 2,
                ]);

                echo '> user ' . $name . "\n";
                flush();
            }


            // Article
            echo "\n";
            Article::truncate();
            foreach (range(0, mt_rand(7, 20)) as $i) {
                $tags = [];
                foreach (range(0, mt_rand(7, 20)) as $j) {
                    $tags[] = $faker->sentence(mt_rand(1, 2));
                }

                Article::create([
                    'url'               => Slug::make($title = $faker->sentence(mt_rand(1, 6))),
                    'title'             => $title,
                    'user_id'           => 1,
                    'is_draft'          => (bool)mt_rand(0, 1),
                    'content'           => $content = $faker->paragraph(mt_rand(2, 6)),
                    'content_rendered'  => $content,
                    'preview'           => substr($content, 0, 255),
                    'tags'              => $tags,
                    'publish_at'        => Carbon::now()
                        ->addHour(mt_rand(0, 99))
                        ->addMinute(mt_rand(0, 99))
                        ->addSecond(mt_rand(0, 99))
                        ->subHour(mt_rand(0, 99))
                        ->subMinute(mt_rand(0, 99))
                        ->subSecond(mt_rand(0, 99)),
                    'uuid'              => Uuid::v4(),
                ]);
                echo '> article ' . $title . "\n";
            }


            // Category
            echo "\n";
            Category::truncate();
            foreach (range(0, mt_rand(7, 20)) as $i) {
                Category::create([
                    'title' => ($title = $faker->sentence(mt_rand(1, 6))),
                    'description' => $content = $faker->paragraph(1),
                ]);
                echo '> category ' . $title . "\n";
            }


            // Comments and likes
            echo "\n";
            Comment::truncate();
            Like::truncate();

            $users = User::count();
            /** @var Article $article */
            foreach (Article::all() as $article) {
                foreach (range(0, mt_rand(0, 100)) as $i) {
                    Comment::create([
                        'user_id'       => mt_rand(1, $users - 1),
                        'article_id'    => $article->id,
                        'content'       => ($content = $faker->paragraph(mt_rand(1, 6))),
                        'approved'      => (mt_rand(0, 5) !== 5),
                        'created_at'    => Carbon::now()
                            ->subHour(mt_rand(0, 500))
                            ->subMinute(mt_rand(0, 500))
                            ->subSecond(mt_rand(0, 500))
                    ]);
                    echo '> comment ' . $content . "\n";
                }

                foreach (range(0, $users) as $u) {
                    if (mt_rand(0, 2) >= 2) {
                        $like = Like::create([
                            'user_id' => $u,
                            'article_id' => $article->id,
                            'rate' => mt_rand(0, 1) ? 1 : -1
                        ]);
                        echo '> like ' . $like->rate . "\n";
                    }
                }
            }
        });
    }
}
