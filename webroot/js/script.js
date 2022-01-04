function changePassword() {
    let newpwdform = document.getElementById("modifmdp");

    if (newpwdform.style.display == "none") {
        newpwdform.style.display = "block";
    } else {
        newpwdform.style.display = "none";
    }

}

$(".toggle-password").click(function () {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


// choix du forfait

function changeForfait() {
    let forfaitSelector = document.getElementById('TYPE_FORFAIT');
    // Coût Adulte
    let coutAdulteContainer = document.getElementById('COUT_ADULTE_SELECT');
    let coutAdulteInput = document.getElementById('COUT_ADULTE');
    // Coût Enfant
    let coutEnfantContainer = document.getElementById('COUT_ENFANT_SELECT');
    let coutEnfantInput = document.getElementById('COUT_ENFANT');
    // Tarif Forfait global
    let tarifForfaitContainer = document.getElementById('TARIF_FORFAIT_SELECT');
    let tarifForfaitInput = document.getElementById('TARIF_FORFAIT');

    if (forfaitSelector.value == "U") { // Unitaire

        showForm(coutAdulteContainer, coutAdulteInput);
        showForm(coutEnfantContainer, coutEnfantInput);
        hideForm(tarifForfaitContainer, tarifForfaitInput);
    } else {
        showForm(tarifForfaitContainer, tarifForfaitInput);
        hideForm(coutAdulteContainer, coutAdulteInput);
        hideForm(coutEnfantContainer, coutEnfantInput);

    }


}

function showForm(container, input) {
    container.style.display = "block";
    input.required = true;
}

function hideForm(container, input) {
    container.style.display = "none";
    input.required = false;
}

function ouvertEnfants() {
    let ouvertEnfantContainer = document.getElementsByClassName('ENFANT_FORM');
    let ouvertEnfantOui = document.getElementById('OUVERT_ENFANT_OUI');
    let enfantAgeInput = document.getElementById('AGE_MINIMUM');

    if (ouvertEnfantOui.checked != true) { // Si non
        for (var i = 0; i < ouvertEnfantContainer.length; i++) {
            ouvertEnfantContainer[i].style.display = "none";
        }

        let coutEnfantInput = document.getElementById('COUT_ENFANT');
        coutEnfantInput.required = false;
        enfantAgeInput.required = false;


    } else {
        for (var i = 0; i < ouvertEnfantContainer.length; i++) {
            ouvertEnfantContainer[i].style.display = "block";
        }
        enfantAgeInput.required = true;
    }

}

function afficherP() {
    let liste = document.getElementsByClassName('listep')
    if (liste[0].style.display == 'none') {
        for (let i = 0; i < liste.length; i++) {
            liste[i].display = "none";
        }

    } else {
        for (let i = 0; i < liste.length; i++) {
            liste[i].display = "block";
        }
    }

}


function ouvertExt() {
    let ouvertExtContainers = document.getElementsByClassName('OUVERTURE_EXTER');
    let ouvertExtSelector = document.getElementById('OUVERT_EXT');
    let ouvertExtInputs = document.getElementsByClassName('ouvertExtInputs');

    if (ouvertExtSelector.value == 0) { // Si non
        for (var i = 0; i < ouvertExtContainers.length; i++) {
            ouvertExtContainers[i].style.display = "none";
        }
        for (var i = 0; i < ouvertExtInputs.length; i++) {
            ouvertExtInputs[i].required = false;
        }


    } else {
        for (var i = 0; i < ouvertExtContainers.length; i++) {
            ouvertExtContainers[i].style.display = "block";
        }
        for (var i = 0; i < ouvertExtInputs.length; i++) {
            ouvertExtInputs[i].required = true;
        }
    }

}

// Statut annulé d'un créneau

function annuleCreneau() {
    let commentaire = document.getElementById('statut_annule_commentaire');
    let select = document.getElementById('statut_annule');
    if (select.value == "S") {
        commentaire.style.display = 'block';
    } else {
        commentaire.style.display = 'none';
    }
}