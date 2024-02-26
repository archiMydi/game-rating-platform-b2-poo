//FUNCTION DISPLAY POP-UP
function showElement(id) {
  document.getElementById(id).style.display = 'flex';
}

function closeElement(id) {
  document.getElementById(id).style.display = 'none';
}

// ../ redescend à src puis à game-rating-plat... pour accéder au fichier rawgdata.json via route js/rawgdata.json
/* import data from '../../js/rawgdata.json'; // importer le fichier json rawgdata.json dans index.js
console.log(data); */

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


let test_data =[{"id":3498,"slug":"grand-theft-auto-v","name":"Grand Theft Auto V","released":"2013-09-17","tba":false,"background_image":"https://media.rawg.io/media/games/20a/20aa03a10cda45239fe22d035c0ebe64.jpg","rating":4.47,"rating_top":5,"ratings":[{"id":5,"title":"exceptional","count":4036,"percent":58.97},{"id":4,"title":"recommended","count":2246,"percent":32.82},{"id":3,"title":"meh","count":437,"percent":6.39},{"id":1,"title":"skip","count":125,"percent":1.83}],"ratings_count":6744,"reviews_text_count":58,"added":20575,"added_by_status":{"yet":527,"owned":11768,"beaten":5848,"toplay":609,"dropped":1098,"playing":724},"metacritic":92,"playtime":74,"suggestions_count":430,"updated":"2024-02-23T01:11:10","user_game":null,"reviews_count":6844,"saturated_color":"0f0f0f","dominant_color":"0f0f0f","platforms":[{"platform":{"id":4,"name":"PC","slug":"pc","image":null,"year_end":null,"year_start":null,"games_count":525904,"image_background":"https://media.rawg.io/media/games/d58/d588947d4286e7b5e0e12e1bea7d9844.jpg"},"released_at":"2013-09-17","requirements_en":{"minimum":"Minimum:OS: Windows 10 64 Bit, Windows 8.1 64 Bit, Windows 8 64 Bit, Windows 7 64 Bit Service Pack 1, Windows Vista 64 Bit Service Pack 2* (*NVIDIA video card recommended if running Vista OS)Processor: Intel Core 2 Quad CPU Q6600 @ 2.40GHz (4 CPUs) / AMD Phenom 9850 Quad-Core Processor (4 CPUs) @ 2.5GHzMemory: 4 GB RAMGraphics: NVIDIA 9800 GT 1GB / AMD HD 4870 1GB (DX 10, 10.1, 11)Storage: 72 GB available spaceSound Card: 100% DirectX 10 compatibleAdditional Notes: Over time downloadable content and programming changes will change the system requirements for this game.  Please refer to your hardware manufacturer and www.rockstargames.com/support for current compatibility information. Some system components such as mobile chipsets, integrated, and AGP graphics cards may be incompatible. Unlisted specifications may not be supported by publisher.     Other requirements:  Installation and online play requires log-in to Rockstar Games Social Club (13+) network; internet connection required for activation, online play, and periodic entitlement verification; software installations required including Rockstar Games Social Club platform, DirectX , Chromium, and Microsoft Visual C++ 2008 sp1 Redistributable Package, and authentication software that recognizes certain hardware attributes for entitlement, digital rights management, system, and other support purposes.     SINGLE USE SERIAL CODE REGISTRATION VIA INTERNET REQUIRED; REGISTRATION IS LIMITED TO ONE ROCKSTAR GAMES SOCIAL CLUB ACCOUNT (13+) PER SERIAL CODE; ONLY ONE PC LOG-IN ALLOWED PER SOCIAL CLUB ACCOUNT AT ANY TIME; SERIAL CODE(S) ARE NON-TRANSFERABLE ONCE USED; SOCIAL CLUB ACCOUNTS ARE NON-TRANSFERABLE.  Partner Requirements:  Please check the terms of service of this site before purchasing this software.","recommended":"Recommended:OS: Windows 10 64 Bit, Windows 8.1 64 Bit, Windows 8 64 Bit, Windows 7 64 Bit Service Pack 1Processor: Intel Core i5 3470 @ 3.2GHz (4 CPUs) / AMD X8 FX-8350 @ 4GHz (8 CPUs)Memory: 8 GB RAMGraphics: NVIDIA GTX 660 2GB / AMD HD 7870 2GBStorage: 72 GB available spaceSound Card: 100% DirectX 10 compatibleAdditional Notes:"},"requirements_ru":null},{"platform":{"id":187,"name":"PlayStation 5","slug":"playstation5","image":null,"year_end":null,"year_start":2020,"games_count":1015,"image_background":"https://media.rawg.io/media/games/909/909974d1c7863c2027241e265fe7011f.jpg"},"released_at":"2013-09-17","requirements_en":null,"requirements_ru":null},{"platform":{"id":186,"name":"Xbox Series S/X","slug":"xbox-series-x","image":null,"year_end":null,"year_start":2020,"games_count":881,"image_background":"https://media.rawg.io/media/games/b29/b294fdd866dcdb643e7bab370a552855.jpg"},"released_at":"2013-09-17","requirements_en":null,"requirements_ru":null},{"platform":{"id":18,"name":"PlayStation 4","slug":"playstation4","image":null,"year_end":null,"year_start":null,"games_count":6767,"image_background":"https://media.rawg.io/media/games/26d/26d4437715bee60138dab4a7c8c59c92.jpg"},"released_at":"2013-09-17","requirements_en":null,"requirements_ru":null},{"platform":{"id":16,"name":"PlayStation 3","slug":"playstation3","image":null,"year_end":null,"year_start":null,"games_count":3168,"image_background":"https://media.rawg.io/media/games/20a/20aa03a10cda45239fe22d035c0ebe64.jpg"},"released_at":"2013-09-17","requirements_en":null,"requirements_ru":null},{"platform":{"id":14,"name":"Xbox 360","slug":"xbox360","image":null,"year_end":null,"year_start":null,"games_count":2796,"image_background":"https://media.rawg.io/media/games/20a/20aa03a10cda45239fe22d035c0ebe64.jpg"},"released_at":"2013-09-17","requirements_en":null,"requirements_ru":null},{"platform":{"id":1,"name":"Xbox One","slug":"xbox-one","image":null,"year_end":null,"year_start":null,"games_count":5590,"image_background":"https://media.rawg.io/media/games/8a0/8a02f84a5916ede2f923b88d5f8217ba.jpg"},"released_at":"2013-09-17","requirements_en":null,"requirements_ru":null}],"parent_platforms":[{"platform":{"id":1,"name":"PC","slug":"pc"}},{"platform":{"id":2,"name":"PlayStation","slug":"playstation"}},{"platform":{"id":3,"name":"Xbox","slug":"xbox"}}],"genres":[{"id":4,"name":"Action","slug":"action","games_count":178358,"image_background":"https://media.rawg.io/media/games/120/1201a40e4364557b124392ee50317b99.jpg"}],"stores":[{"id":290375,"store":{"id":3,"name":"PlayStation Store","slug":"playstation-store","domain":"store.playstation.com","games_count":7900,"image_background":"https://media.rawg.io/media/games/d82/d82990b9c67ba0d2d09d4e6fa88885a7.jpg"}},{"id":438095,"store":{"id":11,"name":"Epic Games","slug":"epic-games","domain":"epicgames.com","games_count":1319,"image_background":"https://media.rawg.io/media/games/4be/4be6a6ad0364751a96229c56bf69be59.jpg"}},{"id":290376,"store":{"id":1,"name":"Steam","slug":"steam","domain":"store.steampowered.com","games_count":89063,"image_background":"https://media.rawg.io/media/games/f87/f87457e8347484033cb34cde6101d08d.jpg"}},{"id":290377,"store":{"id":7,"name":"Xbox 360 Store","slug":"xbox360","domain":"marketplace.xbox.com","games_count":1912,"image_background":"https://media.rawg.io/media/games/d1a/d1a2e99ade53494c6330a0ed945fe823.jpg"}},{"id":290378,"store":{"id":2,"name":"Xbox Store","slug":"xbox-store","domain":"microsoft.com","games_count":4813,"image_background":"https://media.rawg.io/media/games/26d/26d4437715bee60138dab4a7c8c59c92.jpg"}}],"clip":null,"tags":[{"id":31,"name":"Singleplayer","slug":"singleplayer","language":"eng","games_count":218199,"image_background":"https://media.rawg.io/media/games/2ba/2bac0e87cf45e5b508f227d281c9252a.jpg"},{"id":40847,"name":"Steam Achievements","slug":"steam-achievements","language":"eng","games_count":35702,"image_background":"https://media.rawg.io/media/games/46d/46d98e6910fbc0706e2948a7cc9b10c5.jpg"},{"id":7,"name":"Multiplayer","slug":"multiplayer","language":"eng","games_count":37130,"image_background":"https://media.rawg.io/media/games/ec3/ec3a7db7b8ab5a71aad622fe7c62632f.jpg"},{"id":40836,"name":"Full controller support","slug":"full-controller-support","language":"eng","games_count":16746,"image_background":"https://media.rawg.io/media/games/4cf/4cfc6b7f1850590a4634b08bfab308ab.jpg"},{"id":13,"name":"Atmospheric","slug":"atmospheric","language":"eng","games_count":32044,"image_background":"https://media.rawg.io/media/games/2ba/2bac0e87cf45e5b508f227d281c9252a.jpg"},{"id":42,"name":"Great Soundtrack","slug":"great-soundtrack","language":"eng","games_count":3386,"image_background":"https://media.rawg.io/media/games/8a0/8a02f84a5916ede2f923b88d5f8217ba.jpg"},{"id":24,"name":"RPG","slug":"rpg","language":"eng","games_count":19865,"image_background":"https://media.rawg.io/media/games/995/9951d9d55323d08967640f7b9ab3e342.jpg"},{"id":18,"name":"Co-op","slug":"co-op","language":"eng","games_count":11072,"image_background":"https://media.rawg.io/media/games/511/5118aff5091cb3efec399c808f8c598f.jpg"},{"id":36,"name":"Open World","slug":"open-world","language":"eng","games_count":7102,"image_background":"https://media.rawg.io/media/games/00d/00d374f12a3ab5f96c500a2cfa901e15.jpg"},{"id":411,"name":"cooperative","slug":"cooperative","language":"eng","games_count":4703,"image_background":"https://media.rawg.io/media/games/73e/73eecb8909e0c39fb246f457b5d6cbbe.jpg"},{"id":8,"name":"First-Person","slug":"first-person","language":"eng","games_count":30626,"image_background":"https://media.rawg.io/media/games/34b/34b1f1850a1c06fd971bc6ab3ac0ce0e.jpg"},{"id":149,"name":"Third Person","slug":"third-person","language":"eng","games_count":10861,"image_background":"https://media.rawg.io/media/games/995/9951d9d55323d08967640f7b9ab3e342.jpg"},{"id":4,"name":"Funny","slug":"funny","language":"eng","games_count":24154,"image_background":"https://media.rawg.io/media/games/ec3/ec3a7db7b8ab5a71aad622fe7c62632f.jpg"},{"id":37,"name":"Sandbox","slug":"sandbox","language":"eng","games_count":6607,"image_background":"https://media.rawg.io/media/games/7cf/7cfc9220b401b7a300e409e539c9afd5.jpg"},{"id":123,"name":"Comedy","slug":"comedy","language":"eng","games_count":11960,"image_background":"https://media.rawg.io/media/games/e3d/e3ddc524c6292a435d01d97cc5f42ea7.jpg"},{"id":150,"name":"Third-Person Shooter","slug":"third-person-shooter","language":"eng","games_count":3266,"image_background":"https://media.rawg.io/media/games/ebd/ebdbb7eb52bd58b0e7fa4538d9757b60.jpg"},{"id":62,"name":"Moddable","slug":"moddable","language":"eng","games_count":880,"image_background":"https://media.rawg.io/media/games/c22/c22d804ac753c72f2617b3708a625dec.jpg"},{"id":144,"name":"Crime","slug":"crime","language":"eng","games_count":2718,"image_background":"https://media.rawg.io/media/games/5fa/5fae5fec3c943179e09da67a4427d68f.jpg"},{"id":62349,"name":"vr mod","slug":"vr-mod","language":"eng","games_count":17,"image_background":"https://media.rawg.io/media/screenshots/1bb/1bb3f78f0fe43b5d5ca2f3da5b638840.jpg"}],"esrb_rating":{"id":4,"name":"Mature","slug":"mature"},"short_screenshots":[{"id":-1,"image":"https://media.rawg.io/media/games/20a/20aa03a10cda45239fe22d035c0ebe64.jpg"},{"id":1827221,"image":"https://media.rawg.io/media/screenshots/a7c/a7c43871a54bed6573a6a429451564ef.jpg"},{"id":1827222,"image":"https://media.rawg.io/media/screenshots/cf4/cf4367daf6a1e33684bf19adb02d16d6.jpg"},{"id":1827223,"image":"https://media.rawg.io/media/screenshots/f95/f9518b1d99210c0cae21fc09e95b4e31.jpg"},{"id":1827225,"image":"https://media.rawg.io/media/screenshots/a5c/a5c95ea539c87d5f538763e16e18fb99.jpg"},{"id":1827226,"image":"https://media.rawg.io/media/screenshots/a7e/a7e990bc574f4d34e03b5926361d1ee7.jpg"},{"id":1827227,"image":"https://media.rawg.io/media/screenshots/592/592e2501d8734b802b2a34fee2df59fa.jpg"}]}];
/** Function getDataToPostToDatabase :
 * Paramètre : data : tableau d'objet reçu par la requête fetch dans getRawgApiData()
 * Traite les données de l'API Rawg avec une requête fetch
 * Doit retourner un objet json pour chaque élément du tableau 
 * Envoyer objets au serveur
 */
