document.getElementById('signupForm').addEventListener('submit', checkPassword);
document.getElementById('lastname').addEventListener('invalid', test);

function checkPassword(event) {
  let password = document.getElementById("password").value;
  let repassword = document.getElementById("repassword").value;
  if (password != repassword) {
    let error = document.getElementById("error");
    error.innerText = "Пароль и подтверждение не совпадают";
    error.style.display = "block";
    event.preventDefault();
  }
  let flag = document.getElementById('flag').checked;
  if (!flag) {
    let error = document.getElementById("error");
    error.innerText = "Не стоит согласие на обработку персональных данных";
    error.style.display = "block";
    event.preventDefault();
  }
  /*if(checkLogin() == false)
      event.preventDefault();*/
  event.preventDefault();
  checkLogin();
}

async function checkLogin() {
  let data = new FormData();
  let login = document.getElementById('login').value;
  let email = document.getElementById('email').value;
  data.append('login', login);
  data.append('email', email);
  let response = await fetch('./checklogin.php', {
    method: "POST",
    body: data
  });
  let result = await response.json();
  //console.log(result);
  if (result.status == 'error') {
    let error = document.getElementById("error");
    error.innerText = result.message;
    error.style.display = "block";
  } else {
    document.getElementById('signupForm').submit();
  }
}