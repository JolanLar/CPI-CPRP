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

Use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return redirect('/connexion');
});

// Page de connexion
Route::get('/connexion', 'ConnexionController@formulaire');
Route::post('/connexion', 'ConnexionController@traitement');

// Gestion de l'impression
Route::get('/impressionLivret/{id}/l', 'ImpressionController@imprimerLivret');

// L'utilisateur est un Administrateur
Route::get('/gestionutilisateur','GestionUtilisateurController@lister');
Route::post('/gestionutilisateur','GestionUtilisateurController@creation');
Route::post('/gestionutilisateur/liste','GestionUtilisateurController@majBDD');
Route::post('/gestionutilisateur/supprimer','GestionUtilisateurController@supprimer');


Route::get('/gestionnotemax', 'GestionNoteMaxController@lister');
Route::post('/gestionnotemax/recup', 'GestionNoteMaxController@recuperernote');
Route::post('/gestionnotemax', 'GestionNoteMaxController@noter');


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
Route::post('/gestioncreationclasse','GestionCreationClasseController@creation');
Route::post('/gestioncreationclasse/liste','GestionCreationClasseController@majBDD');
Route::post('/gestioncreationclasse/delete','GestionCreationClasseController@delete');

Route::get('/gestionsavoir','GestionSavoirController@lister');
Route::post('/gestionsavoir', 'GestionSavoirController@creation');
Route::post('/gestionsavoir/savoirs', 'GestionSavoirController@savoirs');
Route::post('/gestionsavoir/delete', 'GestionSavoirController@delete');

Route::get('/gestionsavoirdetaille','GestionSavoirDetailleController@lister');
Route::post('/gestionsavoirdetaille', 'GestionSavoirDetailleController@creation');
Route::post('/gestionsavoirdetaille/savoirsdetaille', 'GestionSavoirDetailleController@savoirsdetaille');
Route::post('/gestionsavoirdetaille/creation', 'GestionSavoirDetailleController@creation');
Route::post('/gestionsavoirdetaille/delete', 'GestionSavoirDetailleController@delete');
Route::post('/gestionsavoirdetaille/liste', 'GestionSavoirDetailleController@majBDD');

Route::get('/gestionsoussavoirdetaille','GestionSousSavoirDetailleController@lister');
Route::post('/gestionsoussavoirdetaille', 'GestionSousSavoirDetailleController@creation');
Route::post('/gestionsoussavoirdetaille/savoirsdetaille', 'GestionSousSavoirDetailleController@savoirsdetaille');
Route::post('/gestionsoussavoirdetaille/soussavoirsdetaille', 'GestionSousSavoirDetailleController@soussavoirsdetaille');
Route::post('/gestionsoussavoirdetaille/creation', 'GestionSousSavoirDetailleController@creation');
Route::post('/gestionsoussavoirdetaille/delete', 'GestionSousSavoirDetailleController@delete');
Route::post('/gestionsoussavoirdetaille/liste', 'GestionSousSavoirDetailleController@majBDD');

Route::get('/gestionfiliere', 'GestionFiliereController@lister');
Route::post('/gestionfiliere/edit', 'GestionFiliereController@edit');
Route::post('/gestionfiliere/delete', 'GestionFiliereController@delete');
Route::post('/gestionfiliere/liste', 'GestionFiliereController@majBDD');
Route::post('/gestionfiliere/creation', 'GestionFiliereController@creation');

Route::get('/gestiontache', 'GestionTacheController@lister');
Route::post('/gestiontache/edit', 'GestionTacheController@edit');
Route::post('/gestiontache/listeActivite', 'GestionTacheController@listeActivite');
Route::post('/gestiontache/listeTache', 'GestionTacheController@listeTache');

// L'utilisateur est un élève
Route::get('/eleve', 'EleveController@AfficheHistogramme');
Route::get('/eleve/radar', 'EleveController@AfficheRadar');
Route::get('/eleve/livret', 'EleveController@AfficheLivret');
Route::post('/eleve', 'ConnexionController@traitement');
Route::post('/eleve/recuperernote', 'EleveController@note');

// L'utilisateur est un professeur

Route::get('/professeur/cs', 'ProfesseurCSController@lister');
Route::get('/professeur/tls', 'ProfesseurTLSController@lister');
Route::post('/professeur/tls', 'ProfesseurTLSController@noter');
Route::post('/professeur/tls/liste', 'ProfesseurTLSController@majBDD');
Route::post('/professeur/tls/recuperernote', 'ProfesseurTLSController@recuperernote');
Route::get('/professeur/rtc', 'ProfesseurController@RelationTC');
Route::get('/professeur/rcs', 'ProfesseurController@RelationCS');

// Professeur visualiser une progression

Route::get('/professeur/vr', 'ProfesseurVRController@lister');
Route::post('/professeur/vr/detail', function (){
    //Lors du submit du formulaire envoie vers un autre lien avec la variable de l'étudiant dans l'url
    return redirect('/professeur/vr/'. $_POST['etudiantidtls']  . '/histo');

});
Route::post('/professeur/vr/liste', 'ProfesseurVRController@majBDD');
Route::get('/professeur/vr/{idUtilisateur}/histo', 'ProfesseurVRController@getHistogramme');
Route::get('/professeur/vr/{idUtilisateur}/radar', 'ProfesseurVRController@getRadar');
Route::get('/professeur/vr/{idUtilisateur}/livret', 'ProfesseurVRController@getLivret');
Route::post('/professeur/vr/{idUtilisateur}/livret/recupNote', 'ProfesseurVRController@recupererNote');
Route::post('/professeur/vr', 'ProfesseurVRController@VisuPro');