function getDataToPostToDatabase(data) {
  data.forEach(object => {
      var gameName = object.name;
      var gameVisual = object.background_image; 
      var gameGenre = [];
      var gameInfos = "Date de sortie : " + object.released;
      var gameGallery = [];
      var gameMetacritic = object.metacritic

      object.short_screenshots.forEach(screenshots => {
        gameGallery.push(screenshots.image);
      });
      object.tags.forEach(tag => {
        gameGenre.push(tag.name);
      });

      let object_game_to_post = {
        "name": gameName,
        "visuel": gameVisual,
        "infos": gameInfos,
        "metacritic": gameMetacritic
      };
      console.log(object_game_to_post);
      console.log(gameGenre);
      console.log(gameGallery);
  });
}

// phase de test : prendre test_data en paramètre
// tester avec apiRawgData
// getDataToPostToDatabase(apiRawgData);
getDataToPostToDatabase(test_data);


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






//AFFICHER LES DETAILS DU JEU
function showGameDetails(gameName, game_id = 1, gameVisual = "../../img/gameVisual.jpeg", gameDesc = "Lorem Ipsum", data = [3, 3, 3]) {
    // balise cible dans laquelle on ajoute le contenu
    let cible = document.getElementById("details-game-section");
    let hide = document.getElementById("game-section");
    let hide2 = document.getElementById("global-game-section");
    let hide3 = document.getElementById("second-header");
    console.log("LES DATAS (NOTES) : " + data[0]);

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

    gameChart(data);
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
function gameChart(data_) {
  let canvas = document.getElementById('game-chart');

  let data = {
    labels: [
      'Gameplay',
      'Graphisme',
      'Sound Design'
    ],
    datasets: [{
      label: 'Game Rating',
      data: data_,
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


//FONCTION GET GAMES

function  getGames() {
  
}
// https://api.rawg.io/api/games