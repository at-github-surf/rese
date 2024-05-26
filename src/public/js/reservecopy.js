const myDate = document.getElementById('reserve_date');
const myTime = document.getElementById('reserve_time');
const myNumber = document.getElementById('number');
const displayDate = document.getElementById('display_reserve_date');
const displayTime = document.getElementById('display_reserve_time');
const displayNumber = document.getElementById('display_number');

console.log(myDate);

myDate.addEventListener("change", (event) => {
    displayDate.innerHTML = myDate.value;
});

myTime.addEventListener("change", (event) => {
    displayTime.innerHTML = myTime.value;
});

myNumber.addEventListener("change", (event) => {
    displayNumber.innerHTML = myNumber.value + "人";
});