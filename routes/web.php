<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



Route::get('/', HomeController::class);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|



//ruta para mostrar el listado de registros
Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');
//ruta para mostrar el formulario para crear un registro
Route::get('/posts/create', [PostController::class, 'create'])
        ->name('posts.create');
//ruta para guardar un registro
Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store');
//ruta para mostrar un registro
Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.show');
//ruta para mostrar un formulario para editar un registro
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->name('posts.edit');
//ruta para actualizar un registro
Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.update');
//ruta para eliminar un registro
Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy');
*/

// Si usamos las conceciones de nombres en laravel podemos ahorrarnos muchas lineas de codigo
// Route::resource('posts', PostController::class)
//     ->only(['index','show','create','store','edit','update','destroy']);
// Esto es opcional para especificar si solamente se desea algunos metodos

// Si usamos esta convención podemos crear un crud exceptuando las rutas que decidamos exceptuar
// Route::resource('posts', PostController::class)
//         ->except(['create','edit']);
// Si usamos apiResource no crea el metodo create ni edit
// Route::apiResource('posts', PostController::class);

// Si queremos cambiar el nombre de la variable que pasamos, sin perder la referencia a la variable ya creada podemosusar parameters
// para cambiar el mombre de la url usamos names 
Route::resource('articles', PostController::class)
        ->parameters(['articles' => 'post'])
        ->names('posts');

// Si queremos que en lugar crear un crud con nombre en ingles (create, edit, etc), debemos hacer uso de un provider
// ejemplo, esto va en RouteServiceProvider en la función root
// Route::resourceVerbs([
//         'create' => 'crear',
//         'edit' => 'editar'
//     ]);


#########################################################
// Nos permite tener conjuntos de verbos para una misma ruta
// Route::match(['get', 'post'], '/contacto', function () {
//     return "hola desde la pagina de contacto usando el metodo POST o GET";
// });
#########################################################
// en los casos donde tengamos rutas similares debemos colocarlas antes de las rutas dinamicas
#########################################################
// Route::get('/cursos/informacion', function(){
//     return "Hola desde información";
// })->name('cursos.informacion');
#########################################################
#########################################################
// de esta forma pasamos parametros por una ruta
// Route::get('/cursos/{curso}', function($curso){
//     return "Bienvenido al curso: $curso";
// });
#########################################################
// Para multiples parametros basta con agregarlo y pasarlo como variable 
// si queremos que uno de los paramtros sea opcional podemos agregar:? 
// y en las variables asignarle un valor por defecto
// podemos proteger nuestras rutas limitando el tipo de dato que deseamos aceptar con where y una expresion regular
#########################################################
// Route::get('/cursos/{curso}/{categoria?}', function($curso, $categoria = null){
//     if($categoria){
//         return "Bienvenido al curso: $curso de la categoria: $categoria";
//     }else{
//         return "Bienvenido al curso: $curso"; 
//     }
// })->whereAlpha('curso');
// ->where('curso', '[a-zA-Z]+');
// podemos hacer de la forma clasica  o podemos eliminar la expresion regular y agregar whereAlpha
#########################################################
#########################################################
// Route::get('/cursos/{id}', function($id){
//     return "Bienvenido al curso con id: $id";
// })->name('cursos.show');
#########################################################

// para poder visualizar todas las rutas que tengamos en nuestra aplicación

// php artisan route:list  ||  php artisan r:l

// y para retornar un solo tipo de rutas

// php artisan r:l --path=curso

// para retornar todas las rutas menos las que hayan sido instaladas por un paquete

// php artisan r:l --except-vendor -v

// para retornar todas las rutas  que hayan sido instaladas por un paquete

// php artisan r:l --only-vendor -v

// para optimizar un sitio ya en producción  podemos usar los comandos 
// php artisan route:cache
// y para limpiar
// php artisan route:clear


// Para poder organizar mejor la rutas laravel nos ofrece los grupos de rutas

Route::prefix('posts')->name('posts.')->controller(PostController::class)->group(function(){
        //ruta para mostrar el listado de registros
        Route::get('/', 'index')->name('index');
        //ruta para mostrar el formulario para crear un registro
        Route::get('/create','create')->name('create');
        //ruta para guardar un registro
        Route::post('/', 'store')->name('store');
        //ruta para mostrar un registro
        Route::get('/{post}', 'show')->name('show');
        //ruta para mostrar un formulario para editar un registro
        Route::get('/{post}/edit', 'edit')->name('edit');
        //ruta para actualizar un registro
        Route::put('/{post}', 'update')->name('update');
        //ruta para eliminar un registro
        Route::delete('/{post}', 'destroy')->name('destroy');

});