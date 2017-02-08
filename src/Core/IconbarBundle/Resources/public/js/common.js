

function checkField(type,idField,dontExcludeWaiting,checkTrack) 
{
    
    dontExcludeWaiting = dontExcludeWaiting || 0;
    checkTrack = checkTrack || 0;
    
     var field = document.getElementById(idField);        
 
     var value = field.value;
 
     var classRow = idField+"Row";
     var classPrec = idField+"Precision";
 
     $("#"+classRow).removeClass('has-success');
     $("#"+classRow).removeClass('has-error');
     $("#"+classRow).removeClass('has-warning');
     document.getElementById(classPrec).innerHTML =  "";
 
    // Obliger de passer par une page intermédiaire qui est sur my.capteev.com sinon le navigateur bloque la requête (cross-domain bloqué)
    if (value.length > 0)
    {
        
        var url = "http://my.capteev.com/ws/availability.php";
        if (checkTrack)
            url = "http://my.capteev.com/ws/availability.php?checkTrack=1";
            
        // var data = { pseudoInsta : value };
        var dataP = type+'='+value;

        $.post(url, dataP,function(data, status){
            //alert(data);
            var reponse = $.parseJSON(data);
            
            if (reponse['error'] == 'USER_IN_WAITING_LIST' && dontExcludeWaiting == 1)
            {
                // C'est le cas où on l'on est dans le formulaire d'activation des comptes déjà en waiting list, côté utilisateur.
                reponse['success'] = true;  
            }
        
            if (reponse['success'] == true)
            {
                if (type == "pseudoInsta" && reponse['noTrack'] == true)
                {
                    // Pseudo non enregistré en vase
                    document.getElementById("pseudoInstaPrecision").innerHTML = "Ce profil n'est pas présent dans la liste de tracking. Il sera donc automatiquement ajouté.";
                    document.getElementById(classRow).className += " has-warning";
                }
                else if (type == "brand" && reponse['isNotDeclared'] == true)
                {
                    // Quand on créé une campagne pour une marque qui n'est pas utilisateur
                    document.getElementById("brandPrecision").innerHTML = "Cette marque n'a pas encore été déclarée, mais la création de campagne reste possible.";
                    document.getElementById(classRow).className += " has-warning";
                }
                else
                {
                    document.getElementById(classRow).className += " has-success";
                    if (reponse['email'])
                    {
                        // Cas du formulaire d'invitation de compte influenceurs côté admin
                        document.getElementById('email1').value =  reponse['email'];
                        checkField('email','email1');
                    }
                    if (reponse['snapchat'])
                    {
                        // Cas du formulaire d'invitation de compte influenceurs côté admin
                        document.getElementById('snapchat').value =  reponse['snapchat'];
                    }
                }
            }
            else
            {
                document.getElementById(classRow).className += " has-error";
                document.getElementById(classPrec).innerHTML = document.getElementById(reponse['error']).innerHTML;     
            }
    
        });
    }    
}


function checkBrandField(idField,type,idBrandOrigin) 
{
     idBrandOrigin = idBrandOrigin || 0;
         
     var field = document.getElementById(idField);        
 
     var value = field.value;
 
     var classRow = idField+"_row";
     var classPrec = idField+"_precision";
 
     $("#"+classRow).removeClass('has-success');
     $("#"+classRow).removeClass('has-error');
     $("#"+classRow).removeClass('has-warning');
     
     document.getElementById(classPrec).innerHTML =  "";
 
    // Obliger de passer par une page intermédiaire qui est sur my.capteev.com sinon le navigateur bloque la requête (cross-domain bloqué)
    if (value.length > 0)
    {
        
        var url = "http://my.capteev.com/ws/availability.php?fromBrandCheck=1&idBrand="+idBrandOrigin;
            
        // var data = { pseudoInsta : value };
        var dataP = type+'='+value;

        $.post(url, dataP,function(data, status){

            var reponse = $.parseJSON(data);
                    
            if (reponse['success'] == true)
            {
                document.getElementById(classPrec).innerHTML = "";
                document.getElementById(classRow).className += " has-success";
            }
            else
            {
                document.getElementById(classRow).className += " has-error";
                document.getElementById(classPrec).innerHTML = document.getElementById(reponse['error']).innerHTML;     
            }
    
        });
    }    
}

 
      