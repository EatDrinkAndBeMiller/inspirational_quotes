const resetAuthorsCategories = () => {
    //reset select menus
    const selectMenuOptions = document.querySelectorAll(
        "select option"
    );
    selectMenuOptions.forEach((option) => {
        if (
            option.text === "View All Authors" ||
            option.text === "View All Categories"
        ) {
            option.selected = true;
            option.defaultSelected = true;
        } else {
            option.selected = false;
            option.defaultSelected = false;
        }
    });
};

const initApp = () => {
    document
        .getElementById("resetAuthorsCategories")
        .addEventListener("click", resetAuthorsCategories);
};

document.addEventListener("DOMContentLoaded", initApp);