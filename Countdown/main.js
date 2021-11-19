const startbtn =document.querySelector(".startBtn");
const HoursText = document.querySelector(".hours span");
const MinText = document.querySelector(".min span");
const SecText = document.querySelector(".sec span");
let hours = 1;
let min = 0;
let sec = 0;
startbtn.addEventListener("click", ()=> {
    startbtn.style.display = "none";
    NewTime();
    const p = new Promise((resolve, reject) => {
        const BeginCD = setInterval(()=>{
            NewTime();
            sec--;
            if (sec<0){
                sec = 59;
                min--;
            }
            if (min<0){
                min=59;
                hours--;
            }
            if (hours < 0){
                hours = 0;
                min =0;
                sec =0;
                resolve('endSuccess');
                NewTime();
                clearInterval(BeginCD);
            }
        }, 1000)
    });
    p.then(function () {
        startbtn.style.display = "inline-block";
        hours =1;
    })
})
function NewTime()
{
    if (hours < 10)
    {
        HoursText.textContent = '0' +hours;
    }
    else
    {
        HoursText.textContent= hours;
    }
    if (min < 10)
    {
        MinText.textContent = '0' +min;
    }
    else
    {
        MinText.textContent = min;
    }
    if (sec < 10)
    {
        SecText.textContent = '0' +sec;
    }
    else
    {
        SecText.textContent = sec;
    }

}