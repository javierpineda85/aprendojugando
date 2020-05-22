<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class, 3)->create(); // crea 3 grupos 

        // ahora creamos 3 niveles

        factory(App\Level::class)->create(['name' => 'Oro']);
        factory(App\Level::class)->create(['name' => 'Plata']);
        factory(App\Level::class)->create(['name' => 'Bronce']);

        //Ahora creamos 10 usuarios
        
        factory(App\User::class,10)->create()->each(function ($user) { 

            $profile = $user->profile()->save(factory(App\Profile::class)->make());

            $profile ->location()->save(factory(App\Location::class)->make());

            $user->groups()->attach($this->array(rand(1,3)));
            

            $user->image()->save(factory(App\Image::class)->make([
                'url' => 'https://lorempixel.com/90/90'
            ]));

        });

        
        factory(App\Category::class, 4)->create(); // crea 4 categorias
        factory(App\Tag::class, 12)->create(); // crea 12 etiquetas

        // aqui crea 40 post
        
        factory(App\Post::class, 40)->create()->each(function($post){

            $post->image()->save(factory(App\Image::class)->make()); //crea una imagen
            $post->tags()->attach($this->array(rand(1,12))); //crea entre 1 y 12 tags

            $number_comments=rand(1,6); // crea con el FOR entre 1 y 6 comentarios 

            for ($i=1; $i < $number_comments; $i++) {  
                $post->comments()->save(factory(App\Comment::class)->make());
            }
        });

        factory(App\Video::class, 40)->create()->each(function($video){

            $video->image()->save(factory(App\Image::class)->make());
            $video->tags()->attach($this->array(rand(1,12)));

            $number_comments=rand(1,6);

            for ($i=1; $i < $number_comments; $i++) { 
                $video->comments()->save(factory(App\Comment::class)->make());
            }
        });
    }

    // esta funcion permite ser utilizada anteriormente para crear arrays con un
    // numero max determinado por los parametros que pasen las funciones $this->array(rand())
    public function array($max){
        $values=[];

        for ($i=1; $i < $max ; $i++) { 
            $values[]= $i;
        }

        return $values;
    }
}
