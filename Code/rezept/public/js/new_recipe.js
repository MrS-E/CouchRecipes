const speisen = ["Auflauf", "Wok", "Omelette", "Tost", "Nudeln", "Pizza", "Eintopf"]
const zutaten = ["Schnecken", "Ei", "Leber", "Wein", "Mandel", "Pilz", "Spinat", "Tomaten"]

document.getElementById("name_field").setAttribute("placeholder", zutaten[randomInt(0, zutaten.length - 1)] + " " + speisen[randomInt(0, speisen.length - 1)])
document.getElementById("img_field").addEventListener("change", (e) => {
    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = function () {
        console.log(reader.result);
        document.getElementById("bild").src = reader.result;
        document.getElementById("img").value = reader.result;
    };
    reader.onerror = function (error) {
        console.log('Error: ', error);
    };
})
document.getElementById("new_ingred").addEventListener("click", (e) => {
    document.querySelector("table tbody").appendChild(document.createElement("tr"));
    console.log(document.querySelector("table tbody:last-child"))
    document.querySelector("table tbody tr:last-child").innerHTML = "<td>" +
        "<input class=\"form-control ingredient zutat\" type=\"text\" required  onchange=\"addInc(e)\">" +
        "</td>"+
        "<td>"+
        "<input class=\"form-control  ingredient menge\" type=\"number\" step=\"0.1\" min=\"0\" value=\"0\" required  onchange=\"addInc(e)\">"+
        "</td>"
})

function addInc(e){
console.log(e.target)
}

function randomInt(min, max) { // min and max included
    return Math.floor(Math.random() * (max - min + 1) + min)
}
