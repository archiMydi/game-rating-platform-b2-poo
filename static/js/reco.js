function displayReco(top) {
    $($('.reco-section')[0]).append(`<section class='reco-list'></section>`)

    top.forEach(t => {
        $($('.reco-list')[0]).append(`
        <div class='reco-container'>
            <h1>${t.name}</h1>
            <div class='reco-img-container'>
                <img class='reco-img' src=${t.visuel} alt='Image of the game' ${t.name}>
            </div>
            <p class='reco-description'>${t.infos}</p>
        </div>`)
    });
}