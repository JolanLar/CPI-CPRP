$(document).ready(function () {

    /**
     * @author Ruben Veloso Paulos
     * Retourne la notation
     * @type {number}
     */
    function getNotation() {
        let notation = $('#notation option:selected').val().split("-");
        return notation[0];
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne la filiere
     * @type {number}
     */
    function getFiliere() {
        let filiere = $('#notation option:selected').val().split("-");
        return filiere[1];
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne le text du textarea
     */
    function getText() {
        let text;
        return text = $('#observationcs').val();
    }

    /**
     * @author Ruben Veloso Paulos
     * Retourne l'étudiant actuel
     */
    function getUser() {
        let user;
        return user = $('#etudiantcs option:selected').val();
    }

    /**
     * @author Ruben Veloso Paulos
     * Affiche le bon tableau suivant la filière de l'étudiant
     */
    function getTableau() {
        $.each('table').hide();
    }

    /**
     * Récupère les observations si l'élève en a
     */
    function getObservation($idUtilisateur) {
        let data = { user: $idUtilisateur };
        $.ajax({
            type: "POST",
            url: "gestion/getObservation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                if (  retour.length !== 0) {
                    $('#observationcs').text(retour[0].observationProfesseur);
                } else {
                    $('#observationcs').text("");
                }
            }
        });
    }

    /**
     *  @author Ruben Veloso Paulos
     * Changement de notation affiche les étudiants de la filière pour la notation
     */
    $('#notation').change(function () {
        let data = {filiere: getFiliere()};
        $.ajax({
            type: "POST",
            url: "gestion/getEtudiant",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
                $('#etudiantcs').empty();
                $.each(retour, function (index) {
                    $('#etudiantcs').append("<option value='" + retour[index].idUtilisateur + "'>" + retour[index].idUtilisateur + "</option>");
                });
                getObservation(retour[0].idUtilisateur);
                getTableau(retour[0].idUtilisateur);
            }
        });
    });


    /**
     * Enregistre les informations saisies dans le textarea sur le focusout
     */
    $('#observationcs').focusout(function () {
        let data = {text: getText(), user: getUser(), notation: getNotation()};
        $.ajax({
            type: "POST",
            url: "gestion/saveObservation",
            data: data,
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function (retour) {
            }
        });
    });



    /**
     * Les triggers
     */
    $("#notation").trigger("change");

});
