<?php
session_start();
require_once __DIR__ . '/../autoloader.php';  

use App\View;
use App\Repository\RelationCQERepository;
use App\Repository\ChasseurRepository;
use App\Repository\MessageRepository;
use App\Repository\QueteRepository;

// LOGIQUE DE DÉCONNEXION 
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = []; 
    session_destroy(); 
    header('Location: index.php?page=login');
    exit;
}

// LOGIQUE DE CONNEXION
$erreur = null;
if (!empty($_POST['Pseudo']) && !empty($_POST['mdp'])) {
    $repoVerif = new ChasseurRepository();
    $chasseurCo = $repoVerif->getVerifMdp($_POST['Pseudo'], $_POST['mdp']);

    if ($chasseurCo instanceof \App\Entity\Chasseur) {
        if (isset($chasseurCo->numChasseur)) { 
            $_SESSION['is_logged'] = true;
            $_SESSION['user_id'] = $chasseurCo->getNumChasseur();
            $_SESSION['user_pseudo'] = $chasseurCo->getPseudo() ?: $_POST['Pseudo'];
            $_SESSION['id_role'] = $chasseurCo->getIdRole();
            
            header('Location: index.php?page=accueil');
            exit;
        } else {
            $erreur = "Erreur technique : Profil incomplet.";
        }
    } else {
        $erreur = "Identifiants incorrects.";
    }
}

// GESTION DE L'ACCÈS
$page = $_GET['page'] ?? 'accueil';
$isLogged = isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true;
$publicPages = ['login', 'inscription'];

// Redirection si non connecté vers login
if (!$isLogged && !in_array($page, $publicPages)) {
    header('Location: index.php?page=login');
    exit;
}

// Redirection si déjà connecté vers accueil
if ($isLogged && in_array($page, $publicPages)) {
    header('Location: index.php?page=accueil');
    exit;
}


// On traite les actions AVANT de préparer l'affichage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isLogged) {
    
    // LOGIQUE OPTION
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'option') {
        if (isset($_POST['newsLetter_submit'])) {
            $choix = isset($_POST['newsLetter']);
            $repo = new ChasseurRepository();
            $choixExe = $repo->adherer($_SESSION['user_id'], $choix);   

            if ($choixExe) {
                $_SESSION['flash'] = "Vos préférences ont été mises à jour.";
            } else {
                $_SESSION['flash_error'] = "Erreur lors de la sauvegarde.";
            }
            header("Location: index.php?page=option");
            exit;
        }
    }

    // LOGIQUE CONTACT
    if ($page === 'contact') {
        if (isset($_POST['message_submit'])) {
            $titre = htmlspecialchars($_POST['titre'] ?? '');
            $texte = htmlspecialchars($_POST['message'] ?? '');
            $idChasseur = $_SESSION['user_id'];
            if (!empty($titre) && !empty($texte)) {
                $repoMsg = new MessageRepository();
                $repoMsg->envoyerMessage($idChasseur, $titre, $texte);                
                $_SESSION['flash'] = "Votre message a été envoyé avec succès !";
            } else {
                $_SESSION['flash_error'] = "Veuillez remplir tous les champs.";
            }
            header("Location: index.php?page=contact");
            exit;
        }
    }

    // LOGIQUE BOUTIQUE / PANIER / QUÊTES
    $idChasseur = $_SESSION['user_id'];
    $action = $_POST['action'] ?? '';
    $relationRepo = new RelationCQERepository();

    if ($action === 'payer') {
        $relationRepo->payer($idChasseur);
        header("Location: index.php?page=panier");
        exit;
    }

    if (isset($_POST['id'])) {
        $idQuete = intval($_POST['id']);
        if ($action === 'ajouter') {
            $relationRepo->ajouterAuPanier($idChasseur, $idQuete);
            header("Location: index.php?page=boutique");
            exit;
        } elseif ($action === 'retirer') {
            $relationRepo->retirerDuPanier($idChasseur, $idQuete);
            header("Location: index.php?page=panier");
            exit;
        } elseif ($action === 'commencer') {
            $etatActuel = intval($_POST['etat_actuel'] ?? 2);
            if ($etatActuel === 2) {
                $relationRepo->commencer($idChasseur, $idQuete);
            }
            header("Location: index.php?page=" . $page);
            exit;   
        }
    }
}


// AFFICHAGE SPECIFIQUE
$data = ['erreur' => $erreur];

// Logique admin
$adminPages = ['adminChasseur', 'adminQuete', 'adminMessage', 'admin'];
if (in_array($page, $adminPages)) {
    if (!$isLogged || $_SESSION['id_role'] != 2) {
        header("Location: index.php?page=accueil");
        exit;
    }
}
$data = ['erreur' => $erreur];
if ($isLogged && $_SESSION['id_role'] == 2) {
    if ($page === 'adminChasseur') {
        $repo = new ChasseurRepository();
        $data['chasseurs'] = $repo->findAll(); 
    } 
    elseif ($page === 'adminQuete') {
        $repo = new QueteRepository(); 
        $data['quetes'] = $repo->findAll();
    } 
    elseif ($page === 'adminMessage') {
        $repo = new MessageRepository();
        $data['messages'] = $repo->findAll(); 
    }
}

// Logique option
if ($page === 'option') {
    $repo = new ChasseurRepository();
    $chasseur = $repo->findId($_SESSION['user_id']); 
    $data['isSubscribed'] = $chasseur->getNewsLetter();
}

// VUE FINALE
View::render($page, $data);