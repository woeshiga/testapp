const logoutButton = document.getElementById('logOutButton');
const logoutRoute = document.getElementById('logoutRoute').value;
console.log(logoutRoute);
logoutButton.addEventListener("click", e => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
           if (xmlhttp.status == 200) {
               window.location.replace('/');
           }
           else if (xmlhttp.status == 400) {
              alert('There was an error 400');
           }
           else {
               alert('something else other than 200 was returned');
           }
        }
    };
    xmlhttp.open("POST", logoutRoute, true);
    xmlhttp.send();
});