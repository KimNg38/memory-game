    
var winGame = false; 
var returnedCard = "";
var returnedImage = "";
var foundCard = 0;
var Source = "#gameCard";
var sourceImage = [
  "img0","img1","img2","img3","img4","img5","img6","img7","img8","img9","img10","img11","img12","img13"
];


$(document).ready(function() {
     // si on clique sur le bouton jouer
     $("#btnPlay").click(function(){
          // on affiche certaines blocs et on en cache d'autres
          $("#gameCard").show();
          $("#progressionBar").show();
          $("#bestTimeList").hide();
          $("#btnPlay").hide();
              
          // on fait partir la barre de progression avec un temps d'une seconde entre chaque valeur
          var ProgressionBar = $('#progressionBar');
          var max = ProgressionBar.attr('max'), 
          time = 1000, 
          value = ProgressionBar.val();

          var Telechargement = function() {
               value += 1;
               addValue = ProgressionBar.val(value);

               // si le temps est écoulé et qu'on a pas gagné
               if (value == max && !winGame) {
                clearInterval(animation);   
                alert('Perduuuuuu, le temps est écoulé ... c\'est pas grave, reviens quand même pour jouer !');             
                window.location = 'index.php';
               }
               else{
                    if(winGame){
                         clearInterval(animation); 
                         //un temps en secondes
                         var t = value;
                         //secondes
                         var s = t % 60;
                         //minutes
                         var m = Math.floor(t / 60);

                         //affichage
                          var chaineTemps = m+":"+s;


                         alert('Gagnééééééé .... c\'est qui le plus fort ??? c\'est bibi !! Tu as mis '+ chaineTemps +' min. !');
                         
                         $.ajax({
                                   url:"model/insertBestTime.php",
                                   type: "POST",
                                   data : {playTimeValue: value},
                                   success:function(response) {
                                        window.location = 'index.php';
                                   },
                                   error:function(){
                                        alert("Error");
                                   }
                              });      
                    }
                    else
                    {
                       console.log("erreur de jeu");  
                    }
               } 

          };
         
          var animation = setInterval(function() {
            Telechargement();
          }, time);

     }); 
  
});

// fonction qui retourne un nombre aléatoire
function RandomFunction(MaxValue, MinValue) {
     return Math.round(Math.random() * (MaxValue - MinValue) + MinValue);
}

// Fonction qui mixe les cartes de manières aléatoires
function mixCard() {
     var AllCard = $(Source).children();
     var ThisCard = $(Source + " div:first-child");
     var ArrayOfCard = new Array();

     for (var i = 0; i < AllCard.length; i++) {
          ArrayOfCard[i] = $("#" + ThisCard.attr("id") + " img").attr("id");
          ThisCard = ThisCard.next();
     }

     ThisCard = $(Source + " div:first-child");

     for (var z = 0; z < AllCard.length; z++) {
     var RandomNumber = RandomFunction(0, ArrayOfCard.length - 1);

          $("#" + ThisCard.attr("id") + " img").attr("id", ArrayOfCard[RandomNumber]);
          ArrayOfCard.splice(RandomNumber, 1);
          ThisCard = ThisCard.next();
     }
}

// fonction qui gère le retournement des cartes
function ReturnCard() {
     var id = $(this).attr("id");

     if ($("#" + id + " img").is(":hidden")) {
          $(Source + " div").unbind("click", ReturnCard);

          $("#" + id + " img").slideDown('fast');
          // si on retourne la première image de la paire 
          if (returnedImage == "") {
               returnedCard = id;
               returnedImage = $("#" + id + " img").attr("id");
               setTimeout(function() {
                    $(Source + " div").bind("click", ReturnCard)
               }, 300);
          } else {
               // on récupère la deuxième image
               CurrentReturned = $("#" + id + " img").attr("id");
               // si la 1er image est différente de la 2ième image
               if (returnedImage != CurrentReturned) {
                    setTimeout(function() {
                         $("#" + id + " img").slideUp('fast');
                         $("#" + returnedCard + " img").slideUp('fast');
                         returnedCard = "";
                         returnedImage = "";
                    }, 400);
               // on a trouver la bonne paire, on laisse les cartes retournées     
               } else {
                    foundCard++;
                    returnedCard = "";
                    returnedImage = "";
               }
               setTimeout(function() {
                    $(Source + " div").bind("click", ReturnCard)
               }, 400);
          }
          // si on a trouvé toutes les paires
          if (foundCard == sourceImage.length) {
              winGame=true
          }
     }
}


// fonction qui créé le plateau de jeu et mixe les cartes
$(function() {
     for (var y = 1; y < 3 ; y++) {
          $.each(sourceImage, function(i, val) {
               $(Source).append("<div id=card" + y + i + "><img id=" + val + " />");
          });
     }
     $(Source + " div").click(ReturnCard);
     mixCard();
});

