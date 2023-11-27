let togg1 = document.getElementById("toggle-info-1");
let togg2 = document.getElementById("toggle-info-2");
let togg3 = document.getElementById("toggle-info-3");
let togg4 = document.getElementById("toggle-info-4");
let togg5 = document.getElementById("toggle-info-5");
let togg6 = document.getElementById("toggle-info-6");
let togg7 = document.getElementById("toggle-info-7");
let d1 = document.getElementById("info-panel-1");
let d2 = document.getElementById("info-panel-2");
let d3 = document.getElementById("info-panel-3");
let d4 = document.getElementById("info-panel-4");
let d5 = document.getElementById("info-panel-5");
let d6 = document.getElementById("info-panel-6");
let d7 = document.getElementById("info-panel-7");

togg1.addEventListener("click", () => {
  if(getComputedStyle(d1).display != "none"){
    d1.style.display = "none";
  } else {
    d1.style.display = "block";
  }
})

function togg(){
  if(getComputedStyle(d2).display != "none"){
    d2.style.display = "none";
  } else {
    d2.style.display = "block";
  }
};
togg2.onclick = togg;

togg3.addEventListener("click", () => {
  if(getComputedStyle(d3).display != "none"){
    d3.style.display = "none";
  } else {
    d3.style.display = "block";
  }
})

togg4.addEventListener("click", () => {
  if(getComputedStyle(d4).display != "none"){
    d4.style.display = "none";
  } else {
    d4.style.display = "block";
  }
})

togg5.addEventListener("click", () => {
  if(getComputedStyle(d5).display != "none"){
    d5.style.display = "none";
  } else {
    d5.style.display = "block";
  }
})

togg6.addEventListener("click", () => {
  if(getComputedStyle(d6).display != "none"){
    d6.style.display = "none";
  } else {
    d6.style.display = "block";
  }
})

togg7.addEventListener("click", () => {
  if(getComputedStyle(d7).display != "none"){
    d7.style.display = "none";
  } else {
    d7.style.display = "block";
  }
})