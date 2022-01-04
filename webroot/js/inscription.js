function addInscriptionInput(type) {
    // type sera égal à "famille" où à "ext"
    let formContainer = document.getElementById("invites" + type);
    let baseSelectInput = document.getElementsByClassName("participant" + type)
    let base = baseSelectInput[0];
    formContainer.insertAdjacentHTML('beforeend', base.outerHTML);

}

function removeInscriptionInput(type){
    // type sera égal à "famille" où à "ext"
    let baseSelectInput = document.getElementsByClassName("participant" + type)
    if(baseSelectInput.length < 2){
        baseSelectInput[0].value = 'none';
    }else{
        let latestInput = baseSelectInput[baseSelectInput.length - 1];
        latestInput.remove();
    }

}
