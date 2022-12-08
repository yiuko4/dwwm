/* prenom nom*/
let btnModifPrenom = document.querySelector("#btnModifPrenom");
let btnValidModifPrenom = document.querySelector("#btnValidModifPrenom");
let divPrenom = document.querySelector("#prenom");
let divModificationPrenom = document.querySelector("#modificationPrenom");
btnModifPrenom.addEventListener("click", function(){
    divPrenom.classList.add("d-none");
    divModificationPrenom.classList.remove("d-none");
    divMail.classList.remove("d-none");
    divModificationMail.classList.add("d-none");
    divTelephone.classList.remove("d-none");
    divModificationTelephone.classList.add("d-none");
    btnAnnulModif.classList.remove("d-none");
    divModificationPassword.classList.add("d-none");
    divPassword.classList.remove("d-none");
})


/* mail */
let btnModifMail = document.querySelector("#btnModifMail");
let btnValidModifMail = document.querySelector("#btnValidModifMail");
let divMail = document.querySelector("#mail");
let divModificationMail = document.querySelector("#modificationMail");
btnModifMail.addEventListener("click", function(){
    divMail.classList.add("d-none");
    divModificationMail.classList.remove("d-none");
    divTelephone.classList.remove("d-none");
    divModificationTelephone.classList.add("d-none");
    divPrenom.classList.remove("d-none");
    divModificationPrenom.classList.add("d-none");
    btnAnnulModif.classList.remove("d-none");
    divModificationPassword.classList.add("d-none");
    divPassword.classList.remove("d-none");
}) 


/* telephone */
let btnModifTelephone = document.querySelector("#btnModifTelephone");
let btnValidModifTelephone = document.querySelector("#btnValidModifTelephone");
let divTelephone = document.querySelector("#telephone");
let divModificationTelephone = document.querySelector("#modificationTelephone");
btnModifTelephone.addEventListener("click", function(){
    divTelephone.classList.add("d-none");
    divModificationTelephone.classList.remove("d-none");
    divMail.classList.remove("d-none");
    divModificationMail.classList.add("d-none");
    divPrenom.classList.remove("d-none");
    divModificationPrenom.classList.add("d-none");
    btnAnnulModif.classList.remove("d-none");
    divModificationPassword.classList.add("d-none");
    divPassword.classList.remove("d-none");
}) 


/* password */
let btnModifPassword = document.querySelector("#btnModifPassword");
let btnValidModifPassword = document.querySelector("#btnValidModifPassword");
let divPassword = document.querySelector("#password");
let divModificationPassword = document.querySelector("#modificationPassword");
btnModifPassword.addEventListener("click", function(){
    divPassword.classList.add("d-none");
    divModificationPassword.classList.remove("d-none");
    divTelephone.classList.remove("d-none");
    divModificationTelephone.classList.add("d-none");
    divPrenom.classList.remove("d-none");
    divModificationPrenom.classList.add("d-none");
    btnAnnulModif.classList.remove("d-none");
}) 





/* annuler modification */
let btnAnnulModif = document.querySelector("#btnAnnulModif");
btnAnnulModif.addEventListener("click", function(){
    btnAnnulModif.classList.add("d-none");
    divPrenom.classList.remove("d-none");
    divModificationPrenom.classList.add("d-none");
    divMail.classList.remove("d-none");
    divModificationMail.classList.add("d-none");
    divModificationPrenom.classList.add("d-none");
}) 


 document.querySelector("#btnSupCompte").addEventListener("click", function(){
    document.querySelector("#suppressionCompte").classList.remove("d-none");
}) 
