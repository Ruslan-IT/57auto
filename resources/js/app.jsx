import { createRoot } from 'react-dom/client';
import ERDiagram from './ERDiagram';

const el = document.getElementById('er-diagram');

if (el) {
    const root = createRoot(el);
    root.render(<ERDiagram />);
}
