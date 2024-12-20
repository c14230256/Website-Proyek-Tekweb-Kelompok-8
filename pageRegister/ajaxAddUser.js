document
  .getElementById("registerForm")
  .addEventListener("submit", function (e) {
    //Menghentikan redirect/refresh ketika click button
    e.preventDefault();

    //variable untuk cek email jika valid atau tidak (harus memiliki @abc dan .abc)
    const emailInput = document.getElementById("email").value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    // response message
    document.getElementById("responseMessage").innerHTML = "";  

    //cek jika email valid
    if (!emailRegex.test(emailInput)) {
        // jika tidak maka munculkan alert
        document.getElementById("responseMessage").innerHTML =
          '<div class="alert alert-danger">Please enter a valid email address.</div>';
        return;
    };

    const formData = new FormData(this);


    //fetch adduser.php untuk melakukan query registerUser
    fetch("addUser.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log("Server response:", data);
        document.getElementById(
          "responseMessage"
        ).innerHTML = `<div class="alert alert-info">${data}</div>`
      })
      .catch((error) => {
        console.error("Error: ", error)
        document.getElementById("responseMessage").innerHTML =
          '<div class="alert alert-danger">An error occurred. Please try again.</div>'
      });
  });
