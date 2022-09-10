<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\RedacteurController;
use App\Http\Controllers\CorrecteurController;
use App\Http\Controllers\TraducteurController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');    
});

// Admins Route
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/gestion/responsables', [AdminController::class, 'getResponsable'])->name('gestion.responsables');
Route::get('/gestion/collaborateurs',  [AdminController::class, 'getCollaborateur'])->name('gestion.collaborateurs');
Route::post('/gestion/responsables/create', [AdminController::class, 'createResponsable'])->name('gestion.responsables.store');
// Route::get('/gestion/responsables/edit/{id}', [ResponsableController::class, 'edit'])->name('gestion.responsables.edit');
Route::put('/gestion/responsables/update/{id}', [AdminController::class, 'updateResponsable'])->name('gestion.responsables.update');
Route::delete('/gestion/responsables/delete/{id}', [AdminController::class, 'destroyResponsable'])->name('gestion.responsables.delete');
Route::get('/paiement/responsables', [AdminController::class, 'priceResp'])->name('paiement.responsables');
Route::post('/gestion/collaborateurs/create', [AdminController::class, 'createCollaborateur'])->name('gestion.collaborateurs.store');
// Route::get('/gestion/collaborateurs/edit/{id}', [CollaborateurController::class, 'edit'])->name('gestion.collaborateurs.edit');
Route::put('/gestion/collaborateurs/update/{id}', [AdminController::class, 'updateCollaborateur'])->name('gestion.collaborateurs.update');
Route::delete('/gestion/collaborateurs/delete/{id}', [AdminController::class, 'destroyCollaborateur'])->name('gestion.collaborateurs.delete');
Route::get('/paiement/collaborateurs/employes', [AdminController::class, 'priceEmp'])->name('paiement.collaborateurs.employes');
Route::get('/paiement/collaborateurs/independants', [AdminController::class, 'pigistes'])->name('paiement.collaborateurs.independants');
Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.message');
//  end route admin

// Routes Responsables
Route::post('/responsable/create/collaborateur', [ResponsableController::class, 'store'])->name('res.create.collaborateur');
Route::get('/articles/public', [ResponsableController::class, 'articlesPublic'])->name('articles.public');
Route::get('/articles/new', [ResponsableController::class, 'articlesNew'])->name('articles.new');
Route::get('/collaborateurs/salaries', [ResponsableController::class, 'allCollaborateurs'])->name('collaborateurs.salaries');
Route::get('/collaborateurs/independant', [ResponsableController::class, 'allPigistes'])->name('collaborateurs.indep');
Route::post('/create/categorie', [ResponsableController::class, 'createCat'])->name('create.categorie');
Route::post('/create/pigiste', [ResponsableController::class, 'createPigiste'])->name('create.pigiste');
Route::delete('/delete/pigiste/{id}', [ResponsableController::class, 'destroyPigiste'])->name('delete.pigiste');
Route::put('/update/pigiste/{id}', [ResponsableController::class, 'updatePigiste'])->name('update.pigiste');
Route::put('/update/score/{id}', [ResponsableController::class, 'updateScore'])->name('update.score');
Route::post('/create/article', [ResponsableController::class, 'createArticle'])->name('create.article');
Route::post('/add/tache/redacteur/{id}', [ResponsableController::class, 'addTachesRed'])->name('add.tache.redacteur');
Route::post('/add/tache/correcteur/{id}', [ResponsableController::class, 'addTachesCor'])->name('add.tache.correcteur');
Route::post('/add/tache/traducteur/{id}', [ResponsableController::class, 'addTachesTrad'])->name('add.tache.traducteur');
Route::post('/add/pig/article/{id}', [ResponsableController::class, 'addTachesPig'])->name('add.pig.article');
// Route::delete('/delete/tache/{id}', [ResponsableController::class, 'destroyTache'])->name('delete.tache');
Route::delete('/delete/article/{id}', [ResponsableController::class, 'destroyArticle'])->name('delete.article');
Route::get('/show/tache/{id}', [ResponsableController::class, 'show'])->name('res.show.tache');
Route::put('/valider/tache/{id}', [ResponsableController::class, 'valTache'])->name('res.valider.tache');
Route::put('/refuser/tache/{id}', [ResponsableController::class, 'refTache'])->name('res.refuser.tache');
Route::put('/publie/article/{id}', [ResponsableController::class, 'publieArticle'])->name('publie.article');

// End Routes Responsables

// Routes Redacteur
Route::get('/redacteur/articles/public', [RedacteurController::class, 'allArticles'])->name('red.all.articles');
Route::get('/redacteur/articles/new', [RedacteurController::class, 'newArticles'])->name('red.new.articles');
Route::get('/redacteur/create/article/{id}', [RedacteurController::class, 'create'])->name('red.create.article');
Route::put('/redacteur/store/article/{id}', [RedacteurController::class, 'store'])->name('red.store.article');
Route::get('/redacteur/edit/article/{id}', [RedacteurController::class, 'edit'])->name('red.edit.article');
Route::put('/redacteur/update/article/{id}', [RedacteurController::class, 'update'])->name('red.update.article');
Route::put('/redacteur/tache/fini/{id}', [RedacteurController::class, 'tacheFini'])->name('red.tache.fini');

// End Routes Redacteur

// Route Correcteur
Route::get('/correcteur/show/tache/{id}', [CorrecteurController::class, 'show'])->name('correcteur.show.tache');
Route::put('/correcteur/edit/tache/{id}', [CorrecteurController::class, 'edit'])->name('correcteur.edit.tache');
Route::put('/correcteur/tache/fini/{id}', [CorrecteurController::class, 'tacheFini'])->name('correcteur.tache.fini');

// End Route Correcteur

// Route Traducteur

Route::get('/traducteur/show/tache/{id}', [TraducteurController::class, 'show'])->name('traducteur.show.tache');
Route::put('/traducteur/edit/tache/{id}', [TraducteurController::class, 'edit'])->name('traducteur.edit.tache');
Route::put('/traducteur/tache/fini/{id}', [TraducteurController::class, 'tacheFini'])->name('traducteur.tache.fini');


// End Route Traducteur