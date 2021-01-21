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

    if (sessionStorage.getItem('array')) {
        array = JSON.parse(sessionStorage.getItem('array'));
    }

    function check_user_register() {
        for (var index = 0; index < array.length; ++index) {

            var temp = array[index];

            if (temp.admin_name == name) {
                hasMatch = true;
                alert("admin already exist with same email");
                break;
            }
        }
    }

    if (hasMatch === false) {

        array.push(admin);
        console.log(array);
        sessionStorage.setItem("array", JSON.stringify(array));
        alert(name + " " + email + " added at index " + array.length);

    }


};