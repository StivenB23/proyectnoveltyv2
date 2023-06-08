// Scanner
let buttonScanner = document.getElementById("buttonScann");
buttonScanner?.addEventListener("click", () => {
    const html5QrCode = new Html5Qrcode("reader");
    const qrCodeSuccessCallback = (result, objetoresult) => {
        document.getElementById("inputCodeComputer").value = result;
        console.log(result);
        html5QrCode.stop();
    };
    html5QrCode.start({ facingMode: "user", facingMode: "environment" },
        {
            fps: 10,    // Optional, frame per seconds for qr code scanning
            qrbox: { width: 360, height: 350 }  // Optional, if you want bounded box UI
        }, qrCodeSuccessCallback);
})
// Filters cards
let inputFilter = document.getElementById("inputFilter");
inputFilter?.addEventListener("keyup", (e) => {
    console.log(e.target.value.toLowerCase());
    let cards = document.querySelectorAll("#card");
    cards.forEach((card) => {
        let dateObject = new Date(card.getAttribute("date"));
        let date = dateObject.getDate() + "/" + (dateObject.getMonth() + 1) + "/" + dateObject.getFullYear();
        card.getAttribute("state") == e.target.value.toLowerCase() || date == e.target.value ? card.classList.remove("hidden") : card.classList.add("hidden");
        if (e.target.value == "") {
            card.classList.remove("hidden");
        }
    })
})
// Image preview
let inputFile = document.getElementById("file-ip-1");
let preview = document.getElementById("content-image");
let files;
function createPreview(element) {
    let src = URL.createObjectURL(element);
    img = document.createElement('img');
    img.src = src;
    img.setAttribute("id", "image")
    img.setAttribute("name", element.name)
    preview.appendChild(img);
}
function showPreview(e) {
    if (e.target.files.length > 0) {
        console.log(e.target.files);
        let element;
        files = e.target.files;
        for (let index = 0; index < files.length; index++) {
            element = files[index];
            createPreview(element);
        }

    }
}
function removeImage(file) {
    const dt = new DataTransfer()
    const input = inputFile.files

    for (let i = 0; i < input.length; i++) {
        // console.log(input[i].name);
        const fileData = files[i]
        if (file !== input[i].name)
            dt.items.add(fileData) 
    }
    inputFile.files = dt.files
    let image = document.getElementsByName(file);
    image[0].classList.add("hidden");
}
inputFile?.addEventListener("change", (e) => {
    showPreview(e);
    // console.log(this.files)
});
document.getElementById("btn-preview").addEventListener("click", () => {
    let images = document.querySelectorAll("#image");
    console.log(images);
    images.forEach(image => {
        image.addEventListener("click", (e) => {
            removeImage(e.target.name)
        })
    })
})
// Datatable
let table = document.getElementById('myTable');
if (typeof (table) != null) {
    let dataTable = new DataTable(table, {
        labels: {
            placeholder: "Buscar...",
            perPage: "Mostrar {select} por página",
            noRows: "No hay datos para mostrar",
            info: "Mostrando de {start} a {end} de {rows} ",
        }
    });
}
