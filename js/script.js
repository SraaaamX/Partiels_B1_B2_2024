// js/script.js

//on attend d'avoir charger la fin de la page
$(function () {

    //lors d'un clic sur la croix
    $('.close').click(function () {

        //debug qlq chose
        console.log(123);

        //on cible le parent de la croix cliquée, et on lui ajoute la classe hidden
        $(this).parent().addClass('hidden');

    })//fin clic

    //lors de l'envoi (la soumission) du formulaire
    $('form.delete').submit(function () {

        //retourne la confirmation (ou non) de l'utilisateur
        return confirm('Etes-vous sûr de vouloir supprimer ce film ? Cette action est irréversible.');

    })//fin envoi

})//fin du chargement