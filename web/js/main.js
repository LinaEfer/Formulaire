var mySelect = document.getElementById('app_formulaire_otherResidence');
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