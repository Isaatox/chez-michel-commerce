
function dropdownPrix() {
    document.getElementById("dropdownPrix").classList.toggle("show");

    document.getElementById("dropdownCouleur").classList.remove("show");
    document.getElementById("dropdownOrdre").classList.remove("show");
    document.getElementById("dropdownCategorie").classList.remove("show");
}

function dropdownCouleur() {
    document.getElementById("dropdownCouleur").classList.toggle("show");

    document.getElementById("dropdownOrdre").classList.remove("show");
    document.getElementById("dropdownCategorie").classList.remove("show");
    document.getElementById("dropdownPrix").classList.remove("show");
}

function dropdownOrdre() {
    document.getElementById("dropdownOrdre").classList.toggle("show");


    document.getElementById("dropdownCouleur").classList.remove("show");
    document.getElementById("dropdownCategorie").classList.remove("show");
    document.getElementById("dropdownPrix").classList.remove("show");
}

function dropdownCategorie() {
    document.getElementById("dropdownCategorie").classList.toggle("show");


    document.getElementById("dropdownCouleur").classList.remove("show");
    document.getElementById("dropdownOrdre").classList.remove("show");
    document.getElementById("dropdownPrix").classList.remove("show");
}

const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);

        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});

var inputs = document.querySelectorAll('.container input');
inputs.forEach(function (input) {
    input.addEventListener('change', function () {
        if (this.checked) {
            this.nextElementSibling.classList.add('selected');
            this.setAttribute('checked', '');
        } else {
            this.nextElementSibling.classList.remove('selected');
            this.removeAttribute('checked', '');

        }
    });
});
var inputs = document.querySelectorAll('#dropdownOrdre input');
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('change', function () {
        var previouslyChecked = document.querySelector("#dropdownOrdre input[checked]");
        if (previouslyChecked) previouslyChecked.removeAttribute("checked");
        this.setAttribute("checked", '');
        sortProducts(this.value);
    });
}
