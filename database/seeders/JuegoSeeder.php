<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Juego;

class JuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Juego::create([
            'titulo' => 'Counter Strike',
            'imagenJuegoURL' => 'https://ih1.redbubble.net/image.1123456637.4226/flat,750x,075,f-pad,750x1000,f8f8f8.jpg',
            'juegoURL' => 'https://blog.counter-strike.net/'
        ]);
        Juego::create([
            'titulo' => 'League of Legends',
            'imagenJuegoURL' => 'https://as01.epimg.net/meristation/imagenes/2019/08/07/cover/719414081565191040.jpg',
            'juegoURL' => 'https://www.leagueoflegends.com/es-es/'
        ]);
        Juego::create([
            'titulo' => 'Titanfall 2',
            'imagenJuegoURL' => 'https://m.media-amazon.com/images/I/51NdylVTJtL._AC_.jpg',
            'juegoURL' => 'https://www.origin.com/esp/es-es/store/titanfall/titanfall-2'
        ]);
        Juego::create([
            'titulo' => 'Fortnite',
            'imagenJuegoURL' => 'https://i.pinimg.com/474x/8c/e8/ab/8ce8aba0edcb78be32945243a3d9b4e6.jpg',
            'juegoURL' => 'https://www.epicgames.com/fortnite/es-ES/home'
        ]);
        Juego::create([
            'titulo' => 'Overwatch',
            'imagenJuegoURL' => 'https://static.wikia.nocookie.net/overwatch/images/c/ca/Overwatch_Portada.jpg/revision/latest?cb=20160523174229&path-prefix=es',
            'juegoURL' => 'https://playoverwatch.com/es-es/'
        ]);
    }
}
