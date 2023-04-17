/**
 * Classe Article. 
 * Comme dans une classe "standart" en POO, 
 *  - Le constructeur est appelé grâce au nom de la classe
 *  - Des attributs (ou propriétés) 
 *  - Les GETTERS pour récupérer les valeurs des attributs
 *  - Les SETTERS pour donner/modifier une valeur des attributs
 *  - La méthode toString() qui retourne un String dans lequel se 
 * trouve les noms des attributs accompagnés de leur valeur) 
 * @param {string} titre
 * @param {string} description 
 * @param {string} auteur
 * @param {Date} annee
 */

function Article(titre, description){
    // Les attributs
    this.titre = titre;
    this.description = description;
    this.annee = new Date();

    // Les GETTERS
    this.getTitre = function(){
        return this.titre;
    }
    this.getDescription = function(){
        return this.description;
    }
    
    this.getAnnee = function(){
        return this.annee;
    }

    // LES SETTERS
    this.setTitre = function(valeur){
        this.titre = valeur;
    }
    this.setDescription = function(valeur){
        this.description = valeur;
    }

    // La méthode toString()
    this.toString = function(){
        return "titre : " + this.titre + "/n contenu : " + this.description + "/n anne : " + this.annee;
    }
    
}