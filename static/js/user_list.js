//Un user a les attributs suivant à afficher : Pseudo, Description, Photo, Jeu préféré

let userTable = [];

function createUserTable() { //Créer un array pour le stockage local des users
    db_users.forEach(u => {
        let user = {
            id: u.id,
            mail: u.email,
            pseudo: u.pseudo,
        }
        userTable.push(user)
    });
}

function appendUsers() {
    userTable.forEach(u => {
        console.log(u)
        $($('.user-list-container')[0]).append(`<div class='user-container'><img class="profile-picture" src="https://placehold.co/50" alt="${u.pseudo}'s profile picture"/><p class='pseudo'>${u.pseudo}</p><p class='catch-phrase'>Lorem Ipsum Dolor Sit Amet</p></div>`)
    });

}



createUserTable()
appendUsers()