//FUNCTION DISPLAY POP-UP
function showElement(id) {
  document.getElementById(id).style.display = 'flex';
}

function closeElement(id) {
  document.getElementById(id).style.display = 'none';
}


//GAMES
let games = [
  { name: 'Elden Ring', id: 1 },
  { name: 'Minecraft', id: 2 },
  { name: 'Mario Kart', id: 3 },
];


// let url='database.php'; // url = url du serveur PHP

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
function showGames(games) {
  let cible = document.getElementById("game-section");
  let hide = document.getElementById("details-game-section");

  cible.innerHTML = '';

  games.forEach(game => {
    let gameName = game.name;
    let gameVisual = './img/gameVisual.jpeg';

    let contenu = `<article class="game" onclick="showGameDetails('${gameName}')">
        <p>${gameName}</p>
        <img class="game-img" src="${gameVisual}" alt="${gameVisual}"/>
    </article>`;

    cible.innerHTML += contenu;
  })

  hide.style.display = 'none';
  cible.style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', function () {
  showGames(games);
});





//AFFICHER LES DETAILS DU JEU
function showGameDetails(gameName) {
  let cible = document.getElementById("details-game-section");
  let hide = document.getElementById("game-section");

  cible.innerHTML = '';

  let gameID = 1;

  let gameVisual = "./img/gameVisual.jpeg";

  let gameGenre = "Genre";

  let gameNote = "Note";

  let contenu = `<article class="gameFiche">
                    <section class="game-header">
                      <h2>`+ gameID + ` : ` + gameName + `</h2>
                      <section class="galery">
                        <img src="`+ gameVisual + `" alt="` + gameVisual + `"/>
                      </section>
                    </section>


                    <section class="details-game-info">
                        <section class="details-game-description">
                            <h3>Description</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, veniam eum facilis voluptatum aut debitis, animi ipsam pariatur accusamus culpa voluptatibus unde sequi, recusandae reprehenderit dignissimos totam dolor fugit dicta.</p>
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
  cible.innerHTML = contenu;

  gameChart();
  userChart(users);
}

//GO BACK
function goBack() {
  let cible = document.getElementById("game-section");
  let hide = document.getElementById("details-game-section");

  hide.style.display = 'none';
  cible.style.display = 'flex';
}



//FORM RATING


//USER CHART
//User data
users = [
  { id: 1, name: 'A', data: [3, 4, 4] },
  { id: 2, name: 'B', data: [3, 5, 5] },
  { id: 3, name: 'C', data: [3, 2, 4] }
];

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
  let nameUser = document.getElementById('')

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
  let resultat = games.filter(game => game.name.toLowerCase().includes(searchTerm));

  showGames(resultat);

}

//FILTRE PAR ORDRE ALPHABETIQUE
function filtreASC() {
  let filterASC = games.sort(function (a, b) {
    if (a.name.toLowerCase() < b.name.toLowerCase()) {
      return -1;
    } else {
      return 1;
    }
  });

  console.log(filterASC);
  showGames(filterASC);
}
