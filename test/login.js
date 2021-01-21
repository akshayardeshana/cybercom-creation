var array = [];

function checkuser() {
    var email = document.getElementById('uid').value;
    var pwd = document.getElementById('pwd').value;

    if (sessionStorage.getItem('array')) {
        array = JSON.parse(sessionStorage.getItem('array'));
    }

    function check_user_register() {
        for (var index = 0; index < array.length; ++index) {

            var temp = array[index];

            if (temp.admin_email == email && temp.admin_pwd == pwd) {
                hasMatch = true;
                alert("login successfull");
                break;
            }
        }
    }
    check_user_register();

};