<?php
use App\User;
use App\Models\Profession;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;    # Importa Facade DB usando su namespace

class UserSeeder extends Seeder
{
    /**
     * Run the database <<seeds>                                                                                                                                                                                                                                            </seeds> class="">                                                                                                                                                            </seeds>
     *
     * @return void
     */
    public function run()
    {
        /* Realiza inserciones a nuestra tabla 'users' usando Model Factories usando el Helper factory() de Laravel */
        factory( User :: class ) -> create([
            'name' => 'Juan Carlos Jiménez Gutiérrez',
            'email' => 'jcjimenez29@misena.edu.co',
            'password' => bcrypt( 'laravel' ),            # bcrypt(): Helper de Laravel para encriptar contraseñas
            'profession_id' => Profession :: whereTitle( 'BackEnd Developer' ) -> value( 'id' ),   # Insertamos un ID existente en la tabla 'professions'
            'is_admin' => true
        ]);
        factory( User :: class ) -> create([
            'profession_id' => Profession :: whereTitle( 'FrontEnd Developer' ) -> value( 'id' )   # Insertamos un ID existente en la tabla 'professions'
        ]);
        factory( User :: class ) -> create();

    }
}
