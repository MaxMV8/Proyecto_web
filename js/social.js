

function logout() {
  sessionStorage.clear();
  // Eliminar la sesión y redirigir a la página de inicio de sesión
  fetch("../php/logout.php")
    .then(() => {
      window.location.assign("signin.php");
    })
    .catch((error) => {
      console.error("Error during logout:", error);
    });
}

function createCookie(name, value, days) {
  let expires;
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toGMTString();
  } else {
    expires = "";
  }
  document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}
function dispUser(email){
  createCookie("user_mail",email,"1");
}
