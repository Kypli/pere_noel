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
        document.getElementById('result').innerHTML = note + "point";
    } else {
        document.getElementById('result').innerHTML = note + "points";
    }
}


