import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const deleteSubmitButtons = document.querySelectorAll(".delete-button");

deleteSubmitButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();

        const dataTitle = button.getAttribute("data-item-title");

        const modal = document.getElementById("deleteModal");

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const modalItemTitle = modal.querySelector("#modal-item-title");
        modalItemTitle.textContent = dataTitle;

        const buttonDelete = modal.querySelector("button.btn-danger");

        buttonDelete.addEventListener("click", () => {
            button.parentElement.submit();
        });
    });
});
// prendo casella input del file in upload
const image = document.getElementById('image');
//se esiste la casella di input
if(image){

    image.addEventListener("change",()=>{
        //console.log(image.files[0]);
        //prendi elemento img dove voglio vedere anteprima
        const preview = document.getElementById('upload_preview');
        //creo nuovo oggetto file reader
        const objFileReader = new FileReader();
        //uso il metodo readAsDataURL dell'oggetto creato per leggere il file
        objFileReader.readAsDataURL(image.files[0]);
        //al termine della lettura del file quindi dopo .onload 
        objFileReader.onload = function(event){
            //metto nel campo src della preview l'immagine caricata e letta precedentemente
            preview.src = event.target.result;
        }
    });
}