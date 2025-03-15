// Script to collapse the sidebar on smaller screens

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});

/* Code to manipulate data set in table */

// token of the admin that was already saved and will be used to fetch the data
const token = localStorage.getItem("token");

$(document).ready(function () {
    $("#customers").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "http://127.0.0.1:8000/api/customers",
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${token}`,
        },
        data: function (d) {
          d.page = d.start / d.length + 1;
          d.length = d.length;
          d.draw = d.draw;
        },
        dataSrc: function (json) {
          return json.data;
        },
        pagingType: "full_numbers",
        pageLength: 10,
      },
      columns: [
        { data: "id" },
        { data: "name" },
        { data: "email" },
        { data: "phone_number" },
        { data: "location" },
      ],
    }).on('draw.dt', function () { // Add the draw.dt event listener
      const tds = document.querySelectorAll('#customers tbody td'); // select the tds inside the customer table body.
      tds.forEach(td => {
        td.style.textAlign = 'right'; // Apply your styles here
      });
    });
  
    // Customizing DataTable to the requirements of arabic langauge
    document.querySelector("label").innerHTML = "سجلات";
    document.querySelector("label").classList.add("me-2");
    document.querySelector(".dt-search label").innerHTML = "";
    document.getElementById("dt-search-0").style.border = "1.6px solid gray";
    document.getElementById("dt-search-0").placeholder = "البحث فى السجلات";
    document.getElementById("dt-search-0").classList.add("me-4");
  });


/* ===================================== */

// logout function

function logOut() {
    const token = localStorage.getItem("token");

    fetch("http://127.0.0.1:8000/api/auth/logout-admin", {
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