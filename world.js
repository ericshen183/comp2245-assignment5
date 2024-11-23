document.addEventListener('DOMContentLoaded', function() {
    let btn = document.getElementById('lookup');
    btn.addEventListener('click', function(event) {
        event.preventDefault();

        let country = document.getElementById('country').value;
        let httpRequest = new XMLHttpRequest();
        let url = 'world.php?country=' + country;
        httpRequest.open('GET', url, true);
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    let result = document.getElementById('result');
                    result.innerHTML = httpRequest.responseText;
                } else {
                    alert('There was a problem with the request.');
                }
            }
        };
        httpRequest.send();
        
    });
});