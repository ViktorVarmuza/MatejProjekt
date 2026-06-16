import './bootstrap';
import 'flowbite';
import 'flag-icons/css/flag-icons.min.css';
import "@fortawesome/fontawesome-free/css/all.min.css";

// 1. Správný import TinyMCE
import tinymce from 'tinymce/tinymce';

// 2. Import modelů (od verze TinyMCE 6+ naprosto povinné pro funkčnost editoru)
import 'tinymce/models/dom/model';

// Import témat a ikon
import 'tinymce/themes/silver/theme';
import 'tinymce/icons/default/icons';

// Import pluginů, které reálně v Blade konfiguraci používáš
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/code';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/table';
import 'tinymce/plugins/wordcount';

// --- IMPORTS PRO WEBPACK/VITE (Skiny a styly) ---
import 'tinymce/skins/ui/oxide/skin.css';

// 3. Přidání TinyMCE do globálního objektu window, aby ho Blade viděl!
window.tinymce = tinymce;