import { createApp } from 'vue';

// Import components
import Card from './components/Card.vue';
import Products from "./components/Products.vue";

const app = createApp();

// Register components
app.component('card', Card);
app.component('products', Products);

app.mount('#app');
