//une fonction ^pour confirmer la suppressions d'un produit
function confirmerSuppression(){ 
    return confirm("Voulez-vous vraiment supprimer ce produit ?");
}

//une fonction pour s'assurer que l'utilisateur veut vraiment vider le panier
function viderPanier(){
    return confirm("Voulez-vous vraiment vider le panier ?");
}

//une fonction pour confirmer la déconnexion
function Deconnexion(){
    return confirm("Voulez-vous vraiment vous déconnecter ?");
}

//une fonction qui vérifie que tous les champs du formulaire d'inscription sont valides
function verifFormulaire(){
    return verifNom() && verifMail() && confirmePasse();
}
//on s'assure que les 2 mots de passe soient identiques
function confirmePasse(){
    var passe1 = document.getElementById('motdepasse').value;
    var passe2 = document.getElementById('motdepasseconfirm').value;
    if(passe1 !== passe2){           
        alert("Mots de passe différents");
        return false;
    }else{
        return true;
    }
}

//on s'assure que l'email saisi contienne bien un @ et un . mais pas d'espace
function verifMail(){
    var email= document.getElementById('email').value;
    if(email.includes("@") && email.includes(".") && !email.includes(" ")){
        return true;
    }else{
         alert("L'email saisi n'est pas valide");
         return false;
    }
}

//on s'assure que le nom saisi ne contienne ni point ni espace ni @ 
function verifNom(){
    var nom = document.getElementById('nom').value;
    if(nom.includes(" ") || nom.includes(".") || nom.includes("@")){
        alert("Le nom ne doit contenir ni espace ni point ni caractère spécial");
        return false;
    }else{
        return true;
    }
}
