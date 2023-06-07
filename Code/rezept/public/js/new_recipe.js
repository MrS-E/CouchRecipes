const speisen = ["Auflauf", "Wok", "Omelette", "Tost", "Nudeln", "Pizza", "Eintopf"]
const zutaten = ["Schnecken", "Ei", "Leber", "Wein", "Mandel", "Pilz", "Spinat", "Tomaten"]

document.getElementById("name_field").setAttribute("placeholder", zutaten[randomInt(0, zutaten.length - 1)] + " " + speisen[randomInt(0, speisen.length - 1)])
document.getElementById("img_field").addEventListener("change", (e) => {
    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = function () {
        document.getElementById("bild").src = reader.result;
        document.getElementById("img").value = reader.result;
    };
    reader.onerror = function (error) {
        console.error('Error: ', error);
    };
})
document.getElementById("new_ingred").addEventListener("click", (e) => {
    document.querySelector("table tbody").appendChild(document.createElement("tr"));
    const t1 = document.createElement("td");
    const i1 = document.createElement("input")
    i1.setAttribute("type", "text")
    i1.setAttribute("required", true)
    i1.classList.add("form-control", "ingredient", "zutat")
    i1.addEventListener('change', addInc)
    t1.appendChild(i1)
    const t2 = document.createElement("td")
    const i2 = document.createElement("input")
    i2.setAttribute("type", "number")
    i2.setAttribute("step", 0.1)
    i2.setAttribute("min", 0)
    i2.setAttribute("value", 0)
    i2.setAttribute("required", true)
    i2.classList.add("form-control", "ingredient", "menge")
    i2.addEventListener('change', addInc)
    t2.appendChild(i2)
    document.querySelector("table tbody tr:last-child").appendChild(t1)
    document.querySelector("table tbody tr:last-child").appendChild(t2)

})

function addInc(){
    const d = []
    const inc = document.querySelectorAll("table tbody tr")
    document.getElementById("ingredient").value=""
    for(let i of inc){
        //d.push([i.querySelector("td:first-child input").value, i.querySelector("td:last-child input").value])
        document.getElementById("ingredient").value+= i.querySelector("td:first-child input").value + "," + i.querySelector("td:last-child input").value
            document.getElementById("ingredient").value+="/"
    }
}

function randomInt(min, max) { // min and max included
    return Math.floor(Math.random() * (max - min + 1) + min)
}
