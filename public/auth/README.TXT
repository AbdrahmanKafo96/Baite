fetch('/api/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    username: 'your_username',
    password: 'your_password'
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
  console.log('Login successful:', data);
  localStorage.setItem('token', data.token); 
})
.catch(error => {
  console.error('There has been a problem with your fetch operation:', error);
});