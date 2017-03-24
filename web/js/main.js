/**
 * Created by vasilina on 24/03/2017.
 */

var mySelect = document.getElementById('app_bundle_formulaire_autreResidence');
var myBlock = document.getElementById('hideMe');

var hideMe = function() {
    if (mySelect.value === '1') {
        myBlock.style.display = 'block';
    } else if (mySelect.value === '0') {
        myBlock.style.display = 'none';
    }
};

mySelect.onchange = hideMe;
hideMe();