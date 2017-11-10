function fnote()
{
    // Initialise Var note + recup Wise
    note = 0;
    note = note + (5 * parseInt(document.getElementById('wiseNote').value));

    // Recup feasible
    if (document.getElementById('feasible').checked == true) {
        note = note + 50;
        document.getElementById('feasibleW').innerHTML = "50 points";
    } else {
        document.getElementById('feasibleW').innerHTML = "0 point";
    }

    // Recup notation
    note = note + parseInt(document.getElementById('notation').value);

    notationW = document.getElementById('notation').value;
    document.getElementById('notationW').innerHTML = notationW + " points";

    // Affiche le résultat
    if (note == 0) {
        document.getElementById('result').className = "red bold";
        document.getElementById('result').innerHTML = note + " point";
    }

    if (note < 50 && note != 0) {
        document.getElementById('result').className = "red bold";
        document.getElementById('result').innerHTML = note + " points";
    }

    if (note >= 50) {
        document.getElementById('result').innerHTML = note + " points";
        document.getElementById('result').className = "green bold";
    }
}


$(document).ready(function() {
    snowFall.snow($('section'), {
        minSize: 1,
        maxSize: 8,
        round: true,
        minSpeed: 1,
        maxSpeed: 2,
        flakeCount: 120,
    });

    $('body').hide();
    $('section').hide();
    $('h1').hide();


    $('body').delay(300).fadeIn();
    $('christmas').delay(400).fadeIn();

    $('h1').delay(500).fadeIn(1000);

});

var path = document.querySelector('.path');
var length = path.getTotalLength();


