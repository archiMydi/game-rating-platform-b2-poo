let gameTest = 'Elden Ring';

console.log(list_all_games);

// let url='database.php'; // url = url du serveur PHP

document.addEventListener('DOMContentLoaded', function() {
    showGame(gameTest);
    // getGamesForFrontend();
})

/* async function getAllGames() {
    console.log('Launched getAllGames'); */
    /* const response = await fetch(url, { 
    method: "GET"
    });
    let result = await response.json();
    console.log(result);
    return result; */

/*     $.ajax({
        type: "POST",
        url: 'database.php?action=GetAllGames',
        dataType: 'json',
        data: {functionname: 'add', arguments: [1, 2]},
    
        success: function (obj, textstatus) {
                      if( !('error' in obj) ) {
                          yourVariable = obj.result;
                          console.log(yourVariable);
                      }
                      else {
                          console.log(obj.error);
                      }
                }
    });
} */

//AFFICHER LA LISTE JEUX
function showGame(game) {
    let cible = document.getElementById("game-section");
    
    let gameID = 1;

    let gameName = game;

    let gameVisual = './img/gameVisual.jpeg';

    let contenu = `<article class="game" onclick="showGameDetails(`+ gameID +`)">
        <p>`+ gameName + `</p>
        <img class="game-img" src="`+ gameVisual +`" alt="` + gameVisual + `"/>
    </article>`;

    cible.innerHTML += contenu;
}


//AFFICHER LES DETAILS DU JEU
function showGameDetails(gameID) {
    let cible = document.getElementById("details-game-section");
    let hide = document.getElementById("game-section");

    let gameVisual = "./img/gameVisual.jpeg";

    let gameName = gameTest;

    let gameGenre = "Genre";

    let gameNote = "Note";

    let contenu = `<article class="gameFiche">
        <p>`+ gameID + ` : `+ gameName +`</p>
        <img src="`+ gameVisual + `" alt="` + gameVisual + `"/>
        <p>`+ gameGenre + `</p>
        <p>`+ gameNote + `</p>
    </article>
    <article>
    
    </br>
    <button class="cta" type="button" onclick="goBack()">Retourner à la liste</button>`;

    hide.innerHTML = '';
    cible.innerHTML += contenu;
}

//GO BACK
function goBack() {
    let hide = document.getElementById("details-game-section");
    hide.innerHTML = '';
    showGame(gameTest);
}



//USER APPRECIATIONS STATS PENTAGON
//Pentagon stats sources : https://gist.github.com/curran/8b4b7791fc25cfd2c459e74f3d0423f2
//Other : https://codepen.io/semibran/pen/NPOGdd
//Other :https://github.com/jpenninkhof/pentagon/tree/master?tab=readme-ov-file
