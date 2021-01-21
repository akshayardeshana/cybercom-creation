var array = [];

function registerfun() {
    window.location.href = "Registration.html";

}

function checkuser() {
    var email = document.getElementById('uid').value;
    var pwd = document.getElementById('pwd').value;

    if (localStorage.getItem('array')) {
        array = JSON.parse(localStorage.getItem('array'));
    }

    function check_user_register() {
        for (var index = 0; index < array.length; ++index) {

            var temp = array[index];

            if (temp.admin_email == email && temp.admin_pwd == pwd) {
                hasMatch = true;
                alert("login successfull");
                sessionStorage.setItem("name", temp.admin_name);

                window.location.href = "Dashboard.html";

                break;
            }
        }
    }
    check_user_register();

};