fetch('pic.json').then(response =>{
    response.json().then(result =>{
        let picserver = document.createElement('img');
        picserver.src = result.cat1;
        picserver.style.width="300px";
        picserver.style.height="300px";
        document.querySelector('.container').append(picserver);
        let picexres = document.createElement('img');
        picexres.src = result.cat2;
        picexres.style.width="500px";
        picexres.style.height="300px";
        document.querySelector('.container').append(picexres);
        let picbase64 = document.createElement('img');
        picbase64.src = result.cat3;
        picbase64.style.width="400px";
        picbase64.style.height="300px";
        document.querySelector('.container').append(picbase64);
    })
})