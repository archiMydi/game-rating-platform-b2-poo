//FUNCTION DISPLAY POP-UP
function showElement(id) {
  document.getElementById(id).style.display = 'flex';
}

function closeElement(id) {
  document.getElementById(id).style.display = 'none';
}


//GAMES
let games = [
  {name: 'Elden Ring', id: 1},
  {name: 'Minecraft', id: 2},
  {name: 'Mario Kart', id: 3},
];

let apiRawgData = getRawgApiData();

console.log(list_all_games);
console.log(apiRawgData);

/** Function getRawgApiData :
 * Récupère les données de l'API Rawg avec une requête fetch
 * Doit retourner un tableau d'objets au format json 
 * (fonction à initier au lancement et à stocker dans la base de données)
 */
async function getRawgApiData() { // fonction déclinable avec 
  const rawgData = await fetch('https://api.rawg.io/api/games?key=8bfd7a86de0c43139aae5337a6a07d88', {
    // url doir inclure la clé de l'API (API Key) en paramètre
    method: "GET"
    });
    console.log(rawgData);
    return rawgData;
}

//AFFICHER LA LISTE JEUX
function showGames(games) {
    let cible = document.getElementById("game-section");
    let hide = document.getElementById("details-game-section");

    //cible.innerHTML = '';

    games.forEach(game => {
      let gameName = game.name;
      let gameVisual = './img/gameVisual.jpeg';

      let contenu = `<article class="game" onclick="showGameDetails('${gameName}')">
        <p>${gameName}</p>
        <img class="game-img" src="${gameVisual}" alt="${gameVisual}"/>
    </article>`;

    //cible.innerHTML += contenu;
    })
    

    hide.style.display = 'none';
    cible.style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', function() {
  showGames(games);
});





//AFFICHER LES DETAILS DU JEU
function showGameDetails(gameName, game_id = 1, gameVisual = "../../img/gameVisual.jpeg", gameDesc = "Lorem Ipsum") {
    // balise cible dans laquelle on ajoute le contenu
    let cible = document.getElementById("details-game-section");
    let hide = document.getElementById("game-section");
    let hide2 = document.getElementById("global-game-section");

    gameName = gameName.replace("#%7!8$9%#", "'");
    gameDesc = gameDesc.replace("#%7!8$9%#", "'");

    cible.innerHTML = '';

    let gameID = game_id;

    let gameGenre;


    list_all_games.forEach(game => {
      if (game.id == gameID) {
        gameName = game.name;
        gameVisual = game.visuel; // implémentation des variables quand l'identifiant correspond
        gameGenre = JSON.parse(game.gender);
        gameInfos = game.infos;
      }
    });

    console.log(gameGenre);


    let gameNote = "Note";

    let contenu = `<article class="gameFiche">
                    <section class="game-header">
                      <h2>`+ gameID + ` : `+ gameName +`</h2>
                      <section class="galery">
                        <img src="`+ gameVisual + `" alt="` + gameVisual + `"/>
                      </section>
                    </section>


                    <section class="details-game-info">
                        <section class="details-game-description">
                            <h3>Description</h3>
                            <p>`+ gameInfos + `</p>
                        </section>
                        <section class="details-game-genre">
                            <h3>Genres</h3>
                            <ul>
                                <li>`+ gameGenre + `</li>
                                <li>`+ gameGenre + `</li>
                            </ul>
                        </section>
                    </section>

                    <section class="game-note">
                      <p>`+ gameNote + `</p>
                      <button class="cta" type="button" onclick="showElement('rating-section')">Noter</button>
                    </section>


                    <section class="recommandation">
                        <h2>Jeux Similaires</h2>
                        <section class="game-list-recommandation">
                            <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                            <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                            <img src="./img/gameVisual.jpeg" alt="gameVisual" />
                        </section>

                    </section>

                    <section class="user-appreciation">
                    <h2>Avis des Followers</h2>
                        <article class="users">
                            <h3>NameUser</h3>
                            <canvas id="user-chart" class="radar-chart"></canvas>
                        </article>
                    </section>
                </article>

                <button class="cta" type="button" onclick="goBack()">Retourner à la liste</button>`;
    
    cible.style.display = 'flex';
    hide.style.display = 'none';
    hide2.style.display = 'none';
    cible.innerHTML = contenu;

    gameGenre.forEach(genre => {    
      let li_genre = '<li>' + genre + '</li>';
      // balise cible pour ajouter les genres d'un jeu
    $("#details-game-list_genre").append(li_genre);
    }); 
}

// affiche la liste des genres dans le menu
function showListGender() {
  list_all_genders.forEach(gender => {    
    let nav_gender = '<p onclick="selectGamesByGender(' + gender.name + ')">' 
    + gender.name + '</p>';
    // TODO implémenter fonction onclick
    // balise cible pour ajouter les genres d'un jeu
  $("#menu-aside").append(nav_gender);
  }); 
}

function selectGamesByGender(gender_name) {
  let list_games_by_gender = [];
  list_all_games.forEach(game => {
    for (let i=0; i<game.gender.length; i++) {
      if (game.gender[i].name == gender_name) {
        list_games_by_gender.append(game);
      }    
    }
  }); 
  console.log(list_games_by_gender);
  showGames(list_games_by_gender)
}

//GO BACK
function goBack() {
    let cible = document.getElementById("game-section");
    let hide = document.getElementById("details-game-section");

    hide.style.display = 'none';
    cible.style.display = 'flex';
}



//FORM RATING


//RADAR CHART
let canvas = document.getElementById('user-chart');

new Chart(canvas, {
  type: 'radar',
  data: data,
  options: {
    elements: {
      line: {
        borderWidth: 3
      }
    }
  },
});


let data = {
  labels: [
    'Eating',
    'Drinking',
    'Sleeping',
    'Designing',
    'Coding',
    'Cycling',
    'Running'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 90, 81, 56, 55, 40],
    fill: true,
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgb(255, 99, 132)',
    pointBackgroundColor: 'rgb(255, 99, 132)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(255, 99, 132)'
  }, {
    label: 'My Second Dataset',
    data: [28, 48, 40, 19, 96, 27, 100],
    fill: true,
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgb(54, 162, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'
  }]
};











//SEARCH
async function searchGame() {
  let searchTerm = document.getElementById("input-search").value.toLowerCase();
  let resultat = games.filter(game => game.name.toLowerCase().includes(searchTerm));

  showGames(resultat);
  
}

//FILTRE PAR ORDRE ALPHABETIQUE
function filtreASC() {
  let filterASC = games.sort(function(a, b) {
    if (a.name.toLowerCase() < b.name.toLowerCase()) {
      return -1;
    } else {
      return 1;
    }
  });

  console.log(filterASC);
  showGames(filterASC);
}


//USER APPRECIATIONS STATS PENTAGON
//Pentagon stats sources : https://gist.github.com/curran/8b4b7791fc25cfd2c459e74f3d0423f2
//Other : https://codepen.io/semibran/pen/NPOGdd
//Other :https://github.com/jpenninkhof/pentagon/tree/master?tab=readme-ov-file
