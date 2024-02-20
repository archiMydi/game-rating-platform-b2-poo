//Un user a les attributs suivant à afficher : Pseudo, Description, Photo, Jeu préféré
function appendUsers() {
    db_users.forEach(u => {
        $($('.user-list-container')[0]).append(`<div class='user-container' onclick='showUserDetails(${u.id})'>
        <div class='left-side'>
        <img class="profile-picture" src="${u.pictureSRC}" alt="${u.pseudo}'s profile picture"/>
        <p class='pseudo'>${u.pseudo}</p>     
        </div>
        <div class='right-side'>
        <p class='catch-phrase'>${u.catchPhrase}</p>
        </div>
        </div>`)
    });
}

function showUserDetails(uid) {
    let u = db_users.filter((db_user) => { return uid == db_user.id }).pop();
    $.get('src/templates/user_details.php', {
        id: u.id,
        pseudo: u.pseudo,
        favGame: u.favGame,
        description: u.catchPhrase,
        avatar: u.pictureSRC
    }, function (response) {
        $('body').append(response);
        $('.modal').css("display", "block");
    });
}

window.onclick = function (event) {
    let modal = $('.modal')[0];
    if (event.target == modal) {
        modal.remove();
    }
}

appendUsers()
