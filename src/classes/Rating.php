<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once($_SERVER['DOCUMENT_ROOT'] . '/src/templates/database.php');

class Rating
{
    /**
     * Récupère la liste de toutes les notes pour chaque jeu que user a noté
     *
     * @param int   $uid - Identifiant de l'utilisateur
     *
     * @return array $userRatings Tableau associatif liste[jeu[critère[note]]
     */
    public static function getUserVector($uid)
    {
        $userRatings = getAllRatedGame($uid, false, true);
        return $userRatings;
    }

    /**
     * Récupère les notes d'un jeu, données par un utilisateur
     *
     * @param int     $uid      Identifiant de l'utilisateur
     * @param int     $gameID   Identifiant du jeu
     *
     * @return array Retourne une liste de jeux (liste[id critere] = [nom, note])
     */
    public static function getUserRatingOnGame($uid, $gameID)
    {
        $userRatingsOnGame = getRatingGame($gameID, $uid);
        return $userRatingsOnGame;
    }

    /**
     * Récupère la note d'un critère précis d'un jeu, donnée par un utilisateur
     *
     * @param int   $uid          Identifiant de l'utilisateur
     * @param int   $gameID       Identifiant du jeu
     * @param int   $criterionID  Identifiant du critère
     *
     * @return array Retourne la note
     */
    public static function getUserRateOfGameOnCriterion($uid, $gameID, $criterionID)
    {
        $userRate = getRatingGame($gameID, $uid);
        $userRate = $userRate[$criterionID];
        return $userRate;
    }
}

Rating::getUserVector(1);
