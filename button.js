function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                window.location.href = "page1.php";
            } else {
                console.error("Error during logout: " + xhr.status);
            }
        }
    };
    xhr.send();
}
function logout1() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout1.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log(xhr.responseText);
                window.location.href = "page1.php";
            } else {
                console.error("Error during logout: " + xhr.status);
            }
        }
    };
    xhr.send();
}
function home() {
    window.location.href = "main.php";
}
function function1(parameter) {

    var i, x;
    var x = document.getElementsByClassName("user");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(parameter).style.display = "block";
}
function myfunction1(parameter) {

    var i, x;
    var x = document.getElementsByClassName("del");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(parameter).style.display = "block";
}
function checkUser() {
    var user_id = getCookie('user_id');

    if (user_id) {
        window.location.href = 'userpanel.php';
    } else {
        alert('Unauthorized user');
    }
}
function checkUser1() {

    var admin_id = getCookie('admin_id');

    if (admin_id) {
        window.location.href = 'adminpanel.php';
    } else {
        alert('Unauthorized user');
    }
}
function getCookie(name) {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.startsWith(name + '=')) {
            return cookie.substring(name.length + 1);
        }
    }
    return null;
}   
function check() {
    if (document.cookie.includes('user_id')) {
        window.location.href = "mycart.php";
    } else {
        alert('Please login');
    }
}