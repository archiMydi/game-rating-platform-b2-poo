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

console.log(list_all_games);
console.log(list_all_genres);
console.log(list_categories);

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

document.addEventListener('DOMContentLoaded', function() {
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
                      <h2>`+ gameID + ` : `+ gameName +`</h2>
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
    cible.innerHTML = contenu;
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
