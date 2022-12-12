<?php

require_once __DIR__.'/router.php';
any('/accueil', 'controllers/homeCtrl.php');
get('/', 'controllers/homeCtrl.php');
get('/menu', 'controllers/menuCtrl.php');
get('/commentaires', 'controllers/reviewCtrl.php');
get('/galerie', 'controllers/galeryCtrl.php');
get('/getDishesAjax', 'helpers/ajax/dishes.php');

// Inscription
any('/inscription', 'controllers/registerCtrl.php');
// Connexion
any('/connexion', 'controllers/connectionCtrl.php');
// Déconnexion
get('/disconnect', 'controllers/disconnectCtrl.php');
// Mot de passe oublié
any('/oubli-mot-de-passe', 'controllers/forgotPwdCtrl.php');

// #############################
// Gestion du profil utilisateur
// #############################

// Membres (admin)
any('/admin/membres', 'controllers/admin/dbUsersCtrl.php');
// Modifier un utilisateur (admin)
any('/admin/membre/edit/$id', 'controllers/admin/dbUsersCtrl.php');
// Modifier un utilisateur (admin)
any('/admin/membre/delete/$id', 'controllers/admin/dbUsersCtrl.php');
// Profil
any('/profil', 'controllers/user/userCtrl.php');
// Modification du profil
any('/profil/edit', 'controllers/user/userCtrl.php');
// Recherche d'un utilisateur
any('/admin/membres/search', 'controllers/admin/dbUsersCtrl.php');
// Suppression du profil
any('/profil/user/delete', 'controllers/user/userCtrl.php');

// ########################
// Gestion des réservations
// ########################

// Réservations (admin)
any('/admin/reservations', 'controllers/admin/dbReservationsCtrl.php');
// Ajout d'une réservation (user)
any('/reservation/add', 'controllers/admin/dbReservationAllCtrl.php');
// Validation d'une réservation (admin)
any('/admin/reservation/edit/validate/$id', 'controllers/admin/dbReservationsCtrl.php');
// Suppression d'une réservation (admin)
any('/admin/reservation/delete/$id', 'controllers/admin/dbReservationsCtrl.php');
// Réservations (user)
any('/profil/reservations', 'controllers/user/userCtrl.php');
// Suppression d'une réservation (user)
any('/profil/reservation/delete/$id', 'controllers/user/userCtrl.php');
// Modification d'une réservation (user)
any('/profil/reservation/edit/$id', 'controllers/user/userCtrl.php');

// ############################
// Gestion du menu et des plats
// ############################
// Menu
get('/admin/', 'controllers/admin/dbDishesCtrl.php');
get('/admin/menu', 'controllers/admin/dbDishesCtrl.php');
// Ajout d'un plat
any('/admin/menu/ajout', 'controllers/admin/dbDishesCtrl.php');
// Modification d'un plat
any('/admin/menu/edit/$id', 'controllers/admin/dbDishesCtrl.php');
// Modification de l'image d'un plat
any('/admin/menu/edit/img/$id', 'controllers/admin/dbDishesCtrl.php');
// Acitve la visibilité d'un plat sur le menu
any('/admin/menu/edit/active/$id', 'controllers/admin/dbDishesCtrl.php');
// Suppression d'un plat
any('/admin/menu/delete/$id', 'controllers/admin/dbDishesCtrl.php');

// #####################
// Gestion des commandes
// #####################

// Commandes (admin)
any('/admin/commandes', 'controllers/admin/dbOrdersCtrl.php');
// Valide une commande
any('/admin/commandes/validate', 'controllers/admin/dbOrdersCtrl.php');
// Supprime une commande
any('/admin/commande/delete/$id', 'controllers/admin/dbOrdersCtrl.php');
// Commandes (user)
any('/profil/commandes', 'controllers/user/userCtrl.php');
// Modifier une commande (user)
any('/profil/commande/edit/$id', 'controllers/user/userCtrl.php');
// Supprimer une commande (user)
any('/profil/commande/delete/$id', 'controllers/user/userCtrl.php');
// Supprimer une plat d'une commande (user)
any('/admin/commande/plat/delete/$id', 'controllers/user/userCtrl.php');

// ########################
// Gestion des commentaires
// ########################

// Commentaires (admin)
any('/admin/commentaires', 'controllers/admin/dbReviewsCtrl.php');
// Valide un commentaire (admin)
any('/admin/commentaire/edit/validate/$id', 'controllers/admin/dbReviewsCtrl.php');
// Supprime un commentaire (admin)
any('/admin/commentaire/delete/$id', 'controllers/admin/dbReviewsCtrl.php');
// Ajoute un commentaires (user)
any('/commentaires/ajout', 'controllers/reviewCtrl.php');
// Commentaires (user)
any('/profil/commentaires', 'controllers/user/userCtrl.php');
// Modifie un commentaire (user)
any('/profil/commentaire/edit/$id', 'controllers/user/userCtrl.php');
// Supprime un commentaire (user)
any('/profil/commentaire/delete/$id', 'controllers/user/userCtrl.php');

// ######################################
// Gestion de l'ajax de la page d'accueil
// ######################################

any('/getLastStartersAjax', 'helpers/ajax/startersPreview.php');
any('/getLastDishesAjax', 'helpers/ajax/dishesPreview.php');
any('/getLastDessertsAjax', 'helpers/ajax/dessertsPreview.php');
any('/getLastReviewsAjax', 'helpers/ajax/lastReviews.php');

get('/jwtverif', 'controllers/JWTVerifCtrl.php');
any('/modif-mdp', 'controllers/resetPwdCtrl.php');

get('/cgu', 'controllers/cguCtrl.php');
// Page not found
any('/404','/404.php');