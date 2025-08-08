import './bootstrap';

import Alpine from 'alpinejs';
import { Notyf } from "notyf";
import "notyf/notyf.min.css";

// Create a global instance
window.notyf = new Notyf();

window.Alpine = Alpine;

Alpine.start();
