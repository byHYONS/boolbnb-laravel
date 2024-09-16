import './bootstrap';

//? import scss:
import '~resources/scss/app.scss';

//? import boostrap:
import * as bootstrap from 'bootstrap';

//? importo il componente modale:
import './components/modale';
import confirmPassword from './components/password_confirm';

//? import per le immagini:
import.meta.glob(['../img/**']);

import validateForm from '../../public/js/validateCheckbox';

confirmPassword();
validateForm();
