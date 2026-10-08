<?php

use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PageLegaleController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EntrepriseController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\DevisController as AdminDevisController;
use App\Http\Controllers\Admin\EquipeController as AdminEquipeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjetController as AdminProjetController;
use App\Http\Controllers\Admin\RendezVousController as AdminRendezVousController;
use App\Http\Controllers\Admin\PartenaireController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\TemoignageController as AdminTemoignageController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\PageLegaleController as AdminPageLegaleController;
use App\Http\Controllers\Admin\BanniereController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/suivi', [SuiviController::class, 'index'])->name('suivi.index');
Route::get('/suivi/resultats', [SuiviController::class, 'search'])->name('suivi.search');
Route::get('/recherche', [SearchController::class, 'index'])->name('recherche');

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/a-propos", [AboutController::class, "index"])->name("about");
Route::get("/equipe", [EquipeController::class, "index"])->name("equipe");
Route::get("/realisations", [ProjetController::class, "index"])->name("projets.index");
Route::get("/realisations/{projet:slug}", [ProjetController::class, "show"])->name("projets.show");
Route::post("/contact", [ContactController::class, "store"])->name("contact.store");
Route::get("/actualites", [ActualiteController::class, "index"])->name("actualites.index");
Route::get("/actualites/{actualite:slug}", [ActualiteController::class, "show"])->name("actualites.show");
Route::get("/devis", [DevisController::class, "create"])->name("devis.create");
Route::post("/devis", [DevisController::class, "store"])->name("devis.store");
Route::get("/rendez-vous", [RendezVousController::class, "create"])->name("rendez-vous.create");
Route::post("/rendez-vous", [RendezVousController::class, "store"])->name("rendez-vous.store");
Route::get("/faq", [FaqController::class, "index"])->name("faq");
Route::get("/legal/{type}", [PageLegaleController::class, "show"])->name("legal.show");
Route::post("/temoignages", [TemoignageController::class, "store"])->name("temoignages.store");
Route::get("/langue/{locale}", [LanguageController::class, "switch"])->name("lang.switch");

Route::prefix("admin")->name("admin.")->group(function () {

    Route::get("login", [AuthController::class, "showLoginForm"])->name("login");
    Route::post("login", [AuthController::class, "login"])->name("login.submit");

    Route::middleware(["auth", "admin"])->group(function () {

        Route::post("logout", [AuthController::class, "logout"])->name("logout");
        Route::get("/", [DashboardController::class, "index"])->name("dashboard");

        Route::get("entreprise", [EntrepriseController::class, "edit"])->name("entreprise.edit");
        Route::put("entreprise", [EntrepriseController::class, "update"])->name("entreprise.update");

        Route::resource("services", ServiceController::class)->except(["show"]);
        Route::resource("actualites", AdminActualiteController::class)->except(["show"]);
        Route::resource("tarifs", TarifController::class)->except(["show"]);
        Route::resource("equipe", AdminEquipeController::class)->except(["show"]);
        Route::resource("users", UserController::class)->except(["show"]);
        Route::resource("projets", AdminProjetController::class)->except(["show"]);
        Route::resource("partenaires", PartenaireController::class)->except(["show"]);
        Route::resource("certifications", CertificationController::class)->except(["show"]);
        Route::resource("bannieres", BanniereController::class)->except(["show"]);

        Route::get("temoignages", [AdminTemoignageController::class, "index"])->name("temoignages.index");
        Route::get("temoignages/{temoignage}/edit", [AdminTemoignageController::class, "edit"])->name("temoignages.edit");
        Route::put("temoignages/{temoignage}", [AdminTemoignageController::class, "update"])->name("temoignages.update");
        Route::delete("temoignages/{temoignage}", [AdminTemoignageController::class, "destroy"])->name("temoignages.destroy");

        Route::resource("faqs", AdminFaqController::class)->except(["show"]);

        Route::get("pages-legales", [AdminPageLegaleController::class, "index"])->name("page-legales.index");
        Route::get("pages-legales/{type}/edit", [AdminPageLegaleController::class, "edit"])->name("page-legales.edit");
        Route::put("pages-legales/{type}", [AdminPageLegaleController::class, "update"])->name("page-legales.update");

        Route::get("messages", [MessageController::class, "index"])->name("messages.index");
        Route::get("messages/{message}", [MessageController::class, "show"])->name("messages.show");
        Route::delete("messages/{message}", [MessageController::class, "destroy"])->name("messages.destroy");

        Route::get("devis", [AdminDevisController::class, "index"])->name("devis.index");
        Route::get("devis/{devis}", [AdminDevisController::class, "show"])->name("devis.show");
        Route::put("devis/{devis}", [AdminDevisController::class, "update"])->name("devis.update");
        Route::delete("devis/{devis}", [AdminDevisController::class, "destroy"])->name("devis.destroy");
        Route::get("devis/{devis}/pdf", [AdminDevisController::class, "pdf"])->name("devis.pdf");

        Route::get("rendez-vous", [AdminRendezVousController::class, "index"])->name("rendez-vous.index");
        Route::get("rendez-vous/{rendezvous}", [AdminRendezVousController::class, "show"])->name("rendez-vous.show");
        Route::put("rendez-vous/{rendezvous}", [AdminRendezVousController::class, "update"])->name("rendez-vous.update");
        Route::delete("rendez-vous/{rendezvous}", [AdminRendezVousController::class, "destroy"])->name("rendez-vous.destroy");
    });
});