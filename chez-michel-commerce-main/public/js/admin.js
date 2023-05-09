const inputElement = document.querySelector('input[type=file]');
const previewElement = document.querySelector('#preview');
let selectedFiles = [];

inputElement.addEventListener('change', (event) => {
    selectedFiles = [];
    previewElement.innerHTML = '';

    for (let i = 0; i < inputElement.files.length; i++) {
        const file = inputElement.files[i];

        if (file.type.match('image.*')) {
            if (selectedFiles.length < 3) {
                selectedFiles.push(file);

                const reader = new FileReader();
                reader.addEventListener('load', (event) => {
                    const imgElement = document.createElement('img');
                    imgElement.src = event.target.result;
                    imgElement.classList.add('preview-image');
                    previewElement.appendChild(imgElement);
                });
                reader.readAsDataURL(file);
            }
        }
    }
});
