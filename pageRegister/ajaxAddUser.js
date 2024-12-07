document
  .getElementById("registerForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const emailInput = document.getElementById("email").value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    console.log("Email entered:", emailInput);
    console.log("Form submission intercepted!");

    document.getElementById("responseMessage").innerHTML = "";  

    if (!emailRegex.test(emailInput)) {
        document.getElementById("responseMessage").innerHTML =
          '<div class="alert alert-danger">Please enter a valid email address.</div>';
        return;
    };

    const formData = new FormData(this);

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
