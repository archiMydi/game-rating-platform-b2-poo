<?php

    /**
     * Permet de vérifier et d'utiliser les informations du formulaire de notation
     * 
     * @param bool   $isNewGame     Indique si le jeu a déjà été noter par l'utilisateur
     * @param int    $id_game       Identifiant du jeu
     * @param ?user  $user          L'utilisateur
     * @param string $URL           URL de redirection
     * 
     */
    function checkRatingForm(bool $isNewGame, int $id_game, ?user $user, string $URL) {
        if($_SESSION['user'] == null) {
            header("Location: login.php");
        }

        $list = array();

        $criterion = getListCriterion();
        foreach($criterion as $id => $name) {

            $note = $_POST["stars-".$id] ?? null;
            if($note != null) {

                $list[$id] = $note;

            }
            else {
                break;
            }


        }

        if(count($list) > 0) {

            if($isNewGame) {

                $err = insertRating($user->getID(), $id_game, $list);

                if($err == 1) {
                    echo "Nous rencontrons un problème, merci de réessayer plus tard";
                }
                else {
                    header("Location: $URL");
                }

            }
            else {

                $err = updateRating($user->getID(), $id_game, $list);

                if($err == 1) {
                    echo "Nous rencontrons un problème, merci de réessayer plus tard";
                }
                else {
                    header("Location: $URL");
                }

            }

        }
    }

    /**
     * Affiche le formulaire de notation
     * 
     * @param bool   $isNewGame     Indique si le jeu a déjà été noter par l'utilisateur
     * @param ?user  $user          L'utilisateur
     * @param int    $id_game       Identifiant du jeu
     * @param string $backURL           URL de redirection
     * 
     */
    function setRatingForm(bool $isNewGame, ?user $user, int $id_game, string $backURL) {
        //echo "<section id='rating-form-section'><a href='$backURL'>Retour</a>";
        $span = "closeElement('rating-section')";
        echo '<span onclick="'.$span.'">x</span><form method="POST" id="rating-form" action="#">';

            if($isNewGame) {

                $criterion = getListCriterion();
                foreach($criterion as $id => $name) {

                    echo '<h3>Rating '.$name.'</h3>
                          <section class="rating" id="rating-'.$name.'">
                          <section class="rating-container">

                                <input type="radio" name="stars-'.$id.'" id="st5-'.$id.'" data-rating="5" value="5">
                                <label for="st5-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Excellent"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st4-'.$id.'" data-rating="4" value="4">
                                <label for="st4-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Bon"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st3-'.$id.'" data-rating="3" value="3">
                                <label for="st3-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="OK"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st2-'.$id.'" data-rating="2" value="2">
                                <label for="st2-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Mauvais"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st1-'.$id.'" data-rating="1" value="1">
                                <label for="st1-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Terrible"></div>
                                </label>

                            </section>
                        </section>';

                    }

                }
                else {

                    $list_c = getListCriterion();
                    $criterion = getRatingGame($id_game, $user->getID());
                    foreach($criterion as $id => $elm) {
                        unset($list_c[$id]);
                        $nom = $elm[0];
                        $note = $elm[1];

                        echo '<h3>Rating '.$nom.'</h3>
                        <section class="rating" id="rating-'.$nom.'">
                            <section class="rating-container">

                                <input type="radio" name="stars-'.$id.'" id="st5-'.$id.'" data-rating="5" value="5"';

                        if($note == 5) {
                            echo " checked";
                        }
                                
                        echo '>
                                <label for="st5-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Excellent"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st4-'.$id.'" data-rating="4" value="4"';

                                if($note == 4) {
                                    echo " checked";
                                }
                                        
                                echo '>
                                <label for="st4-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Bon"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st3-'.$id.'" data-rating="3" value="3"';

                                if($note == 3) {
                                    echo " checked";
                                }
                                        
                                echo '>
                                <label for="st3-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="OK"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st2-'.$id.'" data-rating="2" value="2"';

                                if($note == 2) {
                                    echo " checked";
                                }
                                        
                                echo '>
                                <label for="st2-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Mauvais"></div>
                                </label>

                                <input type="radio" name="stars-'.$id.'" id="st1-'.$id.'" data-rating="1" value="1"';

                                if($note == 1) {
                                    echo " checked";
                                }
                                        
                                echo '>
                                <label for="st1-'.$id.'">
                                    <div class="star-stroke">
                                        <div class="star-fill"></div>
                                    </div>
                                    <div class="label-description" data-content="Terrible"></div>
                                </label>

                            </section>
                        </section>';

                    }

                    if(count($list_c) > 0) {

                        foreach($list_c as $id => $nom) {

                            echo '<h3>Rating '.$nom.'</h3>
                                <section class="rating" id="rating-'.$nom.'">
                                    <section class="rating-container">

                                        <input type="radio" name="stars-'.$id.'" id="st5-'.$id.'" data-rating="5" value="5">
                                        <label for="st5-'.$id.'">
                                            <div class="star-stroke">
                                                <div class="star-fill"></div>
                                            </div>
                                            <div class="label-description" data-content="Excellent"></div>
                                        </label>

                                        <input type="radio" name="stars-'.$id.'" id="st4-'.$id.'" data-rating="4" value="4">
                                        <label for="st4-'.$id.'">
                                            <div class="star-stroke">
                                                <div class="star-fill"></div>
                                            </div>
                                            <div class="label-description" data-content="Bon"></div>
                                        </label>

                                        <input type="radio" name="stars-'.$id.'" id="st3-'.$id.'" data-rating="3" value="3">
                                        <label for="st3-'.$id.'">
                                            <div class="star-stroke">
                                                <div class="star-fill"></div>
                                            </div>
                                            <div class="label-description" data-content="OK"></div>
                                        </label>

                                        <input type="radio" name="stars-'.$id.'" id="st2-'.$id.'" data-rating="2" value="2">
                                        <label for="st2-'.$id.'">
                                            <div class="star-stroke">
                                                <div class="star-fill"></div>
                                            </div>
                                            <div class="label-description" data-content="Mauvais"></div>
                                        </label>

                                        <input type="radio" name="stars-'.$id.'" id="st1-'.$id.'" data-rating="1" value="1">
                                        <label for="st1-'.$id.'">
                                            <div class="star-stroke">
                                                <div class="star-fill"></div>
                                            </div>
                                            <div class="label-description" data-content="Terrible"></div>
                                        </label>

                                    </section>
                                </section>';

                        }

                    }

                }
            echo "<input type='submit' Value='Valider'></form>";
        }
    ?>