//FUNCTION DISPLAY POP-UP
function showElement(id) {
  document.getElementById(id).style.display = 'flex';
}

function closeElement(id) {
  document.getElementById(id).style.display = 'none';
}

// appel de la fonction get RawgApiData
// récupère les données de l'API
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
    let cible2 = document.getElementById("global-game-section");
    let cible3 = document.getElementById("second-header");
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






//AFFICHER LES DETAILS DU JEU
function showGameDetails(gameName, game_id = 1, gameVisual = "../../img/gameVisual.jpeg", gameDesc = "Lorem Ipsum") {
    // balise cible dans laquelle on ajoute le contenu
    let cible = document.getElementById("details-game-section");
    let hide = document.getElementById("game-section");
    let hide2 = document.getElementById("global-game-section");
    let hide3 = document.getElementById("second-header");

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
                      <section class="canvas">
                        <canvas id="game-chart" class="radar-chart"></canvas>
                      </section>
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
                            <h3 id="user0"></h3>
                            <section class="canvas">
                            <canvas id="user-chart0" class="radar-chart"></canvas>
                        </section>
                        </article>

                        <article class="users">
                          <h3 id="user1"></h3>
                          <section class="canvas">
                            <canvas id="user-chart1" class="radar-chart"></canvas>
                          </section>
                        </article>

                        <article class="users">
                          <h3 id="user2"></h3>
                          <section class="canvas">
                            <canvas id="user-chart2" class="radar-chart"></canvas>
                          </section>
                        </article>
                    </section>
                </article>

                <button class="cta" type="button" onclick="goBack()">Retourner à la liste</button>`;
    
    cible.style.display = 'flex';
    hide.style.display = 'none';
    hide2.style.display = 'none';
    hide3.style.display = 'none';
    cible.innerHTML = contenu;

    gameGenre.forEach(genre => {    
      let li_genre = '<li>' + genre + '</li>';
      // balise cible pour ajouter les genres d'un jeu
    $("#details-game-list_genre").append(li_genre);
    });

    gameChart();
    userChart(users);
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
    let cible2 = document.getElementById("global-game-section");
    let cible3 = document.getElementById("second-header");
    let hide = document.getElementById("details-game-section");

    hide.style.display = 'none';
    cible.style.display = 'flex';
    cible2.style.display = 'block';
    cible3.style.display = 'flex';
}



//FORM RATING


//USER CHART
//User data
users = [
  { id: 1, name: 'A', data: [3, 4, 4] },
  { id: 2, name: 'B', data: [3, 5, 5] },
  { id: 3, name: 'C', data: [3, 2, 4] }
];

//FONCTION USER CHART
function userChart(users) {

  for (let i = 0; i < 3; i++) {
    let canvas = document.getElementById('user-chart' + i);
    let cibleNameUser = document.getElementById('user' + i);

    console.log(cibleNameUser);
    console.log(i);
    console.log(users[i].name, users[i].data);

    cibleNameUser.innerHTML = users[i].name;

    let data = {
      labels: [
        'Gameplay',
        'Graphisme',
        'Sound Design'
      ],
      datasets: [{
        label: 'User Appreciation',
        data: users[i].data,
        fill: true,
        backgroundColor: 'rgba(52, 69, 168, 0.473)',
        borderColor: 'rgb(85, 81, 194)',
        pointBackgroundColor: 'rgb(85, 81, 194)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(85, 81, 194)'
      }]
    };

    let config = {
      type: 'radar',
      data: data,
      options: {
        scales: {
          r: {
            beginAtZero: true,
            min: 0,
            max: 5
          }
        },

        ticks: {
          stepSize: 1,
        },

        elements: {
          line: {
            borderWidth: 3
          }
        }
      },
    };

    let radarChart = new Chart(canvas,
      config
    );
  }

}


//GAME CHART
function gameChart() {
  let canvas = document.getElementById('game-chart');

  let data = {
    labels: [
      'Gameplay',
      'Graphisme',
      'Sound Design'
    ],
    datasets: [{
      label: 'Game Rating',
      data: [3, 4, 4],
      fill: true,
      backgroundColor: 'rgba(82, 123, 212, 0.5)',
      borderColor: 'rgb(82, 123, 212)',
      pointBackgroundColor: 'rgb(85, 81, 194)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgb(85, 81, 194)'
    }]
  };

  let config = {
    type: 'radar',
    data: data,
    options: {
      scales: {
        r: {
          beginAtZero: true,
          min: 0,
          max: 5
        }
      },

      ticks: {
        stepSize: 1,
      },

      elements: {
        line: {
          borderWidth: 3
        }
      }
    },
  };

  let radarChart = new Chart(canvas,
    config
  );
}









//SEARCH
async function searchGame() {
  let searchTerm = document.getElementById("input-search").value.toLowerCase();
  let resultat = list_all_games.filter(game => game.name.toLowerCase().includes(searchTerm));

  showGames(resultat);
  
}

//SELECT FILTRE
function selectFiltre() {
  let select = document.getElementById("select-filtre");
  let selectedValue = select.options[select.selectedIndex].value;

  switch(selectedValue) {
    case 'pertinence':
      showGames(games);
      break;
    case 'alphabetique':
      filtreASC();
      break;
  }
}


//FILTRE PAR ORDRE ALPHABETIQUE
function filtreASC() {
  let filterASC = list_all_games.sort(function(a, b) {
    if (a.name.toLowerCase() < b.name.toLowerCase()) {
      return -1;
    } else {
      return 1;
    }
  });

  showGames(filterASC);
}


//USER APPRECIATIONS STATS PENTAGON
//Pentagon stats sources : https://gist.github.com/curran/8b4b7791fc25cfd2c459e74f3d0423f2
//Other : https://codepen.io/semibran/pen/NPOGdd
//Other :https://github.com/jpenninkhof/pentagon/tree/master?tab=readme-ov-file
