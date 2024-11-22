// ADD A BRAND
const newBrandButton = document.getElementById("add-brand");

newBrandButton.addEventListener("click", (e) => {
    e.preventDefault();
    if (!document.getElementById("newBrand")) {
        // INIT THE FORM
        const brandForm = document.createElement("form");
        brandForm.setAttribute("method", "POST");
        brandForm.setAttribute("action", "/add_brand");
        brandForm.setAttribute("id", "newBrand");
        brandForm.className = "mt-4";
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
        brandForm.appendChild(name);
        brandForm.appendChild(year);
        brandForm.appendChild(history);
        brandForm.appendChild(submitBrand);
        // DISPLAY THE FORM
        newBrandButton.insertAdjacentElement('afterend', brandForm)
    }
});

// SELECT A TYPE OF INSTRUMENT
const brandSelect = document.getElementById("brand-select");
const mustSelect = document.getElementById("must-select");
const typeSelect = document.getElementById("type-select");
brandSelect.addEventListener("change", (e) => {
    e.preventDefault();
    if (brandSelect.value !== "none") {
        mustSelect.remove();
        appendInstrumentForm();
        typeSelect.setAttribute('disabled', true);
    } else {
        brandSelect.insertAdjacentElement('afterend', mustSelect);
        document.getElementById('newInstrument').remove();
    }
});

// INSTRUMENT FORM
const appendInstrumentForm = () => {
    if(!document.getElementById("newInstrument")) {
        // INIT FORM
        const instrumentForm = document.createElement("form");
        instrumentForm.setAttribute("method", "POST");
        if(typeSelect.value === "guitar") {
            instrumentForm.setAttribute("action", "/add_guitar");
        } else{
            instrumentForm.setAttribute("action", "/add_piano");
        }
        instrumentForm.setAttribute("id", "newInstrument");
        instrumentForm.className = "mt-4";
        // MODEL NAME
        const modelNameLabel = document.createElement("label");
        modelNameLabel.setAttribute("for", "model");
        modelNameLabel.className = "form-label my-2";
        modelNameLabel.textContent = "Model Name";
        const modelName = document.createElement("input");
        modelName.setAttribute("type", "text");
        modelName.setAttribute("name", "model");
        modelName.setAttribute("placeholder", "Model Name");
        modelName.className = "form-control my-2";
        instrumentForm.appendChild(modelNameLabel);
        instrumentForm.appendChild(modelName);
        // DATE INPUT
        const modelYearLabel = document.createElement("label");
        modelYearLabel.setAttribute("for", "date");
        modelYearLabel.className = "form-label my-2";
        modelYearLabel.textContent = "Model Year";
        const modelYear = document.createElement("input");
        modelYear.setAttribute("type", "date");
        modelYear.setAttribute("name", "date");
        modelYear.className = "form-control my-2";
        instrumentForm.appendChild(modelYearLabel);
        instrumentForm.appendChild(modelYear);
        // DESCRIPTION
        const descriptionLabel = document.createElement("label");
        descriptionLabel.setAttribute("for", "description");
        descriptionLabel.className = "form-label my-2";
        descriptionLabel.textContent = "Description";
        const description = document.createElement("input");
        description.setAttribute("type", "text");
        description.setAttribute("name", "description");
        description.setAttribute("placeholder", "Description");
        description.className = "form-control my-2";
        instrumentForm.appendChild(descriptionLabel);
        instrumentForm.appendChild(description);

        if(typeSelect.value === "guitar") {
            // STRING NUMBER
            const stringNumberLabel = document.createElement("label");
            stringNumberLabel.setAttribute("for", "strings");
            stringNumberLabel.className = "form-label my-2";
            stringNumberLabel.textContent = "String Number";
            const stringNumber = document.createElement("input");
            stringNumber.setAttribute("type", "number");
            stringNumber.setAttribute("name", "strings");
            stringNumber.className = "form-control my-2";
            instrumentForm.appendChild(stringNumberLabel);
            instrumentForm.appendChild(stringNumber);
            // FRET NUMBER
            const fretNumberLabel = document.createElement("label");
            fretNumberLabel.setAttribute("for", "fret");
            fretNumberLabel.className = "form-label my-2";
            fretNumberLabel.textContent = "Fret Number";
            const fretNumber = document.createElement("input");
            fretNumber.setAttribute("type", "number");
            fretNumber.setAttribute("name", "fret");
            fretNumber.className = "form-control my-2";
            instrumentForm.appendChild(fretNumberLabel);
            instrumentForm.appendChild(fretNumber);
            // PICKUPS
            const pickupsLabel = document.createElement("label");
            pickupsLabel.setAttribute("for", "pickups");
            pickupsLabel.className = "form-label my-2";
            pickupsLabel.textContent = "Pickups";
            const pickups = document.createElement("input");
            pickups.setAttribute("type", "text");
            pickups.setAttribute("name", "pickups");
            pickups.setAttribute("placeholder", "Pickups");
            pickups.className = "form-control my-2";
            instrumentForm.appendChild(pickupsLabel);
            instrumentForm.appendChild(pickups);
        } else if(typeSelect.value === "piano") {
            // KEY NUMBER
            const keyNumberLabel = document.createElement("label");
            keyNumberLabel.setAttribute("for", "key");
            keyNumberLabel.className = "form-label my-2";
            keyNumberLabel.textContent = "Key Number";
            const keyNumber = document.createElement("input");
            keyNumber.setAttribute("type", "number");
            keyNumber.setAttribute("name", "key");
            keyNumber.className = "form-control my-2";
            instrumentForm.appendChild(keyNumberLabel);
            instrumentForm.appendChild(keyNumber);
        }
        // BRAND
        const brandId = document.createElement("input");
        brandId.setAttribute("type", "hidden");
        brandId.setAttribute("name", "brand");
        brandId.setAttribute("value", brandSelect.value);
        instrumentForm.appendChild(brandId);
        // SUBMIT BUTTON
        const submitInstrument = document.createElement("input");
        submitInstrument.setAttribute("type", "submit");
        submitInstrument.className = "form-control btn btn-primary my-2";
        instrumentForm.appendChild(submitInstrument);
        newBrandButton.insertAdjacentElement('afterend', instrumentForm);
    }
}