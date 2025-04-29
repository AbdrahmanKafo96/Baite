// Check if the user is admin 

if (document.readyState === "loading") {
    console.log(localStorage.getItem('role'));
  
    if(localStorage.getItem('role') !== 'employee') {
      location.assign("../../index.php");
    }
  }

        // Script to collapse the sidebar on smaller screens

        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("expand");
        });

        /* Code to manipulate data set in table */

        // token of the admin that was already saved and will be used to fetch the data
        const token = localStorage.getItem('token');

        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'http://127.0.0.1:8000/api/employees',
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    data: function(d) {
                        // Append page and draw parameters (DataTables expects this)
                        d.page = d.start / d.length + 1; // Convert `start` to `page`
                        d.length = d.length; // Send length (number of records per page)
                        d.draw = d.draw; // Send draw count
                    },
                    dataSrc: function(json) {
                        // This function modifies the data before sending to DataTable
                        return json.data; // Adjust according to your JSON structure
                    }, // Assuming the response data is directly in the array
                    pagingType: "full_numbers", // This enables pagination buttons like Next, Previous
                    pageLength: 10
                },
                // data: data,
                columns: [{
                        data: 'id'
                    },
                    // {
                    //     data: 'created_at'
                    // },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'is_active',
                        // render: function (data, type, row) {
                        //   var isActiveValue = data === 1 ? 'checked' : ''; // Set checked based on value
                        //   var switchHTML = `
                        //   <div class="d-flex justify-content-right"> 
                        //     <div class="form-check form-switch">
                        //       <input class="form-check-input switch" type="checkbox" id="switch_${row.rowIndex}" ${isActiveValue}>
                        //       <label class="form-check-label" for="switch_${row.rowIndex}"></label>
                        //     </div>
                        //   </div>  
                        //   `;
                        //   return switchHTML;
                        // }
                    }
                    // {
                    //     data: 'updated_at'
                    // }
                ]
            });

            // Customizing DataTable to the requirements of arabic langauge
            document.querySelector('label').innerHTML = 'النتائج';
            document.querySelector('label').classList.add('me-2');
            document.querySelector('.dt-search label').innerHTML = '';
            document.getElementById('dt-search-0').style.border = '1.6px solid gray';
            document.getElementById('dt-search-0').placeholder = 'البحث فى السجلات';
            document.getElementById('dt-search-0').classList.add('me-4');

            // Grab the switch value with its' id of the first cell in row
            document.querySelector('#myTable').addEventListener('change', (event) => {
                let switchValue = event.target.checked;
                console.log(switchValue);

                let row = event.target.parentElement.parentElement.parentElement.parentElement;

                console.log(row.firstChild.textContent);
                let cellId = row.firstChild.textContent;

            })

            // Attach event listener to the table body (after DataTables initialization)

            // $('.switch').on('change', function() {
            //   var currentID = $(this).data('id'); // Get the ID associated with the switch
            //   var currentValue = $(this).is(':checked'); // Get the current checked state

            //   console.log(this);


            // AJAX request
            // $.ajax({
            //     url: 'your-server-endpoint-url', // Replace with your server endpoint
            //     type: 'POST',
            //     data: {
            //         id: currentID,
            //         value: currentValue
            //     },
            //     success: function(response) {
            //         console.log('Success:', response);
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Error:', error);
            //     }
            // });
            // });

            ///////////////////////////////////// 

        });

        /* ===================================== */

        // logout function

        function logOut() {
            const token = localStorage.getItem('token');

            fetch('http://127.0.0.1:8000/api/auth/logout-admin', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    // body: `{"token": "${token}"}`
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle successful login, e.g., store token in local storage
                    console.log('Logout successful:', data);
                    localStorage.removeItem('token');
                    localStorage.removeItem('role');
                    // similar behavior as an HTTP redirect
                    window.location.replace("../../index.php");
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }


        // Register an Employee function
        const form = document.getElementById('registerEmp');

        form.addEventListener('submit', function(event) {
            const name = document.querySelector('#name').value;
            const email = document.querySelector('#email').value;
            const password = document.querySelector('#password').value;
            const passConf = document.querySelector('#passwordConf').value;

            /* Validate if both fields of password and confirm pass are a match */
            if (password !== passConf) {
                let warningPara = "<p>Ø­Ù‚Ù„ ÙƒÙ„Ù…Ø© Ø§Ù„Ù…Ø±ÙˆØ± ÙˆØªØ£ÙƒÙŠØ¯ ÙƒÙ„Ù…Ø© Ø§Ù„Ù…Ø±ÙˆØ± ØºÙŠØ± Ù…ØªÙˆØ§ÙÙ‚</p>";
                const h3 = document.querySelector('#registerEmp h3');
                h3.insertAdjacentHTML("afterend", warningPara);
                // Set attribute of class to customize a warning css style
                document.querySelector('#registerEmp p').setAttribute('class', 'warning');
            }

            fetch('http://127.0.0.1:8000/api/auth/register-employee', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        name: name
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle successful login, e.g., store token in local storage
                    console.log('Register successful:', data.data);
                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });

            event.preventDefault();
        });