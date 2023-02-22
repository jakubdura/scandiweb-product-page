/*==================== ATTRIBUTE ACTIVE SWICHER ====================*/

const selectProductType = document.getElementById('productType');

window.onload = (event) => {
    var option = selectProductType.value;
    activateFormAttribute(option);
};

selectProductType.addEventListener('change', function handleChange(event) {
    var value = event.target.value;
    activateFormAttribute(value);
});

function activateFormAttribute(attribute_id) {
    let attributes = document.querySelectorAll('.form__attributes');
    let attribute = document.getElementById(attribute_id);

    attributes.forEach(elem => {
        elem.classList.remove('active-attribute');
    })
    attribute.classList.add('active-attribute');
}

/*==================== BUTTONS OPERATION ====================*/
// Cancel
const cancel_button = document.getElementById('cancel-btn');

cancel_button.addEventListener('click', function () {
    window.location.href = "/scandiweb/";
});

//Generate
const generate_button = document.getElementById('generate-btn');
var textFieldSku = document.getElementById('sku');

generate_button.addEventListener('click', function () {
    var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var numbers = "0123456789";
    var code = "";

    // generate 3 random letters and 7 random numbers
    for (var i = 0; i < 3; i++) {
        var letterIndex = Math.floor(Math.random() * letters.length);
        code += letters[letterIndex];
    }

    for (var j = 0; j < 7; j++) {
        var numberIndex = Math.floor(Math.random() * numbers.length);
        code += numbers[numberIndex];
    }
    textFieldSku.value = code;
});


