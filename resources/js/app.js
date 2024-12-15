import './bootstrap';
import 'laravel-datatables-vite';

import 'select2/dist/css/select2.css';
import 'select2';

import Alpine from 'alpinejs';
import jQuery from 'jquery';

window.$ = jQuery;
window.Alpine = Alpine;

Alpine.start();
