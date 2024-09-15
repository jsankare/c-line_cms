document.addEventListener("DOMContentLoaded", function() {
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean'],                                        // remove formatting button

        ['link', 'image']                                 // link and image
    ];

    const quill = new Quill('#editor', {
        placeholder: 'Entrez votre contenu ici',
        theme: 'snow',
        modules: {
            toolbar: {
                container: toolbarOptions,
                handlers: {
                    image: function() {
                        selectLocalImage();
                    }
                }
            }
        }
    });

    // Function to handle image selection from local file system
    function selectLocalImage() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        // Listen for file selection
        input.onchange = function() {
            const file = input.files[0];

            // Ensure that the file is an image
            if (/^image\//.test(file.type)) {
                const reader = new FileReader();
                
                // Read the file as a data URL
                reader.onload = function(e) {
                    const range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', e.target.result);
                    
                    // Set default size for the image
                    const img = quill.root.querySelector('img[src="' + e.target.result + '"]');
                    if (img) {
                        img.style.maxWidth = '300px';
                        img.style.height = 'auto';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                console.warn('Please select an image file.');
            }
        };
    }

    const form = document.querySelector('form');
    form.onsubmit = function() {
        const content = document.querySelector('input[name=content]');
        content.value = quill.root.innerHTML;
    };
});
