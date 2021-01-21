var array = [];
var hasMatch = false;

function register() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var pwd = document.getElementById('pwd').value;
    var cpwd = document.getElementById('cpwd').value;
    var city = document.getElementById('city').value;
    var state = document.getElementById('state').value;


    var admin = {
        admin_name: name,
        admin_email: email,
        admin_pwd: pwd,
        admin_city: city,
        admin_state: state
    };

    if (localStorage.getItem('array')) {
        array = JSON.parse(localStorage.getItem('array'));
    }

    function check_user_register() {
        for (var index = 0; index < array.length; ++index) {

            var temp = array[index];

            if (temp.admin_email == email) {
                hasMatch = true;
                alert("admin already exist with same email");
                break;
            }
        }
    }
    check_user_register();
    if (hasMatch === false) {
        array.push(admin);
        console.log(array);
        localStorage.setItem("array", JSON.stringify(array));
        var ask = window.confirm("You are registerd successfully");
        if (ask) {
            window.location.href = "Login.html";
        }
    }


};