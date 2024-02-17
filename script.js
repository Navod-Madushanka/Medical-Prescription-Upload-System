function userQuotationUpdate(action, prescription){
    const updateQUotation = {
        action:action,
        prescription:prescription
    }

    fetch('userQuotationUpdate.php', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json', 
        },
        body:JSON.stringify(updateQUotation)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        if(data.hasOwnProperty('message')){
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function getQuotationData() {
    const table = document.getElementById('drugTable');
    const data = [];

    // Iterate through table rows
    for (let i = 1; i < table.rows.length; i++) {
        const row = table.rows[i];
        const rowData = [];

        // Iterate through cells in the row
        for (let j = 0; j < row.cells.length; j++) {
            const cell = row.cells[j];
            rowData.push(cell.textContent.trim());
        }

        // Push rowData array to data array
        data.push(rowData);
    }

    return data;
}

function sendQuotationData(id) {
    const quotationData = {
        id:id,
        data: getQuotationData()
    };

    // Send quotationData to makeQuotation.php using Fetch API
    fetch('makeQuotation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(quotationData),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        console.log('Quotation data sent successfully:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function setImages(data) {
    // Assuming data is an array of image paths
    const imageElements = [
        document.getElementById('image1'),
        document.getElementById('image2'),
        document.getElementById('image3'),
        document.getElementById('image4'),
        document.getElementById('image5')
    ];

    // Iterate through the data array and assign image paths to image elements
    data.forEach((imagePath, index) => {
        if (index < imageElements.length) {
            imageElements[index].style.backgroundImage = `url(${imagePath})`;
        }
    });
}

function goToPharmacyHome(id){
    window.location = `pharmacyHome.php?id=${id}`;
}

function getImages(id){
    fetch(`getImages.php?id=${id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json', 
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        setImages(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
// Function to add a new row to the table
function addRow(drug, qty, price) {
    var tbody = document.querySelector('#drugTable tbody');

    // Create a new row element
    var newRow = document.createElement('tr');

    // Populate the new row with data (you can replace the placeholder data with actual values)
    newRow.innerHTML = `
        <td>${drug}</td>
        <td>${qty}</td>
        <td>${price}</td>
    `;

    // Append the new row to the table body
    tbody.appendChild(newRow);
}

function addDrugErrors(data){
    const errorField = document.getElementById('error');
    if(data.hasOwnProperty(`drug`)){
        errorField.innerHTML = data.drug;
    }else {
        errorField.innerHTML = '';
    }
    if(data.hasOwnProperty(`qty`)){
        errorField.innerHTML = data.qty;
    }else {
        errorField.innerHTML = '';
    }
    if(data.hasOwnProperty(`price`)){
        errorField.innerHTML = data.price;
    }else {
        errorField.innerHTML = '';
    }
}

function addDrug(){
    const drug = document.getElementById('drug').value;
    const qty = document.getElementById('qty').value;
    const price = document.getElementById('price').value;

    const drugDetails = {
        drug:drug,
        qty:qty,
        price:price
    };

    fetch('drugValidation.php', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(drugDetails)
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error("Network response was not ok!");
    })
    .then(data => {
        if (data && Object.keys(data).length > 0) {
            addDrugErrors(data);
        } else {
            addRow(drug, qty, price);
        }
    })
    .catch(error => {
        console.error('Error during Uploading:', error);
    });
}

function uploadPrescription() {
    let formData = new FormData();

    // Get the file input elements
    const fileInputs = document.querySelectorAll('input[type="file"]');

    // Loop through each file input element
    fileInputs.forEach((input, index) => {
        // Check if a file is selected
        if (input.files.length > 0) {
            const file = input.files[0];
            // Append the file to the FormData object with a key based on its index
            formData.append(`image${index + 1}`, file);
        }
    });

    // Get other prescription details
    const note = document.getElementById('notes').value;
    const qty = document.getElementById('qty').value;
    const deliveryAddress = document.getElementById('deliveryAddress').value;

    // Append other prescription details to the FormData object
    formData.append('note', note);
    formData.append('qty', qty);
    formData.append('deliveryAddress', deliveryAddress);

    // Send prescription details to PHP via fetch
    fetch('prescriptionUpload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error("Network response was not ok!");
    })
    .then(data => {
        if (data && Object.keys(data).length > 0) {
        } else {
            alert('Prescription Uploaded Successfully');
        }
    })
    .catch(error => {
        console.error('Error during Uploading:', error);
    });
}

function openImageChooser(divNumber) {
    // Trigger the corresponding file input element when the user clicks the imageDiv
    document.getElementById('imageInput' + divNumber).click();
}

// Handle the file input change event for each file input
for (let i = 1; i <= 5; i++) {
    document.getElementById('imageInput' + i).addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('.imageDiv:nth-child(' + i + ')').style.backgroundImage = `url(${e.target.result})`;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    });
}

// user Login
function login(page, final){
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const loginData = {
        email:email,
        password:password
    }

    fetch(page, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(loginData)
    })
    .then(response =>{
        if(response.ok){
            return response.json();
        }
        throw new Error("Network response was not ok!");
    })
    .then(data =>{
        if(data && Object.keys(data).length > 0) {
            errorHandlingLogin(data);
        } else {
            window.location = final;
        }
    })
    .catch(error => {
        console.error('Error during Login:', error);
    });

}
// Login error handling
function errorHandlingLogin(data){
    if(data.hasOwnProperty(`email`)){
        document.getElementById('email-error').innerHTML = data.email;
    }else {
        document.getElementById('email-error').innerHTML = '';
    }
    if(data.hasOwnProperty(`password`)){
        document.getElementById('password-error').innerHTML = data.password;
    }else {
        document.getElementById('password-error').innerHTML = '';
    }
    if(data.hasOwnProperty(`login`)){
        document.getElementById('login-error').innerHTML = data.login;
    }else {
        document.getElementById('login-error').innerHTML = '';
    }
}

// registration error handling
function errorHandlingRegistration(data){
    if (data.hasOwnProperty('name')) {
        document.getElementById('name-error').innerHTML = data.name;
    } else {
        document.getElementById('name-error').innerHTML = '';
    }

    if(data.hasOwnProperty(`email`)){
        document.getElementById('email-error').innerHTML = data.email;
    }else {
        document.getElementById('email-error').innerHTML = '';
    }

    if(data.hasOwnProperty(`address`)){
        document.getElementById('address-error').innerHTML = data.address;
    }else {
        document.getElementById('address-error').innerHTML = '';
    }

    if(data.hasOwnProperty(`contact`)){
        document.getElementById('contact-error').innerHTML = data.contact;
    }else {
        document.getElementById('contact-error').innerHTML = '';
    }

    if(data.hasOwnProperty(`dob`)){
        document.getElementById('dob-error').innerHTML = data.dob;
    }else {
        document.getElementById('dob-error').innerHTML = '';
    }

    if(data.hasOwnProperty(`password`)){
        document.getElementById('password-error').innerHTML = data.password;
    }else {
        document.getElementById('password-error').innerHTML = '';
    }
}
// user Registration
function registration(){
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const address = document.getElementById("address").value;
    const contact = document.getElementById("contact").value;
    const dob = document.getElementById("dob").value;
    const password = document.getElementById("password").value;
    
    const registrationData = {
        name: name,
        email: email,
        address: address,
        contact: contact,
        dob: dob,
        password: password
    }

    fetch("registration_process.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(registrationData)
    })
    .then(response =>{
        if(response.ok){
            return response.json();
        }
        throw new Error("Network response was not ok!");
    })
    .then(data =>{
        if(data && Object.keys(data).length > 0) {
            errorHandlingRegistration(data);
        } else {
            // If registration is successful
            window.location = "login.php";
        }
    })
    .catch(error => {
        console.error('Error during registration:', error);
    });
}