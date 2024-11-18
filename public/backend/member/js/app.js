document.addEventListener("DOMContentLoaded", function () {
    const CREATE_STU = new STU({
        select: '#CREATE_STU',
        type: 'create',
    });
    const CREATE_NOTE = new NOTE({
        select: '#CREATE_NOTE',
        type: 'create',
    });
    
    const labelsCreate = document.querySelectorAll('label.fc[for="forCreate"], label.c[for="forCreate"]');
    const checkboxsCreate = document.querySelectorAll('[id="forSTU"], [id="forNOTE"]');
    
    if (checkboxsCreate) {
        labelsCreate.forEach(function (label) {
            label.addEventListener('click', function () {
                checkboxsCreate.forEach(function (checkbox) {
                    checkbox.checked = false;
                    document.querySelector('body').classList.remove('no-scroll')
                })
            });
        });
    }
});