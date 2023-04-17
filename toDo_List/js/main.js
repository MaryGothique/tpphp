var listeArticles = [];
/**
 * Méthode viderMain() qui se déclenche au click sur #dom_bouton1.
 * Il vide le contenu de <main>
 */
function viderMain(){
    console.log("ENTREE dans viderMain()");
    // Efface le contenu existant (tous les enfants) dans le main
    $("main").children().remove();

    // Créer un formulaire "Ajouter un article"
    $("main").html("<form><p>Ajouter un article</p><div><label for='titre'>titre : </label><input type='text' name='titre' placeholder='Votre titre ici...' required></div><div><label for='description'>description : </label><input type='text' name='description' placeholder='Votre description ici...' required></div></form><button type='submit' onclick='submitForm()'>Enregistrer</button>");
}
/**
 * Méthode qui ajoute un article dans la BDD (tableau)
 */
function submitForm(){
    console.log("ENTREE dans submitForm()");
    var article = new Article($("input")[0].value, $("input")[1].value);
    listeArticles.push(article);
    console.log(listeArticles);
}

/**
 * Méthode qui affiche tous les articles
 */
function toutAfficher(){
    console.log("ENTREE dans toutAfficher()");
    var divHtmlTitreArticle = "";
    // Efface le contenu existant (tous les enfants) dans le main
    $("main").children().remove();
    // Ajout de la zone d'affichage
    $("main").html("<h1>Ma toDoList</h1><div class='todolistZone test'></div>");

    for(var i = 0 ; i < listeArticles.length ; i++){
        divHtmlTitreArticle +="<div class='todolistDiv'><a href='#'>" + listeArticles[i].titre +"</a></div>";
    }

    $("div.todolistZone").html(divHtmlTitreArticle);
}