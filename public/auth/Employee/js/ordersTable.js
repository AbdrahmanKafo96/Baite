 // token of the Employee that was already saved and will be used to fetch the data
 const token = localStorage.getItem("token");

 // Script to collapse the sidebar on smaller screens

 const hamBurger = document.querySelector(".toggle-btn");

 hamBurger.addEventListener("click", function() {
     document.querySelector("#sidebar").classList.toggle("expand");
 });

 // #################################

$(document).ready(function() {
     
    fetch("http://127.0.0.1:8000/api/orders", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            accept: "application/json",
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle successful login, e.g., store token in local storage
            console.log("Orders retreived successful:", data);
            // window.location.replace("../../index.php");
            if(data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/ad.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">Ù„Ø§ ØªÙˆØ¬Ø¯ Ø¥Ø¹Ù„Ø§Ù†Ø§Øª</h3>`;
                document.getElementById('orders').appendChild(wrapperDiv);
            } else {
                const tableBody = document.querySelector('#customersOrders tbody');
                // console.log(data[0].order_number);
                
                // Create the rows
                data.map((item, index) => {
                    const row = document.createElement('tr');

                    const idCell = document.createElement('td');
                    idCell.textContent = item.id;

                    const orderNum = document.createElement('td');
                    orderNum.textContent = item.order_number;

                    const note = document.createElement('td');
                    note.textContent = item.note;

                    const status = document.createElement('td');
                    status.textContent = item.status;

                    const phoneNum = document.createElement('td');
                    phoneNum.textContent = item.phone_number;

                    const totalPrice = document.createElement('td');
                    totalPrice.textContent = item.total_price;

                    const action = document.createElement('td');
                    action.innerHTML = '<button type="button" class="btn btn-primary fw-bold">تفاصيل</button>';

                    row.appendChild(idCell);
                    row.appendChild(orderNum);
                    row.appendChild(note);
                    row.appendChild(status);
                    row.appendChild(phoneNum);
                    row.appendChild(totalPrice);
                    row.appendChild(action);

                    tableBody.appendChild(row);
                    
                })
                           
            }

        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });
    
});

 // #################################


 // logout function

 function logOut() {
     const token = localStorage.getItem("token");

     fetch("http://127.0.0.1:8000/api/auth/logout-employee", {
             method: "POST",
             headers: {
                 "Content-Type": "application/json",
                 accept: "application/json",
                 Authorization: `Bearer ${token}`,
             },
             // body: `{"token": "${token}"}`
         })
         .then((response) => {
             if (!response.ok) {
                 throw new Error("Network response was not ok");
             }
             return response.json();
         })
         .then((data) => {
             // Handle successful login, e.g., store token in local storage
             console.log("Logout successful:", data);
             localStorage.removeItem("token");
             // similar behavior as an HTTP redirect
             window.location.replace("../../index.php");
         })
         .catch((error) => {
             console.error(
                 "There has been a problem with your fetch operation:",
                 error
             );
         });
 }