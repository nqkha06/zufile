document.addEventListener("DOMContentLoaded", function() {
    const elmts = document.querySelectorAll(".general .general-panel button");
    elmts.forEach(elmt => {
        elmt.addEventListener("click", (event) => {
            let tab = elmt.getAttribute("data-tab");
            elmts.forEach(e => {
                e.classList.remove("active");
                tab.classList.add("d-none");
            });
            elmt.classList.toggle("active");
            if (tab) {
                tab.classList.remove("d-none");
            }
        });
    });
});