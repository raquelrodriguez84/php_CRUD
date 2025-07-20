import { toggleFormulario, passwordVisibility } from './exportJs/mostra_form.js';

    // Llama a las funciones con los IDs correctos
    toggleFormulario('formDatosUsuario', 'btnMostrarFormDatos');
    toggleFormulario('formCambiarPass', 'btnMostrarFormPass');
    passwordVisibility('miCheckbox', 'miInputPassword');