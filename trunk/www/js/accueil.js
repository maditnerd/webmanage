
//Ouvre un popup
function popup(page) {
window.open(page,'popup','width=201,height=225');
}

//Validation du formulaire
function validateForm(){
var x=document.forms["accform"]["computername"].value;
if (x==null || x=="")
{  
  alert("Vous n'avez pas rentrer de nom pour l'ordinateur");
  return false;
}
else
{
var answer = confirm ("Etes vous sûr?")
if (answer)
{
return true;
}
else
{
return false;
}
}

}
