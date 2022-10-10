const placeholder = 'https://wopart.eu/wp-content/uploads/2021/10/placeholder-7.png';
const preview = document.getElementById('preview');
const imageField = document.getElementById('image-field');

imageField.addEventListener('input', () => {

    alert('got it');

    if(imageField.files && imageField.files[0]) {
        let reader = new FileReader();

        reader.readAsDataURL(imageField.files[0]);
    } else preview.src = placeholder;


    preview.src = imageField.value || placeholder;
});