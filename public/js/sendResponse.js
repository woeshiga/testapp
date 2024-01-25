const sendButtons = document.getElementsByClassName('sendResponseButton');
[].forEach.call(sendButtons, btn => {
    btn.addEventListener('click', e => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
                if (xmlhttp.status == 200) {
                    window.location.reload();
                }
                else if (xmlhttp.status == 400) {
                    alert('There was an error 400');
                }
                else {
                    alert('something else other than 200 was returned');
                }   
            }
        };
        xmlhttp.open("PUT", document.getElementById(e.target.id.replace('sendTo', '')).value, true);
        xmlhttp.setRequestHeader("Content-Type", "application/json");
        console.log({comment: document.getElementById('c'+e.target.id.replace('sendTo', '')).value});
        xmlhttp.send(JSON.stringify({comment: document.getElementById('c'+e.target.id.replace('sendTo', '')).value}));
    })
});