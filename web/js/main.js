var mySelect = document.getElementById('app_formulaire_otherResidence');
var myBlock = document.getElementById('hideMe');
console.log(mySelect);

var hideMe = function() {
    if (mySelect.value === '1') {
        console.log(mySelect.value);
        myBlock.style.display = 'block';
    } else if (mySelect.value === '0') {
        console.log(mySelect.value);
        myBlock.style.display = 'none';
    }
};

mySelect.onchange = hideMe;
hideMe();