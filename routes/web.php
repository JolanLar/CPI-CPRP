<?php

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
    return redirect('/connexion');
});

Route::get('/connexion', 'ConnexionController@formulaire');
Route::post('/connexion', 'ConnexionController@traitement');

Route::get('/gestionutilisateur','GestionUtilisateurController@lister');
Route::post('/gestionutilisateur','GestionUtilisateurController@creation');
Route::post('/gestionutilisateur/liste','GestionUtilisateurController@majBDD');
Route::post('/gestionutilisateur/supprimer','GestionUtilisateurController@supprimer');

Route::get('/gestioncompetence','GestionCompetenceController@lister');
Route::post('/gestioncompetence','GestionCompetenceController@creation');
Route::post('/gestioncompetence/liste','GestionCompetenceController@majBDD');
Route::post('/gestioncompetence/supprimer','GestionCompetenceController@supprimer');

Route::get('/gestioncompetencedetaillee','GestionCompetenceDetailleeController@lister');
Route::post('/gestioncompetencedetaillee','GestionCompetenceDetailleeController@creation');
Route::post('/gestioncompetencedetaillee/liste','GestionCompetenceDetailleeController@majBDD');
Route::post('/gestioncompetencedetaillee/supprimer','GestionCompetenceDetailleeController@supprimer');

Route::get('/gestionindicateurperformance','GestionIndicateurPerformanceController@lister');
Route::post('/gestionindicateurperformance/','GestionIndicateurPerformanceController@creation');
Route::post('/gestionindicateurperformance/liste1','GestionIndicateurPerformanceController@majBDD1');
Route::post('/gestionindicateurperformance/liste2','GestionIndicateurPerformanceController@majBDD2');
Route::post('/gestionindicateurperformance/supprimer','GestionIndicateurPerformanceController@supprimer');

Route::get('/gestiondonnee','GestionDonneeController@lister');
Route::post('/gestiondonnee','GestionDonneeController@creation');
Route::post('/gestiondonnee/liste','GestionDonneeController@majBDD');
Route::post('/gestiondonnee/donnee','GestionDonneeController@affichagedonnee');

Route::get('/gestionclasse','GestionClasseController@lister');
Route::post('/gestionclasse','GestionClasseController@creation');
Route::get('/gestionclasse/supprimer/{id}','GestionClasseController@supprimer');
Route::post('/gestionclasse/liste','GestionClasseController@majBDD');

Route::get('/gestioncreationclasse','GestionCreationClasseController@lister');
Route::post('/gestioncreationclasse/liste','GestionCreationClasseController@majBDD');

Route::get('/gestionsavoir','GestionSavoirController@lister');

Route::get('/eleve', 'EleveController@Aff');
Route::post('/eleve', 'ConnexionController@traitement');
Route::post('/eleve/recuperernote', 'EleveController@note');


Route::get('/professeur/cs', 'ProfesseurCSController@lister');


Route::get('/professeur/tls', 'ProfesseurTLSController@lister');
Route::post('/professeur/tls', 'ProfesseurTLSController@noter');
Route::post('/professeur/tls/liste', 'ProfesseurTLSController@majBDD');
Route::post('/professeur/tls/recuperernote', 'ProfesseurTLSController@recuperernote');

Route::get('/professeur/rtc', 'ProfesseurController@RelationTC');
Route::get('/professeur/rcs', 'ProfesseurController@RelationCS');

Route::get('/professeur/vr', 'ProfesseurController@VisuPro');
Route::post('/professeur/vr', 'ProfesseurController@VisuPro');
