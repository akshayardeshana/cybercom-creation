var array_user = [];
var hasMatch = false;

function logout() {
    sessionStorage.clear();
    window.location.href = "Login.html";

}

function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function Delete() {

}

function adduser() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var pwd = document.getElementById('pwd').value;
    var bdate = document.getElementById('bdate').value;
    var user = {
        user_name: name,
        user_email: email,
        user_pwd: pwd,
        user_bdate: bdate,

    };
    if (localStorage.getItem('array_user')) {
        array_user = JSON.parse(localStorage.getItem('array_user'));
    }

    function check_user_register() {
        for (var index = 0; index < array_user.length; ++index) {

            var temp = array_user[index];

            if (temp.user_email == email) {
                hasMatch = true;
                alert("user already exist with same email");
                break;
            }
        }
    }
    check_user_register();
    if (hasMatch === false) {
        array_user.push(user);
        console.log(array_user);
        localStorage.setItem("array_user", JSON.stringify(array_user));
        var ask = window.confirm("You are registerd successfully");
    }




}