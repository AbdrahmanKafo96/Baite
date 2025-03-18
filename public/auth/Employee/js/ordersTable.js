 // token of the Employee that was already saved and will be used to fetch the data
 const token = localStorage.getItem("token");

 // Script to collapse the sidebar on smaller screens

 const hamBurger = document.querySelector(".toggle-btn");

 hamBurger.addEventListener("click", function() {
     document.querySelector("#sidebar").classList.toggle("expand");
 });

 // Pass data to the modal 
 function addDetails(order) {    
    const modalBody = document.querySelector('.modal-body');
    
    let btnsDetails = document.querySelectorAll('.modal-body p');    

    function loopThroughOrder() {
        order.map((item, index) => {         
            para = document.createElement('p');
            para.setAttribute('class', 'fw-bold');
            para.style.fontSize = '20px';
            para.innerHTML = `<span><i class="fa-solid fa-wrench"></i> إسم الخدمة:</span> ${item.service_name}`;
    
            modalBody.appendChild(para);
        });
    }

    if (btnsDetails.length === 0) {
        loopThroughOrder();
    } else {
        btnsDetails.forEach((item, index) =>{
            item.remove();
        })    

        loopThroughOrder();
    }
}

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
                <h3 class="text-center">لا توجد سجلات</h3>`;
                document.getElementById('orders').appendChild(wrapperDiv);
            } else {
                const tableBody = document.querySelector('#customersOrders tbody');

                const objs = [];

                // console.log(data[0].order_details);
                
                // Create the rows
                data.map((item, index) => {

                        objs.push(item.order_details);

                    const row = document.createElement('tr');

                    const idCell = document.createElement('td');
                    idCell.textContent = item.id;

                    const orderNum = document.createElement('td');
                    orderNum.textContent = item.order_number;

                    const note = document.createElement('td');
                    note.textContent = item.note;

                    const status = document.createElement('td');
                    status.innerHTML = `<select id="drop${index}" name="cars" data-order-number=${item.order_number}>
                        <option value="pending">قيد الإنتظار</option>
                        <option value="confirmed">مؤكد</option>
                        <option value="canceled">تم الإلغاء</option>
                        <option value="shipping">شحن</option>
                        <option value="delivered">تم التوصيل</option>
                    </select>`;
                                        
                    const phoneNum = document.createElement('td');
                    phoneNum.textContent = item.phone_number;

                    const totalPrice = document.createElement('td');
                    totalPrice.textContent = item.total_price;

                    const action = document.createElement('td');
                    action.innerHTML = '<button type="button" class="btn btn-primary fw-bold details" data-bs-toggle="modal" data-bs-target="#detailsModal">تفاصيل</button>';

                    row.appendChild(idCell);
                    row.appendChild(orderNum);
                    row.appendChild(note);
                    row.appendChild(status);
                    row.appendChild(phoneNum);
                    row.appendChild(totalPrice);
                    row.appendChild(action);

                    tableBody.appendChild(row);  
                    
                    document.querySelector(`select#drop${index}`).value = item.status;
                                    
                })         

                btnsDetails = document.querySelectorAll('.details');
                // console.log(objs);
                
                btnsDetails.forEach((item, index) => {
                    item.addEventListener("click", function() {
                        addDetails(objs[index]);
                    });
                });
                // Sending the status of the order -----
                const drops = document.querySelectorAll('select');
                // const successModal = new bootstrap.Modal(document.getElementById("successModal"));
    
                drops.forEach((item) => {
                    item.addEventListener('change', () => {
                        console.log(item.dataset.orderNumber, item.value);

                        // Now we use the API to update the status   
                        fetch("http://127.0.0.1:8000/api/orders-status", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                accept: "application/json",
                                Authorization: `Bearer ${token}`,
                            },
                            body: JSON.stringify(
                                {
                                   "status": item.value,
                                   "order_number": item.dataset.orderNumber
                                }
                            )
                        })
                            .then((response) => {
                                if (!response.ok) {
                                    throw new Error("Network response was not ok");
                                }
                                return response.json();
                            })
                            .then((data) => {
                                // Handle successful login, e.g., store token in local storage
                                console.log("Status updated successful:", data);
                                // Show a success notice ////
                                $('#update-header').css('visibility', 'visible');

                                    setTimeout(function() {
                                        $('#update-header').fadeOut(function() {
                                        // Callback function executed after fadeOut completes
                                        $('#update-header').css('visibility', 'hidden');
                                        });
                                    }, 3500);
                                /////////////////////////////
                            })
                            .catch((error) => {
                                //////
                            });
                    });
                    
                })
                    
                // ====================================
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

    // function test() {
    //   $('#update-header').css('visibility', 'visible');

    //   setTimeout(function() {
    //     $('#update-header').fadeOut(function() {
    //       // Callback function executed after fadeOut completes
    //       $('#update-header').css('visibility', 'hidden');
    //     });
    //   }, 2500);
    // }
    
