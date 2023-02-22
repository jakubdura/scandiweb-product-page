/*==================== BUTTONS OPERATION ====================*/
// Add
const add_button = document.getElementById('add-product-btn');
add_button.addEventListener('click', function () {
    window.location = '/scandiweb/add-product';
});

// Delete
const delete_button = document.getElementById('delete-product-btn');
delete_button.addEventListener('click', function () {
    if (anyIsChecked()) {
        removaAnimation();
        setTimeout(function () {
            submitRemovalForm();
        }, 1000);
    } else {
        alert('Select at least one product for delete.');
    }

});

/*==================== REMOVAL PRODUCTS ====================*/
function submitRemovalForm() {
    document.getElementById("delete_form").submit();
}

function removaAnimation() {
    var items = document.querySelectorAll('.list__item');
    items.forEach(item => {
        const checkbox = item.querySelector(".delete-checkbox");
        if (checkbox.checked) {
            item.style.opacity = 0;
            item.style.transform = 'scale(.9)';
        }
    });
}

function anyIsChecked() {
    const removalForm = document.getElementById('delete_form');
    const checkboxes = removalForm.querySelectorAll('input[type="checkbox"]');

    let anyChecked = false;

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            anyChecked = true;
        }
    });

    return anyChecked;
}
