const newBrandButton = document.getElementById("add-brand");

newBrandButton.addEventListener("click", (e) => {
    e.preventDefault();
    // INIT THE FORM
    const form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "/add_brand");
    form.setAttribute("id", "newBrand");
    form.className = "mt-4";
    // NAME INPUT
    const name = document.createElement("input");
    name.setAttribute("type", "text");
    name.setAttribute("name", "name");
    name.setAttribute("placeholder", "Brand Name");
    name.className = "form-control my-2";
    // DATE INPUT
    const year = document.createElement("input");
    year.setAttribute("type", "date");
    year.setAttribute("name", "date");
    year.className = "form-control my-2";
    // HISTORY INPUT
    const history = document.createElement("input");
    history.setAttribute("type", "text");
    history.setAttribute("placeholder", "Brand History");
    history.setAttribute("name", "history");
    history.className = "form-control my-2";
    // SUBMIT BUTTON
    const submitBrand = document.createElement("input");
    submitBrand.setAttribute("type", "submit");
    submitBrand.className = "form-control btn btn-primary my-2";
    // CREATE THE FORM
    form.appendChild(name);
    form.appendChild(year);
    form.appendChild(history);
    form.appendChild(submitBrand);
    // DISPLAY THE FORM
    newBrandButton.insertAdjacentElement('afterend', form)
})